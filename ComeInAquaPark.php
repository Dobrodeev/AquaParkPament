<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>На выходе</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" media="screen">
</head>
<body>
<script src="assets/jquery-3.2.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
<img src="template/images/1cb9f5296c7400988b86167e065f4701.jpg" alt="in AquaPark">
<form action="#" method="post">
    <label for="">Провели мвремени в зоне</label><br>
    <input type="text" name="total_time" value="" placeholder="минут"><br>
    <input type="submit" name="go" value="Пощитать"><br>
    <a href="index.php">На главную</a>
</form>
</body>
</html>
<?php
    echo 'Всего стоимость: '.$_POST['total_time'].' гривны';
?>