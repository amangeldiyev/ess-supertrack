<?php

namespace App\Interfaces;

interface Sms
{
    public function send($message, $phone);
}
