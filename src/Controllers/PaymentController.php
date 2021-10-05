<?php

namespace App\Controllers;

use App\Requests\ValidatePaymentRequest;

class PaymentController
{
    /**
     * Get payment data,validate it.
     * Payment type can be phone or credit card.
     *
     * @param array $request : array hold input data.
     * @return json?json:boolean
    */
    
    public function store($request)
    {
        $validate = new ValidatePaymentRequest($request);
        if($validate->rules())
            return $validate->rules();
        return true;
    }
}
