<?php

    header('Content-Type: application/json');
    include_once("../classes/comments.class.php");
        $activity = new Activity();

        //controleer of er een update wordt verzonden
    if(!empty($_POST['update'])){
        $activity->Text = $_POST['update'];
        try{
            $activity->Save();
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