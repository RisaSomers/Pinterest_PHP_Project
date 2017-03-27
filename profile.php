<?php

session_start();

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
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

    <?php include("includes/header.php"); ?>
    <title>Account</title>

    <style>
        .nav li {
            list-style-type: none;
            float: right;
            margin-top: -112px;
        }

        .nav li a {
            text-decoration: none;
        }
    </style>

</head>

<!-- Navigation -->
<?php include("includes/menu.php"); ?>

<body>
<form action="" method="post" enctype="multipart/form-data">
    <br>
    <label for"avatar">Upload je foto!</label>
    <input name="avatar" type="file">
    <input type="submit" value="Upload">
</form>

<img src="uploads/<?php echo $_SESSION["UserName"] ?>.jpg">

<ul class="nav">
    <li>
        <a href="logout.php">Logout</a>
    </li>
</ul>
</body>
</html>
