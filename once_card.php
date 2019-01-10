<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Разовое посещение</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
<script src="assets/jquery-3.2.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
<form action="#" method="post">

    <fieldset class="form-group">
        <div class="row">
            <legend class="col-form-label col-sm-2 pt-0">Купить разовую карту</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="card" id="gridRadios1" value="60" checked>
                    <label class="form-check-label" for="gridRadios1">
                        1 час - 85 гривен
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="card" id="gridRadios2" value="120">
                    <label class="form-check-label" for="gridRadios2">
                        2 часа - 145 гривен
                    </label>
                </div>
                <div class="form-check disabled">
                    <input class="form-check-input" type="radio" name="card" id="gridRadios3" value="180">
                    <label class="form-check-label" for="gridRadios3">
                        3 часа - 200 гривен
                    </label><br>
                    <label for="">Каждая "пересиженая" минут будет стоить 1.5 гривны</label>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" name="go">Купить карту</button>
        </div>
    </div>
    <a href="index.php">На главную</a>
</form>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: dobrodeev
 * Date: 19.12.2018
 * Time: 11:11
 */

if (isset($_POST['go']))
{
    $timeCard = $_POST['card'];
    include 'hashFunction.php';
    include 'DB.php';
    do
    {
        $hash_card = hashFunction('a');
    }
    while ($pdo->query("SELECT id_card FROM hour_cards WHERE hash_card='$hash_card'")->rowCount());
    $stmt=$pdo->query("INSERT INTO hour_cards (hash_card, time_card, status_card) VALUES ('$hash_card', '$timeCard', 'active')");
}
?>