<?php
?>
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
    <!--Форма для ввода номера карты и входа в зону отдыха-->
    <form action="#" method="post">
        <input type="text" name="hash_card" value="" placeholder="Номер карты"><br>
        <input type="text" name="time" value="" placeholder="превышение времени"><br>
        <input type="submit" name="go" value="Exit"><br>
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
if ($_POST['go'])
{
    $hash_card = $_POST['hash_card'];
    $firstSymbol = substr($hash_card, 0, 1);
    include 'DB.php';
    if ($firstSymbol == 'a')
    {
        $table = 'hour_cards';
//        $stmt = $pdo->query("UPDATE hour_cards SET status_card='noactive'");
        // разовая карта станет неактивной в любом случае, если пользователь пересидел
        //свое время - пусть заплатит 1.5 гривны за минуту. Записать деньги в статистику
    }
    else
    {
        $table = 'club_cards';
//        $stmt = $pdo->query("UPDATE club_cards SET status_card='active'");
        // если пользователь пробыл дольше положенного, пусть запишется минус на карту
        // в БД сделать UPDATE club_cards SET balance = X
    }
    $queryTime = "SELECT time_card FROM $table WHERE hash_card='$hash_card'";
    $stmt = $pdo->query($queryTime);
    /** @var
     * Подсчет пересиженого времени$queryUpdate
     */
    $queryUpdate = "UPDATE $table SET status_card='noactive'";
    $stmt = $pdo->query($queryUpdate);
}
?>