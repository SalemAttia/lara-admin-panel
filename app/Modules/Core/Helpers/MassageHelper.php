<?php
/**
 * Created by PhpStorm.
 * User: HARBR
 * Date: 11/16/2017
 * Time: 10:55 PM
 */
if(!function_exists('MassageEn')){
    function MassageEn(){
        return  [
            0=>'Successful',
            1=>'Email is already verified',
            2=>'Phone is already exist',
            3=>'Invalid verification code',
            4=>'Invalid Email or password',
            5=>'Email is already exist',
            6=>'Missing some fields',
            7=>'invalid argument Or Missing some fields',
            8=>'Authentication Failed',
            9=>'Slot not found',
            10=>'invalid Current Password',
            11=>'Tanda not found',
            12=>'Slot not found or already taken',
            13=>'Invalid digits',
        ];
    }
}

if(!function_exists('MassageAr')) {

    /**
     * @return array
     */
    function MassageAr(){
        return [
            0=>'نجاح',
            1=>'Email is already verified',
            2=>'Phone is already Exist',
            3=>'Invalid verification code',
            4=>'Invalid Email or Password',
            5=>'Email is already Exist',
            6=>'Missing some fields',
            7=>'invalid argument Or Missing some fields',
            8=>'Authentication Failed',
            9=>'Slot not found',
            10=>'invalid Current Password',
        ];
    }
}

