<?php

include_once ('classes/board.class.php');

if(!empty($_POST)){
    try {
        // create prepared statement
        $newBoard = new boards();
        $newBoard->setBoardName($_POST["boardTitle"]);
        $newBoard->create();
        echo "Item is created";
        header("Location: index.php?success=true");

    }
    catch (Exception $e) {
        echo $e->getMessage();
    }
}




