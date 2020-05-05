<?php

namespace App\Interfaces;

interface SmsSender
{
    public function send($message, $phone);
}
