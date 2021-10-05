<?php
namespace App\Helpers;

class LuhnAlgorithm
{
    /**
     * Validate cc number.
     *
     * @param int $number : cc number.
     * @return bool
     */
    public static function isValid($number)
    {
        $sum    = 0;
        $length = strlen($number);
        $parity =  $length % 2;
        for ($i=0; $i < $length; $i++)
        {
            $digit = intval($number[$i]);
            if ($i % 2 == $parity){
                $digit *=  2;
                if ($digit > 9)
                    $digit-=9;
            }
            $sum +=$digit;
        }
        return $sum% 10 == 0;
    }

}
