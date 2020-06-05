<?php

namespace App\Contracts;

interface SmsProvider
{
    public function send($message, $phone);

    public function log($message, $phone);
}
