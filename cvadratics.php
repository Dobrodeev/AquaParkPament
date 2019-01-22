<?php
/**
 * Created by PhpStorm.
 * User: Zver
 * Date: 22.01.2019
 * Time: 10:42
 */
$N = 15;
$center = ceil($N /2);
echo $center.'<br>';
for ($i = 0; $i < $N; $i++ )
{
    for ($j = 0; $j < $N; $j++)
    {
//        if (($i == $j || $j == $N - 1 -$i) && !($i == $j && $j == $N - 1 -$i))
        if ($i == $j ^ $j == $N - 1 -$i)
        {
            echo 'X';
        }
        else
        echo '0';
    }
    echo '<br>';
}