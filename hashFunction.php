<?php
/**
 * Created by PhpStorm.
 * User: dobrodeev
 * Date: 21.12.2018
 * Time: 10:47
 */
function hashFunction($prefix, $length = 6)
{
    $string = $prefix.'';
    for ($i = 0; $i < $length; $i ++)
    {
        if (mt_rand(1, 3) == 1)
        {
            $string .= mt_rand(0, 9);
        }
        else
        {
            $string .= chr(97 + mt_rand(0, 25));
        }
    }
    return $string;
}