<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generateUniqueNo($lenth=12)
    {
        $alphabet       = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass           = array();
        $alphaLength    = strlen($alphabet) - 1;
        for ($i = 0; $i < $lenth; $i++) 
        {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return strtoupper(implode($pass));
    }
    public function ThorEncrypt($string="")
    {
        $temp = '182029320siva1'.$string.'92018';
        return base64_encode($temp);
    }
    public function ThorDecrypt($string="")
    {
        if($string!=0)
        {
            $temp = base64_decode($string);
            $original = substr(explode('siva', $temp)[1], 1,-5);
            return $original;
        }
        else
        {
            return $string;
        }
    }
}
