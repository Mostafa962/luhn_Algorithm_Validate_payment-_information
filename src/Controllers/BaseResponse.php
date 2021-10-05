<?php

namespace App\Controllers;

class BaseResponse 
{
    /**
     * This function used in all responses to any restful api request.
     *
     * @param  int $statusCode : code the be 200 in valid response, 101 in failed validation
     * @param  string $message : Text message
     * @param  array $validations : array hold failed validation messages
     * @param  object $object : object that hold any data needed
     * @return json
    */
    public function response($statusCode, $message, $validations = [], $object = null)
    {
        
        // headers to tell that result is JSON
        header('Content-type: application/json');
        // header('HTTP/1.1 500 Internal Server Error');
        return json_encode(
            [
                'code'       => $statusCode, 
                'message'    => $message,
                'validation' => $validations,
                'data'       => $object
            ]);
    }
}
