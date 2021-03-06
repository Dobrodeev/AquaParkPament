<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Statistics AquaPark</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
<h4>Статистика</h4>
<script src="assets/jquery-3.2.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
<a href="index.php">На главную</a>
</body>
</html>
<?php
/**
 * Created by PhpStorm.
 * User: dobrodeev
 * Date: 25.12.2018
 * Time: 11:31
 */
/**
 * Сколько куплено разовых абонементов
 * Сколько клубных карт и на какую сумму
 * Сумарное количество проданых абонементов в месяц
 * Статистика по месяцам
 * Приложение фиксирует общий оборот и количество посетителей, посетивших аквапарк.
Эта программа перечисляет программу до окончания (меню «Конец»), в том числе
Расчетная прибыль аквапарка на одного посетителя (примечание: средняя
значение не является целым числом).
 */
echo '<br>';
include 'DB.php';
$stmt = $pdo->query("SELECT * FROM statistics");
while ($row = $stmt->fetch())
{
    echo 'Прибыль за все время: <br>';
    printf('%.2f',$row['income']);
    echo ' гривен <br>';
        echo ' Людей за все время посетило аквапарк: '.$row['all_visits'];
        echo ' человек(а)<br>';
            echo 'Средеее время посещения: <br>';
            printf('%d',($row['all_time']/$row['all_visits'])/60);
            echo ' часа ';
            printf('%02d', ($row['all_time']/$row['all_visits'])%60);// 3 часа 03 мин
            echo ' минут(ы) <br>';
                echo ' Всего людей в аквапарке сейчас: '.$row['people_now'].'<br>';
}
/*
$min = 3425;

$y = 31.1;
$adr = 8743526;
$town = 'NewYork';

echo $x . '</br>';
echo $y . '</br>';

printf("time: %d:%02d <br>fgdsfdg  %.2f  fdg<br>%08X<br>Town is %s<br>",
    $min/60, $min%60, $y, $adr, $town);


$a = 0.0001 + 0.0001 + 0.0001;
if ($a == 0.0003)
    printf("YES!<br>");
else
    printf("%.20f  <br>",$a);

$str = sprintf("time: %d:%02d <br>fgdsfdg  %.2f  fdg<br>%08X<br>Town is %s<br>",
    $min/60, $min%60, $y, $adr, $town);

echo $str;
**/
?>