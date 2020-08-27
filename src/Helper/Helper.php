<?php

namespace App\Helper;

interface Helper {
    public function select(string $key, string $sign, string $value, array $data): array;
    public function sort(string $key, string $order, array $data): array;
    public function only(array $fields, array $data): array;
}