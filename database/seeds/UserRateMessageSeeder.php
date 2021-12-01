<?php

use Illuminate\Database\Seeder;

class UserRateMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Models\Group::get() as $index => $group) {
            foreach ($group->students as $index2 => $student) {
                $user_rate_msg = factory(\App\Models\UserRateMessage::class)->create([
                    'from_id' => $student->id,
                    'to_id' => $group->teacher_id,
                    'from_type' => \App\Models\User::user_type['STUDENT'],
                    'to_type' => \App\Models\User::user_type['TEACHER'],
                ]);
                factory(\App\Models\UserStandardRate::class, 3)->create([
                    'parent_id' => $user_rate_msg->id,
                    'standard_id' => \App\Models\Standard::teacher()->inRandomOrder()->first()->id,
                ]);
                $user_rate_msg->update(['avg' => $user_rate_msg->standard_rates()->avg('rate')]);
            }
        }
    }
}
