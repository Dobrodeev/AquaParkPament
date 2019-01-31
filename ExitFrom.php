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
    <img src="template/images/1cb9f5296c7400988b86167e065f4701.jpg" alt="in AquaPark">
    <form action="#" method="post">
        <input type="text" name="hash_card" value="" placeholder="Номер карты"><br>
        <input type="text" name="time" value="" placeholder="провели всего минут"><br>
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
    $time = $_POST['time'];
    $firstSymbol = substr($hash_card, 0, 1);
    include 'DB.php';
    if ($firstSymbol == 'a')
    {
        $table = 'hour_cards';
        $queryTime = "SELECT time_card FROM $table WHERE hash_card='$hash_card'";
        $stmt = $pdo->query($queryTime);
        $resultTime = $stmt->fetchColumn();
        if ($resultTime < $time)
        {
            $pay = 1.5*($time - $resultTime);
            echo 'Доплатите '.$pay.' гривен.';
            $queryFromStatistics = "SELECT income, people_now FROM statistics";
            $stat = $pdo->query($queryFromStatistics);
            $resStat = $stat->fetchAll();
            echo '<pre>';
            print_r($resStat);
            echo '</pre>';
            $income = $resStat[0]['income'] + $pay;
            $people = $resStat[0]['people_now'] - 1;
            $resIncome = $pdo->query("UPDATE statistics SET income='$income', people_now='$people'");
        }
    }
    else
    {
        $table = 'club_cards';
        $queryTime = "SELECT balance FROM $table WHERE hash_card='$hash_card'";
        $stmt = $pdo->query($queryTime);
        $resultBalance = $stmt->fetchColumn();
        if ($time > 60)
        {
            $pay = $time - 60;
            echo 'Доплатите '.$pay.' гривен.';
            $resultBalance -= $pay;
            $queryClubCards = "UPDATE club_cards SET balance='$resultBalance', status_card='noactive' WHERE hash_card='$hash_card'";
            $resultClubCards = $pdo->query($queryClubCards);
            $queryFromStatistics = "SELECT income, people_now FROM statistics";
            $stat = $pdo->query($queryFromStatistics);
            $resStat = $stat->fetchAll();
            $income = $resStat[0]['income'] + $pay;
            $people = $resStat[0]['people_now'] - 1;
            $resIncome = $pdo->query("UPDATE statistics SET income='$income', people_now='$people'");
        }
    }
}
?>