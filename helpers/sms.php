<?php

use Mobizon\MobizonApi;

function sms_send(string $phone, string $message)
{
    $api = new MobizonApi(config('api.mobizon'), 'api.mobizon.ua');

    $parameters = [
        'recipient' => get_number_world_format($phone),
        'text'      => trim($message),
        'from'      => 'SkyFire'
    ];

    return $api->call('message', 'sendSMSMessage', $parameters, [], true);
}