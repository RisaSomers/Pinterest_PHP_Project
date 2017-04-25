<?php

spl_autoload_register(function ($class) {
    include_once("../classes/".$class.".class.php");
});

    $conn = Db::getInstance();

    $no = $_POST['getresult'];

    $statement = $conn->prepare("SELECT * FROM items ORDER BY id DESC limit $no,20");
    $statement->execute();
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($items as $key => $row) {
        $pp = new Items();
        $pp->setId($row["id"]);
        $likes = $pp->getLike();
        $dislikes = $pp->getDislike();
        echo "<h2>" . $row['Beschrijving'] . "</h2>  
                           <a href='detail.php?id=" . $row['id'] . "'>
                           
                               <div class='post_img'>
                                   ";
        if (!empty($row['Url'])) {
            echo "<img src='" . $row['Url'] . "' alt='" . $row['id'] . "'>";
        } else {
            echo "<img src='uploads/posts/" . $row['Image'] . "' alt='" . $row['id'] . "'>";
        }
        echo "
                               </div>
                           </a>
                           <a href='#' class='like' data-id='". $row["id"] . "'>LIKE - " . $likes . "</a>
                           <a href='#' class='dislike' data-id='". $row["id"] . "'>DISLIKE - " . $dislikes . "</a>";
    }
