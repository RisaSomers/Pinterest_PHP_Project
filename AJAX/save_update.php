<?php
    session_start();
    header('Content-Type: application/json');

spl_autoload_register(function ($class) {
    include_once("../classes/".$class.".php");
});
        $activity = new Activity();
        $user = new User();

       
  if (!empty($_POST['update'])) {
      $activity->Text = $_POST['update'];
      $commentUser = $user->getAllUser()['firstname'];
      $commentUserId = $user->getAllUser()['id'];
      $avatar = $user->getAllUser()['avatar'];
      try {
          $activity->Save();
          $feedback = [
                "code" => 200,
                "message" => htmlspecialchars($_POST['update']),
                "user" => $commentUser,
                "id" => $commentUserId,
                "avatar" => $avatar
            ];
      } catch (Exception $e) {
          $error = $e->getMessage();
          $feedback = [
                "code" => 500,
                "message" => $error
            ];
      }

      echo json_encode($feedback); 
  }
