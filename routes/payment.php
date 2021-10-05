<?php

use App\Controllers\PaymentController;
use App\Controllers\BaseResponse;

    $response = new BaseResponse();
    $headers = apache_request_headers();
    
    //validate Authorization
    $token = "ZrZ8GpV8UbJbIG4aChNmx2EHc8khsdKa2xjDP7INzPypp6Ic9kPXwaWAQ5gHRHnxJiO3otpUo64LaPPi";
    if(!is_array($headers) || !array_key_exists('Authorization',$headers) || $headers['Authorization'] !== $token)
    {
        echo $response->response(401,"Unauthorized Access !");
        exit;
    }

    //validate data input format(must be JSON or XML)
    if($_SERVER['CONTENT_TYPE'] != 'application/json' && $_SERVER['CONTENT_TYPE'] != 'application/xml')
    {
        echo $response->response(500,"Invalid Input !");
        exit;
    }

    //validate request input
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $content = trim(file_get_contents('php://input'));
        
        if($_SERVER['CONTENT_TYPE'] == 'application/json')
            //true :  objects returned will be converted into associative arrays
            $data = json_decode($content, true);
    
        if($_SERVER['CONTENT_TYPE'] == 'application/xml')
        {
            $json = json_encode(simplexml_load_string($content));
            $data = json_decode($json,TRUE);
        }
    
        if(!isset($data) || ! is_array($data))
        {
            echo $response->response(500,"Invalid Input !");
            exit;
        }

        $payment = new PaymentController();
            echo $payment->store($data);
        exit;
    }
    else
        echo $response->response(500,"Invalid Input !");

