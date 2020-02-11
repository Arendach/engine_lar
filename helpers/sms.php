<?php

use Mobizon\MobizonApi;

function sms_send($phone, $message)
{
    $api = new MobizonApi(SMS_API_KEY);

    $parameters = [
        'recipient' => get_number_world_format($phone),
        'text'      => trim($message),
        'from'      => 'SkyFire'
    ];

    return $api->call('message', 'sendSMSMessage', $parameters);
}