<?php

namespace App\Formatter;

interface FormatterFactory
{
    public function format(): Formatter;
}