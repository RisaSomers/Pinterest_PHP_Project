<?php

    header('Content-Type: application/json');

    include_once("../classes/comments.class.php");

        $comments = new Comments();

        //controleer of er een update wordt verzonden
    if(!empty($_POST['activitymessage'])){
        $comments->Text = $_POST['activitymessage'];
        try{
            $comments->Save($_POST["item_id"]);
            $feedback = [
                "code" => 200,
                "message" => htmlspecialchars( $_POST['update'] )
            ];
        }
        catch (Exception $e){
            $error = $e->getMessage();
            $feedback = [
                "code" => 500,
                "message" => $error
            ];
        }

        echo json_encode($feedback); // {"code": 500, "message:"}
    }


?>