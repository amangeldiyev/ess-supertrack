<?php

namespace App\Services;

use App\Interfaces\SmsSender;
use Illuminate\Support\Facades\Http;
use Log;

class KcellSms implements SmsSender
{

    /**
     * Send single message.
     *
     * @param  string $message
     * @param  string $phone
     * @return string
     */
    public function send($text, $phone)
    {
        try {
            $response = Http::withBasicAuth(config('services.sms.login'), config('services.sms.password'))
                ->post('https://msg.kcell.kz/api/v3/messages', [
                    "client_message_id" => time(),
                    "recipient" => $this->normalizePhone($phone),
                    "sender" => config('services.sms.sender'),
                    "message_text" => $text,
                    "priority" => 2,
                    "tag" => "test_clnt_msg_id_1",
                    "expire_time" => null,
                    "schedule_time" => null,
                    "callback_url" => null
                ]);

            Log::info($response->json());

        } catch (\Exception $e) {
            Log::error('Error while seding sms');
            Log::info($e);
        }
    }

    public function log($text, $phone)
    {
        Log::info($text . ' - Sent to: ' . $this->normalizePhone($phone));
    }

    /**
     * Normalize phone format.
     *
     * @param  string $phone
     * @return string
     */
    private function normalizePhone($phone)
    {
        return '7'.substr(preg_replace('/[^0-9.]+/', '', $phone), -10);
    }
}
