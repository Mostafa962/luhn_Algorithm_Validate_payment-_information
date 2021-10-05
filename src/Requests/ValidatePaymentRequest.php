<?php

namespace App\Requests;

use App\Helpers\LuhnAlgorithm;

class ValidatePaymentRequest extends BaseRequest
{
    private $data;

    public function __construct($data)
    {

        $this->data = $data;
    }

    /**
     * Validate Payment inputs.
     *
     * @return json?json:null; 
    */

    public function rules()
    {
        $data                = $this->data;
        $validation_messages = [];

        //payment method validation.
        $payment_method        = array_key_exists('payment_method', $data) ? $data['payment_method'] : null;
        if(! $payment_method  || ( $payment_method !== "phone" && $payment_method !== "credit_card") )
            $validation_messages[] = 'Payment method must be phone number or credit card !';
        
        switch($payment_method)
        {
            case  "phone" : 
            {
                //phone number validation.
                if( !array_key_exists('phone_number', $data) || !$data['phone_number'])
                    $validation_messages[] = 'Phone number is required !';
                if(array_key_exists('phone_number', $data) && $data['phone_number'] && !preg_match("/^01[0-2,5]{1}[0-9]{8}$/", $data['phone_number'] ))
                    $validation_messages[] = 'Invalid Phone Number !';
                break;
            }
            case "credit_card" :
            {
                //credit card validation.
                if( !array_key_exists('card_number', $data) || !$data['card_number'])
                    $validation_messages[] = 'Card number is required !';
                if(array_key_exists('card_number', $data) && $data['card_number'])
                {
                    $number  = preg_replace('/\D/', '', $data['card_number']);
                    if(!LuhnAlgorithm::isValid($number))
                        $validation_messages[] = 'Invalid Card Number !';
                }
                //expiration date validation.
                if( !array_key_exists('expiration_date', $data) || !$data['expiration_date'])
                    $validation_messages[] = 'Expiration date is required !';
                if(array_key_exists('expiration_date', $data) && $data['expiration_date'])
                {
                    $month = substr($data['expiration_date'], 0,2);
                    $year = substr($data['expiration_date'], 3);
                    if(strlen($month) !== 2 || strlen($year) !== 2)
                        $validation_messages[] = 'Invalid Expiration Date !';
                    elseif(strtotime( substr(date('Y'), 0, 2)."{$year}-{$month}" ) < strtotime( date("Y-m")  ))
                        $validation_messages[] = 'Your credit card is expired !';
                }

                //cvv2 validation.
                if( !array_key_exists('cvv2', $data) || !$data['cvv2'])
                    $validation_messages[] = 'CVV2 is required !';
                if(array_key_exists('cvv2', $data) && $data['cvv2'] && !preg_match("/^[0-9]{3}$/", $data['cvv2']) )
                    $validation_messages[] = 'Invalid CVV2 !';

                //email validation.
                if( !array_key_exists('email', $data) || !$data['email'])
                    $validation_messages[] = 'Email is required !';
                if(array_key_exists('email', $data) && $data['email'] && ! filter_var($data['email'], FILTER_VALIDATE_EMAIL) )
                    $validation_messages[] = 'Invalid Email !';
                break;
            }
            default:
                if(count($validation_messages))
                    return $this->failedValidation($validation_messages);
            
        }
        if(count($validation_messages))
            return $this->failedValidation($validation_messages);
        return 0;
    }

}
