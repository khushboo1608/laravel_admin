<?php

return [
    'file_path' => [
        // 'admin_user_profile' => 'storage/media/profile/',
        'admin_user_profile'    => 'images/admin/user_profile',
        'user_profile'       => 'images/app/user_profile',
        'gym_img'           => 'images/app/gym_img',
        'document_img'           => 'images/app/document_img',
        'news_img' =>'images/app/news_img',
        'story_image' =>'images/app/story_image',
        'amenities_img' =>'images/app/amenities_img',
        'complaint_img' =>'images/app/complaint_image',
        'agent_img'           => 'images/app/agent_img',
        'agent_reject_image' => 'images/app/agent_reject_image',
        'agent_approve_image' => 'images/app/agent_approve_image',
        'app_logo' => 'images/app/app_logo',
        'app_upi_image'=> 'images/app/app_upi_image',
        'vendor_image'=> 'images/app/vendor_img',
               
    ],
    'no_image' => [
        'no_user'   => env('APP_URL').'/public/images/noimage/user-not-found.png',
        'no_image'  => env('APP_URL').'/public/images/noimage/image-not-found.jpg',
        'add_image'  => env('APP_URL').'/public/images/noimage/add-image.png'
    ],
    'static_image' => [
        'web_logo'      => env('APP_URL').'public/images/logo/logo.png',
        'admin_logo'      => env('APP_URL').'public/images/180.png',
        'favicon'   => env('APP_URL').'/public/images/favicon/favicon-16x16.png',
        'logo'              => env('APP_URL').'public/storage/media/profile/Logo.png',
    ],
    'null_object'   => new \stdClass(),
    'null_array'    => [],
    'current_time_zone' => 'Asia/Kolkata'
];
