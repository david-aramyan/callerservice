<?php

namespace App\Formatter;

interface Formatter {
    public function decode(string $content): ?array;
    public function encode(array $data): string;
}