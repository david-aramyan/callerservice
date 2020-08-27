<?php

namespace App\Requester;

interface Requester {
    public function request(string $url, string $method): string;
}