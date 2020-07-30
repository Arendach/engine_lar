<?php

namespace App\Services;

use Google\Cloud\Translate\V2\TranslateClient;

class TranslateService
{
    public function get($text, string $language = 'ru', bool $decode = true): ?string
    {
        $client = new TranslateClient();

        $result = $client->translate(htmlspecialchars_decode($text), [
            'target' => $language,
            'source' => 'uk',
            'key'    => config('api.google_translate'),
            'format' => preg_match('/<(.*?)>/', $text) ? 'html' : 'text'
        ]);

        if (!isset($result['text'])) {
            return null;
        }

        if ($decode) {
            $result['text'] = htmlspecialchars_decode($result['text']);
        }

        return $result['text'];
    }
}