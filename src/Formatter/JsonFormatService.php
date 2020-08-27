<?php

namespace App\Formatter;

class JsonFormatService implements Formatter
{
    /**
     * Decode given string.
     *
     * @param string $content
     *
     * @return array|null
     */
    public function decode(string $content): ?array
    {
        return json_decode($content, true);
    }

    /**
     * Encode given array.
     *
     * @param array $data
     *
     * @return string
     */
    public function encode(array $data): string
    {
        return json_encode($data);
    }
}