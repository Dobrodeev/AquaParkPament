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
    include 'DB.php';
    $stmt = $pdo->query("SELECT id_card, time_card FROM hour_cards WHERE hash_card='$hash_card'");
//    $time = $pdo->query("SELECT time_card FROM hour_cards WHERE hash_card='$hash_card'");
//    $_SESSION['time']= $time;
//    print_r($_SESSION);
    $name = $stmt->fetchAll();
//    echo '<pre>';
//    print_r($name);
//    echo '</pre>';
    $_SESSION['time'] = $name[0]['time_card'];
//    print_r($_SESSION);

    if ($name)
    {
        header('Location: ComeInAquaPark.php');
    }
    else
    {
        echo 'Else...';
    }
    /*** */
}