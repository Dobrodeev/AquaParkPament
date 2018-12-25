<?php
/**
 * Created by PhpStorm.
 * User: dobrodeev
 * Date: 20.12.2018
 * Time: 11:00
 */
$host = '127.0.0.1';
$db   = 'Aquapark';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,];
$pdo = new PDO($dsn, $user, $pass, $opt);