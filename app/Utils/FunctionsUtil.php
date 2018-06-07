<?php

namespace App\Utils;

class FunctionsUtil
{
    public static function getCurrentTimestamp()
    {
        $curDate = new \Datetime();
        return $curDate->getTimestamp();
    }

    public static function getCurrentDate($date = null)
    {
        $curDate = new \Datetime($date);
        return $curDate->format('Y-m-d H:i:s');
    }
}
