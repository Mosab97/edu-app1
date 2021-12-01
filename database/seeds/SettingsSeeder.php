<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        setting(['name' => [
            'ar' => 'المعلم',
            'en' => 'Teacher',
        ]])->save();
        setting(['address' => [
            'ar' => 'address ar',
            'en' => 'address en',
        ]])->save();
        setting(['email' => 'email@email.com'])->save();
        setting(['currency' => \App\Models\Setting::currencies['SAR']])->save();
        setting(['calendly_url' => 'http://ingaz.test/manager/settings'])->save();
        setting(['join_us_url' => 'http://ingaz.test/manager/settings'])->save();
        setting(['mobile' => '+966547896541'])->save();
        setting(['logo' => 'defaults/def_images/def_image.png'])->save();
        setting(['logo_light' => 'img/def_image.png'])->save();
        setting(['logo_min' => 'img/def_image.png'])->save();
        setting(['about_us_image' => 'img/def_image.png'])->save();
        setting(['whatsApp' => '+966547896541'])->save();
        setting(['facebook' => ''])->save();
        setting(['twitter' => ''])->save();
        setting(['instagram' => ''])->save();
        setting(['snapchat' => ''])->save();
        setting(['youtube' => ''])->save();
        setting(['android_url' => ''])->save();
        setting(['ios_url' => ''])->save();
        setting(['commission' => 10])->save();
        setting(['about_us_title' => [
            'ar' => 'about_us_title_ar',
            'en' => 'about_us_title_en',
        ]])->save();
        setting(['about_us_details' => [
            'ar' => 'about_us_details_ar',
            'en' => 'about_us_details_en',
        ]])->save();
        setting(['about_us_image' => 'web/images/misc/1.png'])->save();
//        setting(['showcase_background' => 'img/def_showcase.jpg'])->save();
        setting(['showcase_background' => [
            'ar' => 'img/def_image.png',
            'en' => 'img/def_image.png',
        ]])->save();
        setting(['showcase_background_front' => 'img/def_showcase_front.png'])->save();
        setting(['brochure' => 'web/images/misc/1.png'])->save();
        setting(['showcase_title' => [
            'ar' => 'عنوان الشوكيس',
            'en' => 'Help to improve focus',
        ]])->save();
        setting(['showcase_details' => [
            'ar' => 'تفاصيل الشو كيس',
            'en' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua ut enim.',
        ]])->save();
        setting(['privacy_policy' => [
            'ar' => 'Privacy policy ar',
            'en' => 'Privacy policy en',
        ]])->save();
        setting(['conditions' => [
            'ar' => 'conditions ar',
            'en' => 'conditions en',
        ]])->save();
        setting(['special_service_details' => [
            'ar' => 'special_service_details ar',
            'en' => 'special_service_details en',
        ]])->save();

    }
}
