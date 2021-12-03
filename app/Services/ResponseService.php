<?php

namespace App\Services;

class ResponseService
{
    /**
     * @var
     */
    private $success;

    /**
     * @var
     */
    private $message;

    /**
     * @param $success
     * @param $message
     */
    public function __construct($success, $message)
    {
        $this->success = $success;
        $this->message = $message;
    }

    /**
     * @param $success
     * @param $message
     * @return ResponseService
     */
    public static function response($success, $message): ResponseService
    {
        return new ResponseService($success, $message);
    }

    /**
     * @return boolean
     */
    public function getSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}