<?php //Создание таблиц в БД

require "./DataBase/connection.php";

$sql = "CREATE TABLE IF NOT EXISTS posts (
    id INT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    userId INT NOT NULL
)";

if ($mysql->query($sql)) {
    echo "Таблица успешно создана";
} else {
    echo "Ошибка при создании таблицы: " . $mysql->error;
}



$sql = "CREATE TABLE IF NOT EXISTS comments (
    `id` INT PRIMARY KEY,
    `postId` INT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `body` TEXT NOT NULL,
    FOREIGN KEY (`postId`) REFERENCES posts(`id`) ON DELETE CASCADE)";

if ($mysql->query($sql)) {
    echo "Таблица успешно создана";
} else {
    echo "Ошибка при создании таблицы: " . $mysql->error;
}

$mysql->close();