<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Club Card</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
<script src="assets/jquery-3.2.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
<form method="post" action="">
    <div class="form-group">
        <label for="formGroupExampleInput">Клубная(предопдлаченая) карта</label>
        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="пополнить баланс" name="clubCard" value="">
        <input type="submit" name="go" value="Купить карту">
    </div>
</form>
<a href="index.php">На главную</a><br>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: dobrodeev
 * Date: 25.12.2018
 * Time: 11:32
 */
//echo 'Пополнили на '.$_POST['clubCard'].' гривен <br>';
if ($_POST['go'])
{
    $balance = $_POST['clubCard'];
    include 'hashFunction.php';
    include 'DB.php';
    do
    {
        $hash_card = hashFunction('b');
    }
    while ($pdo->query("SELECT id_card FROM club_cards WHERE hash_card='$hash_card'")->rowCount());
    $stmt=$pdo->query("INSERT INTO club_cards (hash_card, status_card, balance) VALUES ('$hash_card', 'active', '$balance')");
}
?>