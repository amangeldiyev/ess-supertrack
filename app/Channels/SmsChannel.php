<?php

namespace App\Channels;

use GuzzleHttp\Client;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);

        $client = new Client();
        
        $response = $client->request('POST', 'https://msg.kcell.kz/api/v3/messages', [
            'auth' => [config('services.sms.login'), config('services.sms.password')],
            'json' => [
                "client_message_id" => time(),
                "recipient" => $notifiable->phone,
                "sender" => config('services.sms.sender'),
                "message_text" => $message['text'],
                "priority" => 2,
                "tag" => "test_clnt_msg_id_1",
                "expire_time" => null,
                "schedule_time" => null,
                "callback_url" => null
            ],
        ]);

        \Log::info($message['text']);

    }
}
