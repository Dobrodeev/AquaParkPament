<?php
/**
 * Created by PhpStorm.
 * User: dobrodeev
 * Date: 19.12.2018
 * Time: 11:10
 */
if ($_POST['go'])
{
//    echo 'Nomber of card: '.$_POST['hash_card'];
    $hash_card = $_POST['hash_card'];
    include 'DB.php';
    $stmt = $pdo->query("SELECT id_card FROM hour_cards WHERE hash_card='$hash_card'");
    $name = $stmt->fetchAll();
    if ($name)
    {
//        echo 'OK';
        header('Location: ComeInAquaPark.php');
    }
}
else
{
    echo 'Enter valid number of card.';
}