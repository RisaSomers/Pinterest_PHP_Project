<?php

spl_autoload_register(function($class){
    include_once("classes/".$class.".class.php");
});

session_start();




if(!isset($_FILES['avatar']))
    {
        $feedback = "Please select a file";
        $feedback2 = "Change your information";
    }
else
    {
        if (!empty($_POST)){
            $upload = new users();
            
            $upload->upload($_FILES);
            $feedback = "Please select a file";
            $feedback2 = "Change your information";
        }
    }


if(!isset($_SESSION["email"])){
        
	}


    if(!empty($_POST)){
        
         
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['firstname'] = $_POST['firstname'];
        
            $update = new users();
            
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


              <img src="<?php echo !empty($_SESSION['avatar']) ? $_SESSION["avatar"] : 'uploads\64e102140c60d231fdd9d4449fc09b60.jpg'; ?>" alt="" style=" width: 10%; margin-left: 50px;" class="">

              

              <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
              
              
              
              
  <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
  <div><input name="avatar" type="file" /></div> <br>
  <div><input type="submit" value="Submit" /></div>
  </form>




<br><br><br>

<div class="col-xs-12 no-padding" >

   
        <div class="col-md-6 styleguide">





            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                   <h4><?php echo $feedback2 ?></h4>
                    <label for="name">Name</label>
                    <input name="firstname" type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email" >
                </div>
                <div class="form-group">
                    <label for="pass">Old password</label>
                    <input name="password" type="password" class="form-control" id="pass" >
                </div>
                <div class="form-group">
                    <label for="pass_rep">New password</label>
                    <input type="password" class="form-control" id="pass_rep" name="pass_rep">
                </div>


                </br>

                <button name="submit" type="submit" class="btn btn-default">Change profile</button>
                 <button src="index.php" class="btn btn-default">Cancel changes</button>
                 
            </form>
            
    
        </div>
</div>

</body>
</html>