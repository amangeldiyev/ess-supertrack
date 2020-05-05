<?php

namespace App\Services;

use App\Interfaces\Sms;
use GuzzleHttp\Client;

class KcellSms implements Sms
{

    /**
     * Send single message.
     *
     * @param  string $message
     * @param  integer $phone
     * @return void
     */
    public function send($message, $phone)
    {
        $client = new Client();
        
        try {
            $client->request('POST', 'https://msg.kcell.kz/api/v3/messages', [
                'auth' => [config('services.sms.login'), config('services.sms.password')],
                'json' => [
                    "client_message_id" => time(),
                    "recipient" => $this->phone,
                    "sender" => config('services.sms.sender'),
                    "message_text" => $this->message,
                    "priority" => 2,
                    "tag" => "test_clnt_msg_id_1",
                    "expire_time" => null,
                    "schedule_time" => null,
                    "callback_url" => null
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error('Error while seding sms');
        }
    }
}