<?php

namespace App\Requester;

interface RequesterFactory
{
    public function request(): Requester;
}