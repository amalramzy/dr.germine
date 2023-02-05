<?php

namespace App\Services;

class FirebaseService
{
    public static function sendFirebaseNotification($device_token,$msg,$title = 'test')
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $serverKey = 'AAAAODVnwb4:APA91bHBTkODA-Kk3aAOvfJztQwmwGTK_i2BkQK3TW53yrQBLBbeP72spRfjoNcSSL3IZ6ehBJNEZhvMMB6bJYwaQ-U8QqKvdrBBuymkWW1a4iuD2hh457K5BaNnQZtyYgYA6l_mLnae';

        $data=['msg'=>$msg];
        $data = [
            "registration_ids" => is_array($device_token) ? $device_token : [$device_token],
            "notification" => [
                "title" => $title,
                "body" =>$data['msg'] ,
            ],
            "data"=>$data
        ];
        $encodedData = json_encode($data);

        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type:application/json',
        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);

        // Execute post
        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);

        // FCM response
        return $result;
    }

}
