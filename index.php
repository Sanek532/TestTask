<?php

$request_url = $_SERVER['REQUEST_URI'];

// Определение роутов
switch ($request_url) {
    case '/':
        // Обработка корневого URL
        require "./home.php";
        break;
    case '/create':
        // Обработка URL "/create"
        require "./DataBase/CreateTables.php";
        break;
    case '/storedata':
        // Обработка URL "/storedata"
        require "./DataBase/StoreData.php";
        break;
    default:
        // Если URL не соответствует ни одному роуту
        header('HTTP/1.0 404 Not Found');
        echo '404 Страница не найдена';
        break;
}