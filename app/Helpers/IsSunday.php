<?php
namespace App\Helpers;


class IsSunday
{
    public static function check($date) {

       return (date('N', strtotime($date)) >= 7);
    }
}
