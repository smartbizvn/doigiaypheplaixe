<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProcessException extends BaseException
{
    public function __construct(Exception $exception)
    {
        $message = $exception->getMessage();
        $code = is_int($exception->getCode()) && $exception->getCode() !== 0 
            ? $exception->getCode() 
            : Response::HTTP_FORBIDDEN;
        parent::__construct($exception);
    }

    public function render(Request $request)
    {
        $this->trackingLog($request);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $this->getMessage(),
                'code'    => $this->getCode()
            ], $this->getCode());
        }

        $code = $this->getCode();
        $httpCode = ($code >= 100 && $code <= 599) ? $code : 500;

        return response()->view('errors.500', [
            'message' => $this->getMessage()
        ], $httpCode);
    }
}
