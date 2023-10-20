<?php
/**
 * Created by PhpStorm.
 * User: Narek
 * Date: 10/8/2018
 * Time: 6:49 PM
 */

namespace app\components;

class Helper {
    public static function generateRandomString($length = 15)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}