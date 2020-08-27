<?php

namespace App;

use App\Formatter\FormatterFactoryService;
use App\Requester\RequesterFactoryService;
use App\Helper\HelperFactoryService;

class Caller
{
    /**
     * @var $data
     */
    private $data;

    /**
     * @var FormatterFactoryService  $formatterService;
     */
    private $formatterService;

    /**
     * @var RequesterFactoryService  $requesterService;
     */
    private $requesterService;

    /**
     * @var HelperFactoryService  $helperService;
     */
    private $helperService;

    /**
     * Caller constructor.
     */
    public function __construct()
    {
        $this->formatterService = (new FormatterFactoryService())->format();
        $this->requesterService = (new RequesterFactoryService())->request();
        $this->helperService    = (new HelperFactoryService())->get();
    }

    /**
     * Make request for getting data.
     *
     * @param string $url
     * @param string $method
     *
     * @return void
     * @throws \Exception
     */
    public function make(string $url, string $method): void
    {
        $this->requesterService = $this->requesterService->request($url, $method);
        if(!$this->data = $this->formatterService->decode($this->requesterService)) throw new \Exception($this->get(['Please check requested URL']));
    }

    /**
     * Filter data.
     *
     * @param string $key
     * @param string $sign
     * @param string $value
     *
     * @return void
     */
    public function where(string $key, string $sign, string $value): void
    {
        $this->data = $this->helperService->select($key, $sign, $value, $this->data);
    }


    /**
     * Sort data.
     *
     * @param string $key
     * @param string $order
     *
     * @return void
     */
    public function sort(string $key, string $order): void
    {
        $this->data = $this->helperService->sort($key, $order, $this->data);
    }

    /**
     * Format data and return.
     *
     * @param array $message
     *
     * @return string
     */
    public function get(array $message=[]): string {
        return $this->formatterService->encode($this->data ?? $message);
    }

    /**
     * Format data and return selected fields.
     *
     * @param array $fields
     *
     * @return string
     */
    public function only(array $fields): string {
        $this->data = $this->helperService->only($fields, $this->data);
        return $this->formatterService->encode($this->data);
    }
}