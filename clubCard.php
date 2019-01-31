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
        <label for="formGroupExampleInput">Пополнение карты</label>
        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="ID карты" name="IDclubCard" value="">
        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="пополнить баланс" name="BalanceclubCard" value="">
        <input type="submit" name="run" value="Пополнить карту">
    </div>
    <label for="formGroupExampleInput">Покупка карты</label>
    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="пополнить баланс" name="clubCard" value="">
    <input type="submit" name="go" value="Купить карту">
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
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';
if ($_POST['go'])
{
    if (isset($_POST['clubCard']))
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
        $queryIncome = "SELECT income FROM statistics";
        $resultIncome = $pdo->query($queryIncome);
        $res = $resultIncome->fetchColumn();
        $res += $balance;
        $queryStatistics = "UPDATE statistics SET income='$res'";
        $resultStatistics = $pdo->query("UPDATE statistics SET income='$res'");
        echo 'Пополнили карту '.$hash_card.' на '.$balance,' гривен. <br>';
    }
}

if ($_POST['run'])
{
    if (isset($_POST['IDclubCard']) && isset($_POST['BalanceclubCard']))
    {
        $id = $_POST['IDclubCard'];
        $balance = $_POST['BalanceclubCard'];
        include 'DB.php';
        $query = "SELECT * FROM club_cards WHERE hash_card='$id'";
        $stmt = $pdo->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result)
        {
            $queryFromStatistics = "SELECT income FROM statistics";
            $res = $pdo->query($queryFromStatistics);
            $incomeResult = $res->fetchColumn();
            $incomeResult += $balance;
            $resIncome = $pdo->query("UPDATE statistics SET income='$incomeResult'");
//            $resultStatistics = $pdo->query("UPDATE statistics SET income='$balance'");
            $balance += $result[0]['balance'];
            $queryPay = "UPDATE club_cards SET balance='$balance' WHERE hash_card='$id'";
            $result = $pdo->query($queryPay);
            echo 'Баланс на карте '.$id.' теперь '.$balance,' гривен. <br>';

        }
        else
            echo 'Нет такой карты.';
    }
}
?>