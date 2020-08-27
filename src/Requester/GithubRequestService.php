<?php

namespace App\Requester;

class GithubRequestService implements Requester
{
    /**
     * Make request.
     *
     * @param string $url
     * @param string $method
     *
     * @return string
     * @throws \Exception
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $url, string $method): string
    {
        $client = new \GuzzleHttp\Client;
        try {
            $response = $client->request($method, $url);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $response = $response->getBody()->getContents();
            throw new \Exception($response,$e->getCode());
        }
        return $response->getBody();
    }
}