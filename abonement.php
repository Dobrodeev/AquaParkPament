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
    $firstSymbol = substr($hash_card, 0, 1);

    require_once 'DB.php';
    if ($firstSymbol == 'a')
    {
        $stmt = $pdo->query("SELECT id_card, time_card FROM hour_cards WHERE hash_card='$hash_card'");
        $name = $stmt->fetchAll();
        if ($name[0]['status_card'] == 'active')
        {
            $stmt = $pdo->query("UPDATE hour_cards SET status_card='inuse' WHERE hash_card='$hash_card'");
            $_SESSION['time'] = $name[0]['time_card'];
            if ($name)
            {
                header('Location: ComeInAquaPark.php');
            }
        }
    }
    elseif ($firstSymbol == 'b')
    {
        $stmt = $pdo->query("SELECT id_card, balance FROM club_cards WHERE hash_card='$hash_card'");
        $name = $stmt->fetchAll();
        if($name[0]['status_card'] == 'active')
        {
            $stmt = $pdo->query("UPDATE club_cards SET status_card='inuse'");
            $_SESSION['balance'] = $name[0]['balance'];
            if ($name)
            {
                header('Location: ComeInAquaPark.php');
            }
        }
    }
    echo 'Карта уже используется.';
}