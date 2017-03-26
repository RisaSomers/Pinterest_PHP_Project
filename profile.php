<?php

session_start();
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    // header('Location: login.php');
    // exit;
}

if(!empty($_FILES)) {
    print_r($_FILES);
    $file = $_SESSION["UserName"];

    $imageType = pathinfo(basename($_FILES["avatar"]["name"]), PATHINFO_EXTENSION);
    $targetFile = "uploads/" . $file . "." . $imageType;

    if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif") {
        $error = "Geen image";
    }

    if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
        $error = "Kon bestand niet verplaatsen";
    }



    die();
}

echo 'Congratulations! You are logged in!';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <input name="avatar" type="file">
    <input type="submit">
</form>

<img src="uploads/<?php echo $_SESSION["UserName"] ?>.jpg">
</body>
</html>
