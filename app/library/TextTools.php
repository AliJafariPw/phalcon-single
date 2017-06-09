<?php

namespace Application\Lib;

use Phalcon\Mvc\User\Component;

class TextTools extends Component
{
    public static function truncate($str , $limit = 200, $end_with = " ..."){
        if (mb_strlen($str) <= $limit)
            return trim(strip_tags($str));
        return trim(strip_tags(mb_substr($str, 0 , strrpos(mb_substr($str , 0 , $limit), " ")))).$end_with;
    }

    public static function rand($min=0,$max=1){
        return rand($min,$max);
    }
}