<?php


namespace App\Service;


class ToUpperUseless
{
    public function toUpperUseless($string) {
        $string = mb_strtoupper($string);
        $hello = "Hello";
        $string = $hello." ".$string." !";

        return $string;
    }
}