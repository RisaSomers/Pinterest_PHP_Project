<?php





include_once("classes/user.php");
include_once("classes/profilechange.class.php");
include_once("classes/profilechange.class.php");
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





include_once ("classes/Db.class.php");
include_once("classes/user.php");
include_once("classes/profilechange.class.php");

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}

$a = new profilechange();
$allusers = $a->getAll();

$conn = Db::getInstance();

$statement = $conn->prepare("SELECT * FROM Users WHERE id=:id");

$statement->bindParam(':id',$_SESSION['id']);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

try
{
    if (!empty($_POST['btn-changes']))
    {
        $a->checkPass($_POST['pass'], $_POST['pass_rep']);
        $a->update($_POST['UserName'],$_POST['Email'], $_POST['pass']);
    }
}
catch(Exception $e)
{
    $error = $e->getMessage();
}

?><!doctype html>
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

<div class="col-xs-12 no-padding" >

    <form id="loginform" action="" method="post" enctype="multipart/form-data">
        <div class="col-md-6 styleguide">




            <form action="" method="post" enctype="multipart/form-data">

                <label for"avatar">Upload je foto!</label>
                <input name="avatar" type="file" class="btn btn-default">
                <input type="submit" value="Upload" class="btn btn-default">

                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" class="form-control" id="username" name="UserName" <?PHP echo " value='". $user['UserName']."'"; ?>>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" <?PHP echo " value='". $user['Email']."'"; ?>>
                </div>
                <div class="form-group">
                    <label for="pass">Nieuw wachtwoord</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="form-group">
                    <label for="pass_rep">Wachtwoord herhalen</label>
                    <input type="password" class="form-control" id="pass_rep" name="pass_rep">
                </div>


                </br>
                <p>Als u geen wijzigingen wilt doorvoeren, gaat u terug naar Home zonder op onderstaande knop te klikken.</p>
                <button type="submit" name="btn-change" class="btn btn-default">Profiel aanpassen</button>
            </form>
        </div>
</div>

<img src="uploads/<?php echo $_SESSION["UserName"] ?>.jpg">

</body>
</html>
