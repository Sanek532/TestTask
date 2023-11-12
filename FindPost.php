<?php
require './DataBase/connection.php';


try {
    $text = $_GET["search"];
    session_start();
    if (isset($text) && strlen($text) > 2) {
        $sql = "SELECT c.postId, c.body AS com_body, p.id, p.title
FROM comments c
JOIN posts p ON c.postId = p.id
WHERE c.body LIKE '%$text%'";

        $res = $mysql->query($sql);
        if ($res && $res->num_rows > 0) {
            echo "<div>";

            while ($row = $res->fetch_assoc()) {
                $commentBody = $row['comment_body'];
                $postBody = $row['post_body'];

                echo "<div>";
                echo "<h3>Post title: " . $row['title'] . "</h3>";
                    echo "<p>Comment: " . $row['com_body'] . "</p>";
                    echo "</div>";

            }

            echo "</div>";

        } else echo "Записей не найдено";
    } else {
        $_SESSION['minChar'] = "ВВведите минимум 3 символа";
        header("Location: home.php");
    }

} catch (Exception $err) {
    die('Не удалось выполнить поиск постов');
} finally {
    $mysql->close();
}
