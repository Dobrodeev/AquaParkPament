<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Come In AquaPark</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
<script src="assets/jquery-3.2.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
<form action="abonement.php" method="post">
    <input type="text" name="hash_card" value="" placeholder="Номер карты"><br>
    <input type="submit" name="go" value="Come In AquaPark"><br>
    <a href="index.php">На главную</a>
</form>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: dobrodeev
 * Date: 25.12.2018
 * Time: 11:10
 */
// if() карта активна -> inuse
// на выходе ввести 50 мин
//echo 'Come in';
?>