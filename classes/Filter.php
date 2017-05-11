<?php
abstract class Filter {
    public static function mostLikes() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("
                    select DISTINCT i.id, i.Image, i.Url, i.Beschrijving, l.post_id,l.user_id, i.uploaded,count(l.id) from items i
                    inner join likes l ON i.id = l.post_id
                    WHERE status = true
                    GROUP BY l.post_id
                    order by count(l.id) DESC limit 0,20");
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function mostDislikes() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("
                    select DISTINCT i.id, i.Image, i.Url, i.Beschrijving, l.post_id,l.user_id, i.uploaded,count(l.id) from items i
                    inner join dislikes l ON i.id = l.post_id
                    WHERE status = true
                    GROUP BY l.post_id
                    order by count(l.id) DESC limit 0,20");
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function getDefault() {
        $conn = Db::getInstance();
        $statement = $conn->prepare("select * from items WHERE status = true order by id DESC limit 0,20");
        $statement->execute();
        return $statement->fetchAll();
    }
}