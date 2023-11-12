<?php //Получение данных и их подсчет
$urlPosts = "https://jsonplaceholder.typicode.com/posts";
$urlComments = "https://jsonplaceholder.typicode.com/comments";
$jsonDataPosts = file_get_contents($urlPosts);
$jsonDataComments = file_get_contents($urlComments);

$dataPosts = json_decode($jsonDataPosts, true);
$dataComments = json_decode($jsonDataComments, true);

if ($dataPosts && $dataComments) {
    require "./DataBase/connection.php";
    $countPosts = 0;
    $countComments = 0;
    try {
        foreach ($dataPosts as $post) {
            $userId = $post['userId'];
            $postId = $post['id'];
            $postTitle = $mysql->real_escape_string($post['title']);
            $postBody = $mysql->real_escape_string($post['body']);

            $sql = "INSERT INTO posts (userId, id, title, body) VALUES ('$userId', '$postId', '$postTitle', '$postBody')";

            if ($mysql->query($sql)) $countPosts++;
            else echo "Error inserting record: " . $mysql->error . "<br>";
        }

        echo $dataComments;
        foreach ($dataComments as $comment) {
            $id = $comment['id'];
            $postId = $comment['postId'];
            $name = $mysql->real_escape_string($comment['name']);
            $email = $mysql->real_escape_string($comment['email']);
            $body = $mysql->real_escape_string($comment['body']);

            $sql = "INSERT INTO comments (id, postId, name, email, body) VALUES ('$id', '$postId', '$name', '$email', '$body')";

            if ($mysql->query($sql)) $countComments++;
            else echo "Error inserting record: " . $mysql->error . "<br>";
        }

    } catch (Exception $err) {
        echo "Error: " . $err->getMessage();
    } finally {
        $mysql->close();
        $res = "Загружено " . $countPosts . " записей и " . $countComments . " комментариев";
        $script = "<script>console.log('$res');</script>";
        echo $script;
    }


}
