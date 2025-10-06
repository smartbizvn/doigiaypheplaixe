<?php

namespace App\Exceptions;

use Exception;
use App\Helpers\Helper;

class BaseException extends Exception
{
    protected Exception $exception;

    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
        $code = $exception->getCode();
        $code = is_int($code) && $code > 0 ? $code : 500;
        parent::__construct(
            $exception->getMessage(),
            $code,
            $exception
        );
    }

    public function trackingLog($request): void
    {
        $errorLog = [
            'module' => $request->getMethod(),
            'action' => $request->getRequestUri(),
            'msg_log' => $this->formatMessage()
        ];

        Helper::trackingError($errorLog);
    }

    protected function formatMessage(): string
    {
        return function_exists('getMessage')
            ? getMessage($this->exception)
            : $this->exception->getMessage();
    }
}
