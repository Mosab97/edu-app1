<?php

namespace App\Http\Controllers\Api\v1\Chat;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\v1\Chat\ChatMessageResource;
use App\Http\Resources\Api\v1\General\FileResource;
use App\Http\Resources\Api\v1\Teacher\GroupResource;
use App\Models\ChatMessage;
use App\Models\Group;
use App\Models\GroupFile;
use App\Models\StudentGroups;
use App\Models\StudentUnReadGroupMessages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ChatController extends Controller
{

    public function getAllChats(Request $request)
    {
        $user = apiUser();
        $request['user_type'] = $user->user_type;
        return apiSuccess([
            'items' => [],// ChatMessageResource::collection($messages->items()),
//            'paginate' => paginate($chats),
        ]);
    }

    public function group_media(Request $request, $group_id)
    {
        $files = GroupFile::where(['group_id' => $group_id])->get();//->paginate($this->perPage);
        return apiSuccess(FileResource::collection($files));
//        return apiSuccess([
//            'items' => FileResource::collection($files->items()),
//            'paginate' => paginate($files),
//        ]);
    }

    public function delete_media(Request $request, $file_id)
    {
        $file = GroupFile::query()->findOrFail($file_id);
        $file->chatMessage()->delete();
        $file->delete();
        return apiSuccess(null, api('File Deleted Successfully'));
    }

    public function chatMessages(Request $request, $id)
    {
        $messages = ChatMessage::query()->with(['file'])->where('group_id', $id)->get();
//            ->paginate($this->perPage);
        return apiSuccess(ChatMessageResource::collection($messages));
//        dd(collect($messages->items())->pluck('file'));
//        return apiSuccess([
//            'items' => ChatMessageResource::collection($messages->items()),
//            'paginate' => paginate($messages),
//        ]);
    }


    public function sendMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'sometimes|min:1|max:200',
//            'file' => 'required',
            'file' => 'sometimes|mimes:mp4,mp3,mov,ogg,qt,jpg,png,JPG,PNG,gif,pdf,word,xlsx,docx | max:20000',
        ]);
        $user = apiUser();
        $group = Group::query()->with(['students.student'])->findOrFail($id);
        if ($user->user_type == User::user_type['TEACHER']) {
            if ($group->teacher_id != $user->id) return apiError(api('Not group teacher'));
        } else {
            if ($group->students()->where(['student_id' => $user->id])->count() == 0) return apiError(api('Not Group member'));
        }
        $chatMessage = $group->chatMessages()->create([
            'sender_id' => apiUser()->id,
            'message' => $request->message,
            'type' => $request->hasFile('file') ? ChatMessage::type['file'] : ChatMessage::type['text'],
        ]);
        if ($request->hasFile('file')) {
            $file = $this->uploadImage($request->file('file'), ChatMessage::manager_route, true);
            $group->files()->create([
                'chat_message_id' => $chatMessage->id,
                'name' => optional($file)['name'],
                'extension' => optional($file)['extension'],
                'path' => optional($file)['path'],
            ]);
        }
        foreach ($group->students->pluck('student') as $student) {
            $res = StudentUnReadGroupMessages::where(['user_id' => $student->id, 'group_id' => $group->id])->first();
            if (isset($res)) {
                $res->update([
                    'number' => ($res->number + 1)
                ]);
            } else {
                StudentUnReadGroupMessages::create([
                    'number' => 1,
                    'group_id' => $group->id,
                    'user_id' => $student->id,
                ]);
            }
        }
        return apiSuccess(new ChatMessageResource($chatMessage), api('Message Send Successfully'));
    }

    public function storeChatFile(Request $request, $group_id, $sender_id)
    {
        $file = $request->file_base64;
        $folderPath = "uploads/" . ChatMessage::manager_route . "/"; //path location
        $file_parts = explode(";base64,", $file);
        $file_type_aux = explode("/", $file_parts[0]);
        $file_ext = $file_type_aux[1];
        $file_type = explode(':', $file_type_aux[0])[1];

        $file_base64 = base64_decode($file_parts[1]);
        $uniqid = uniqid();
        $file = $folderPath . $uniqid . '.' . $file_ext;
        file_put_contents($file, $file_base64);
//        dd($file_parts[1],$file_base64);

//        switch ($file_type){
//    case'video':break;
//    case'image':break;
//    case'audio':break;
//    /*for pdf*/case'application':break;
//}
//        dd($file_type_aux,$file_ext,$file_type);


        /******************************************************/


        $group = Group::findOrFail($group_id);
        $chatMessage = $group->chatMessages()->create([
            'sender_id' => $sender_id,
            'message' => $request->message,
            'type' => ChatMessage::type['file'],
        ]);
        $group->files()->create([
            'chat_message_id' => $chatMessage->id,
            'name' => 'null',
            'extension' => $file_ext,
            'path' => $file,
        ]);
        Log::info('file_websocket', [
            'group' => $group_id,
            'file' => asset($file),
            'file_type' => $file_type,
            'file_ext' => $file_ext,
        ]);
        return apiSuccess([
            // 'request' => $request->all(),
            'group' => $group_id,
            'path' => $file,
        ]);
        // dd($group_id, checkRequestIsWorkingOrNot());
    }

    public function sendMessageWebSocket(Request $request, $group_id, $sender_id)
    {
        $group = Group::query()->with(['students.student'])->findOrFail($group_id);
        $chatMessage = $group->chatMessages()->create([
            'sender_id' => $sender_id,
            'message' => $request->message,
            'type' => ChatMessage::type['text'],
        ]);
        foreach ($group->students->pluck('student') as $student) {
            $res = StudentUnReadGroupMessages::where(['user_id' => $student->id, 'group_id' => $group->id])->first();
            if (isset($res)) {
                $res->update([
                    'number' => ($res->number + 1)
                ]);
            } else {
                StudentUnReadGroupMessages::create([
                    'number' => 1,
                    'group_id' => $group->id,
                    'user_id' => $student->id,
                ]);
            }
        }

        return apiSuccess(new ChatMessageResource($chatMessage), api('Message Send Successfully'));
    }

    public function read_all_messages(Request $request, $group_id)
    {
        StudentUnReadGroupMessages::where(['group_id' => $group_id, 'user_id' => apiUser()->id])->delete();
        return apiSuccess(null, api('Messages Read Successfully'));
    }

    public function checkCanSendMessage(Request $request, $group_id, $client_id)
    {
        $user = User::findOrFail($client_id);
        if ($user->user_type == User::user_type['TEACHER']) return apiSuccess([
            'can_send' => $user->teacher_groups()->where(['id' => $group_id])->count() > 0
        ]);
        else return apiSuccess([
            'can_send' => $user->student_groups()->where(['group_id' => $group_id])->count() > 0
        ]);
    }

    public function getAllIdsWithTeacherId(Request $request, $group_id)
    {
        $group = Group::with(['students'])->findOrFail($group_id);
        $ids = $group->students->pluck('student_id')->all();
        $ids[] = $group->teacher_id;
        return apiSuccess($ids);
    }

}
