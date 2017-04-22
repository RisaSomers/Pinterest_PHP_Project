<?php
    session_start();
    header('Content-Type: application/json');
    include_once("../classes/Db.class.php");
    include_once("../classes/Activity.class.php");
include_once("../classes/users.class.php");
        $activity = new Activity();
        $user = new users();

        //controleer of er een update wordt verzonden
    if(!empty($_POST['update'])){
        $activity->Text = $_POST['update'];
        $commentUser = $user->getAllUser()['firstname'];
        try{
            $activity->Save();
            $feedback = [
                "code" => 200,
                "message" => htmlspecialchars( $_POST['update']),
                "user" => $commentUser
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