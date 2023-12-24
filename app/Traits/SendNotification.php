<?php

namespace App\Traits;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

trait SendNotification
{

    function sendNotification($key ,$value, $title, $message)
    {

        $heading = $title;
        $content = $message;
        $url =
            $url = 'https://onesignal.com/api/v1/notifications';

        $headers = [
            'Authorization' => 'Basic ' . 'ZmFlYzA1YzctYzg2NS00MWU0LWIzNDMtMGI3MDhlNTM2ZWQ4',
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
            'app_id' => '43aa2aec-bdd6-4190-b576-14b795c4e6ad',
            'tags' => $tags,
            'headings' => ['en' => $heading],
            'contents' => ['en' => $content]
        ];


    Http::withHeaders($headers)->post($url, $data);
    }

}