<?php

namespace App\Requests;

use App\Controllers\BaseResponse;

abstract class BaseRequest
{

    /**
     * This function called if there are any validation errors.
     *
     * @param  array $validation_erros : array holds failed validation messages.
     * @return json
    */
    protected function failedValidation($validation_erros)
    {
        $response = new BaseResponse();
        
        return $response->response(101, 'Validation Errors', $validation_erros);
    }
}
