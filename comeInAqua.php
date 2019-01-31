<?php
//session_start();
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
    <input type="submit" name="go" value="Come in Aqua"><br>
    <a href="index.php">На главную</a>
</form>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: dobrodeev
 * Date: 19.12.2018
 * Time: 11:10
 */
if ($_POST['go'])
{
    $hash_card = $_POST['hash_card'];
    $firstSymbol = substr($hash_card, 0, 1);
    /** проверка может ли зайти, если нет то указать причину
     *он зашел, оформить вход active -> inuse
     */
    require_once 'DB.php';
    if ($firstSymbol == 'a')
    {
        $tableName = 'hour_cards';
        $fieldName = 'time_card';
    }
    else
    {
        $tableName = 'club_cards';
        $fieldName = 'balance';
    }
    $stmt = $pdo->query("SELECT * FROM $tableName WHERE hash_card='$hash_card'");
    if (!$stmt->rowCount())
    {
        exit('No card');
    }
    $name = $stmt->fetchAll();

    if ($firstSymbol == 'a' && $name[0]['time_card'] > 0)
    {
        echo 'Come in.<br>';
        $temp = - $name[0]['time_card'];
        $stmt = $pdo->query("UPDATE $tableName SET time_card='$temp' WHERE hash_card='$hash_card'");
        $queryStatistics = "SELECT people_now FROM statistics";
        $resultStatisctics = $pdo->query($queryStatistics);
        $res = $resultStatisctics->fetchColumn();
        $res ++;
        $queryStat = "UPDATE statistics SET people_now='$res'";
        $resultStat = $pdo->query($queryStat);
    }
    elseif ($firstSymbol == 'b' && $name[0]['status_card'] == 'active')
    {
        if ($name[0]['balance'] > 80)
        {
            echo 'Come in.<br>';
            $balanceNew = $name[0]['balance'] - 80;
            $stmt = $pdo->query("UPDATE $tableName SET status_card='inuse', balance='$balanceNew' WHERE hash_card='$hash_card'");
            $queryStatistics = "SELECT people_now FROM statistics";
            $resultStatisctics = $pdo->query($queryStatistics);
            $res = $resultStatisctics->fetchColumn();
            $res ++;
            $queryStat = "UPDATE statistics SET people_now='$res'";
            $resultStat = $pdo->query($queryStat);
        }
        else
            echo 'Недостаточно средств на карте. <br>';
    }
    else
        echo 'Карта уже используеться. <br>';
//    header('Location: ComeInAquaPark.php');
    /**
     * сколько зашло людей, сколько денег заплачено
     */
}