<?php

namespace Atom\Core\Concerns;

class RegistersExceptionHandlers
{
    public function registerErrorHandling()
    {
        error_reporting(-1);
        set_error_handler(function ($level, $message, $file = '', $line = 0) {
            $this->errorHandler($level, $message, $file, $line);
        });
        set_exception_handler(function ($e) {
            $this->errorException($e);
        });
    }

    public function errorHandler($level = 0, $message = '', $file = '', $line = 0)
    {
        $response = [
            'error' => [
                'message' => $message,
                'level' => $level,
                'file' => $file,
                'line' => $line,
            ]
        ];

        // Send JSON-encoded error response
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
    public function errorException($e)
    {
        $response = [
            'error' => [
                'message' => $e->getmessage(),

            ]
        ];
        http_response_code(500);
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}
