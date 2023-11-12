<?php
require './src/PostMap.php';
require './DataBase/connection.php';
use Blog\PostMap;

$postMap = new PostMap($mysql);

session_start();
if (!empty($_SESSION['minChar'])){
    echo $_SESSION['minChar'];
    $posts = [];
}

$posts = $postMap->getPosts();

session_unset();

$count = 0;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="FindPost.php" method="get">
    <label for="search">Поиск:</label>
    <input type="text" id="search" name="search" placeholder="Введите ключевое слово">
    <button type="submit">Искать</button>
</form>

    <? if (sizeof($posts) > 0) {?>
<ul class="post-list">
        <? foreach ($posts as $post) { $count++;
            $comments = $postMap->getComments($post['id']);?>
            <li class="post-item">
                <div>
                    <h1><?echo $post['id']?></>
                    <h2><? echo $post['title']?></h2>
                    <p><? echo $post['body']?></p>
                </div>

            <div class="comment-list">
            <? foreach ($comments as $comment) {?>
                <div class="comment-item">
                    <h3><? echo $comment['name']?></h3>
                    <h4><? echo $comment['email']?></h4>
                    <p><? echo $comment['body']?></p>
                </div>
            <?}?>
            </div>
            </li>
        <?}?>
</ul>
    <?} else {?>
    <h2>Постов пока нет</h2>
    <?}?>
<?echo 'ПОСТОВ: '. $count;?>
</body>
</html>
