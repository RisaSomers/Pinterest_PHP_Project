<?php

spl_autoload_register(function($class){
    include_once("../classes/".$class.".class.php");
});

    $conn = Db::getInstance();

    $no = $_POST['getresult'];

    $statement = $conn->prepare("SELECT * FROM items ORDER BY id DESC limit $no,20");
    $statement->execute();
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach( $items as $key => $row ){
 
            echo "
                           <h2>" . $row['Beschrijving'] . "</h2>
                           <a href='detail.php?id=" . $row['id'] . "'>
                           
                               <div class='post_img'>
                                   <img src='uploads/posts/" . $row['Image'] . "' alt='" . $row['id'] . "'>
                               </div>
                           </a>
                           
                           
                       ";
        
    }

