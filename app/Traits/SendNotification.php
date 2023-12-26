<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

trait SendNotification
{


    


    function sendNotification($key, $value, $title, $message)
    {

        $heading = $title;
        $content = $message;
        $url =
            $url = 'https://onesignal.com/api/v1/notifications';

        $headers = [
            'Authorization' => 'Basic ' . 'MGQwN2YwYmQtZDk1Ny00MzViLTlhOTktNDU4MDIxMjYzZDIy',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
        $tags = [
            [
                'key' => $key,
                'relation' => '=',
                'value' => $value,
            ],
        ];

        $data = [
            'app_id' => '49ef83b6-29de-457c-a160-de17abc8456c',
            'tags' => $tags,
            'headings' => ['en' => $heading],
            'contents' => ['en' => $content]
        ];


        return Http::withHeaders($headers)->post($url, $data)->json();    }

    function sendVerificationCode($phoneNumber, $verificationCode,)
    {

        $enHeading = 'Verify phone number';
        $enContent = 'Your verification code is ' . $verificationCode;
        $arHeading = 'التحقق من رقم الهاتف';
        $arContent = 'رمز تحقيقك هو ' . $verificationCode;


        $url =
            $url = 'https://onesignal.com/api/v1/notifications';

        $headers = [
            'Authorization' => 'Basic ' . 'MGQwN2YwYmQtZDk1Ny00MzViLTlhOTktNDU4MDIxMjYzZDIy',
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];


        $tags = [

            [
                'key' => 'phoneNumber0',
                'relation' => '=',
                'value' => $phoneNumber,
            ], 
            ["operator" => "OR"], 
            [
                'key' => 'phoneNumber1',
                'relation' => '=',
                'value' => $phoneNumber,
            ]
        ];
    

        
        $data = [
            'app_id' => '49ef83b6-29de-457c-a160-de17abc8456c',
            'tags' => $tags,
            'headings' => ['en' => $enHeading, 'ar' => $arHeading],
            'contents' => ['en' => $enContent, 'ar' => $arContent]
        ];


        return Http::withHeaders($headers)->post($url, $data)->json();    }
}
