<?php

namespace Blog;

class PostMap
{
    public function __construct($mysql)
    {
        $this->mysql = $mysql;
    }

    public function getPosts()
    {
        try {
            $sql = 'SELECT * FROM posts';
            $res = $this->mysql->query($sql);
            while ($row = $res->fetch_assoc()) {
                $dataPosts[] = $row;
            }
            return $dataPosts;
        } catch (\Exception $err) {
            die('Ошибка при получении постов');
        }
    }

    public function getComments($postId)
    {
        try {
            $sql = "SELECT * FROM comments WHERE postId='$postId'";
            $res = $this->mysql->query($sql);
            while ($row = $res->fetch_assoc()) {
                $dataComments[] = $row;
            }
            return $dataComments;
        } catch (\Exception $err) {
            die('Ошибка при получении комментариев');
        }
    }

}