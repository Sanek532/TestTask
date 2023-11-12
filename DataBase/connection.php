<?php //Файл подключения к БД
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'phptestdb');

$mysql = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysql->connect_errno) die('Ошибка подключения к БД');
$mysql->set_charset('utf8');