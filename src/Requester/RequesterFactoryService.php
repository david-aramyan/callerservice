<?php

namespace App\Requester;

class RequesterFactoryService implements RequesterFactory
{
    /**
     * Get the necessary service.
     *
     * @return Requester
     */
    public function request(): Requester
    {
        return new GithubRequestService();
    }
}