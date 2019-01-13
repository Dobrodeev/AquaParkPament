<?php
/**
 * Created by PhpStorm.
 * User: dobrodeev
 * Date: 19.12.2018
 * Time: 11:10
 */
session_start();
if ($_POST['go'])
{
    $hash_card = $_POST['hash_card'];
//    echo 'Hash: '.$hash_card.'<br>';
    $firstSymbol = substr($hash_card, 0, 1);
//    echo 'firstSymbol: '.$firstSymbol.'<br>';
    include 'DB.php';
    if ($firstSymbol == 'a')
    {
        $stmt = $pdo->query("SELECT id_card, time_card FROM hour_cards WHERE hash_card='$hash_card'");
        $name = $stmt->fetchAll();
        $_SESSION['time'] = $name[0]['time_card'];
        if ($name)
        {
            header('Location: ComeInAquaPark.php');
        }
    }
    elseif ($firstSymbol == 'b')
    {
        $stmt = $pdo->query("SELECT id_card, balance FROM club_cards WHERE hash_card='$hash_card'");
        $name = $stmt->fetchAll();
//        echo '<pre>';
//        print_r($name);
//        echo '</pre>';
        $_SESSION['balance'] = $name[0]['balance'];
        if ($name)
        {
            header('Location: ComeInAquaPark.php');
        }
    }
    else
    {
        echo 'Else...';
    }
}