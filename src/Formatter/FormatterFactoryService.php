<?php

namespace App\Formatter;

class FormatterFactoryService implements FormatterFactory
{
    /**
     * Get the necessary service.
     *
     * @return JsonFormatService
     */
    public function format(): Formatter
    {
        return new JsonFormatService();
    }
}