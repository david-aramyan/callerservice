<?php

namespace App\Helper;

class HelperFactoryService implements HelperFactory
{
    /**
     * Get the necessary service.
     *
     * @return Helper
     */
    public function get(): Helper
    {
        return new ArrayHelperService();
    }
}