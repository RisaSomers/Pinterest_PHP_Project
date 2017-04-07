<?php

session_start();


/*session_start();

if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
@@ -29,16 +31,46 @@ if(!empty($_FILES)) {
}

echo 'Congratulations! You are logged in!';
*/



include_once("classes/user.php");
include_once("classes/profilechange.class.php");

//session_start();
$a = new profilechange();
$allusers = $a->getAll();

$conn = Db::getInstance();

$statement = $conn->prepare('SELECT * FROM Users WHERE id=:id');

$statement->bindParam(':id',$_SESSION['id']);
$statement->execute();
$user = $statement->fetch(PDO::FETCH_ASSOC);

try
{
    if (!empty($_POST))
    {
        $a->checkPass($_POST['pass'], $_POST['pass_rep']);
        $a->update($_POST['name'],$_POST['pass'], $_POST['year'], $_POST['branch'], $_POST['description']);
    }
}
catch(Exception $e)
{
    $error = $e->getMessage();
}

?>

<!doctype html>
<html lang="en">
<head>


  <?php include("includes/header.php"); ?>
    <title>Account</title>

    <style>
        .nav li {
@@ -51,7 +83,12 @@ echo 'Congratulations! You are logged in!';
            text-decoration: none;
        }
    </style>

</head>

<!-- Navigation -->
<?php include("includes/menu.php"); ?>

<body>
<form action="" method="post" enctype="multipart/form-data">
    <br>

    <input type="submit" value="Upload">
</form>

<div class="col-xs-12 no-padding" >

    <form id="loginform" action="" method="post" enctype="multipart/form-data">
        <div class="col-md-6 styleguide">


                <div class="alert alert-danger" role="alert" ></div>


            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Naam</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="pass">Oud wachtwoord</label>
                    <input type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="form-group">
                    <label for="pass_rep">Nieuw wachtwoord</label>
                    <input type="password" class="form-control" id="pass_rep" name="pass_rep">
                </div>


                </br>
                <p>Als u geen wijzigingen wilt doorvoeren, gaat u terug naar Home zonder op onderstaande knop te klikken.</p>
                <button type="submit" class="btn btn-default">Profiel aanpassen</button>
            </form>
        </div>
</div>

<img src="uploads/<?php echo $_SESSION["email"] ?>.jpg">

<ul class="nav">

</body>
</html>
