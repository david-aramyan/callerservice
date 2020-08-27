<?php

namespace App\Helper;

interface HelperFactory
{
    public function get(): Helper;
}