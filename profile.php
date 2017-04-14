<?php

include_once("classes/user.class.php");

session_start();


if(!isset($_FILES['userfile']))
    {
        $feedback = "Please select a file";
        $feedback2 = "Change your information";
    }
else
    {
    try    {
        
        $conn= Db::getInstance();
		$sth = $conn->prepare("SELECT * FROM Users;");
        $sth->execute();
        
        $a = new users();
        
        
        $a->upload();
        /*** give praise and thanks to the php gods ***/
        $feedback = "Thank you for submitting";
        $avatar = " ";
        $userData = $a->getAllUser();
        var_dump($userData);
        
        }
    catch(Exception $e)
        {
        echo '<h4>'.$e->getMessage().'</h4>';
        }


if(!isset($_SESSION["email"])){
        
	}


    if(!empty($_POST)){
            $update = new users();
            $update->firstname = $_POST['firstname'];
            $update->email = $_POST['email'];
            $update->password = $_POST['password'];
            $update->email = $_SESSION['email'];
            $update->update();
            $feedback2 = "Your changes have been made!";
        }

?><!doctype html>
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


            <div class="col-lg-12">
                <h1 class="page-header">Change your profile</h1>
                <h4><?php echo $feedback ?></h4>
            </div>
             
             <?php if( !empty( $_POST ) ): ?>
                        <img src="<?php echo $userData["avatar"] ?>" alt="">
                    <?php endif; ?>
              

              <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
              
              
              
              
  <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
  <div><input name="userfile" type="file" /></div> <br>
  <div><input type="submit" value="Submit" /></div>
  </form>




<br><br><br>

<div class="col-xs-12 no-padding" >

    <form id="loginform" action="" method="post" enctype="multipart/form-data">
        <div class="col-md-6 styleguide">





            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                   <h4><?php echo $feedback2 ?></h4>
                    <label name="firstname" for="name">Name</label>
                    <input name="firstname" type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label name="email" for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label name="oldpassword" for="pass">Old password</label>
                    <input name="password" type="password" class="form-control" id="pass" name="pass">
                </div>
                <div class="form-group">
                    <label name="password" for="pass_rep">New password</label>
                    <input name="password" type="password" class="form-control" id="pass_rep" name="pass_rep">
                </div>


                </br>

                <button name="submit" type="submit" class="btn btn-default">Change profile</button>
                 <button src="index.php" class="btn btn-default">Cancel changes</button>
                 
            </form>
            

        </div>
</div>



<ul class="nav">

</body>
</html>
