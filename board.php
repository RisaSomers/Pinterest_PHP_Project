<?php

spl_autoload_register(function ($class) {
    include_once("../classes/".$class.".php");
});

if (!empty($_POST)) {
    try {
        // create prepared statement
        $newBoard = new Boards();
        $newBoard->setBoardName($_POST["boardTitle"]);
        $newBoard->create();
        echo "Item is created";
        header("Location: index.php?success=true");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
