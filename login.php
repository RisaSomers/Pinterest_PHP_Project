<?php

session_start();


include 'classes/Db.class.php';

if(isset($_POST['SignIn'])){

    //Retrieve the field values from our login form.
    $username = $_POST['email'];
    $passwordAttempt = $_POST['password'];

    //Retrieve the user account information for the given username.
    $pdo = Db::getInstance();
    $sql = "SELECT id, email, password FROM Users WHERE email = :email";
    $stmt = $pdo->prepare($sql);

    //Bind value.
    $stmt->bindValue(':email', $email);

    //Execute.
    $stmt->execute();

    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        die('Incorrect email / password combination!');
    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.

        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);

        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){

            //Provide the user with a login session.
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['logged_in'] = time();


            header('Location: profile.php');
            exit;

        } else{
            //$validPassword was FALSE. Passwords do not match.
            die('Incorrect email / password combination!');
        }
    }

}
?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/header.php"); ?>
    <title>IMDterest - Login Page</title>

    <style>

        .error{
            color: red;
        }
        small{
            color: #fff;
            background-color: red;
        }

    </style>
</head>

<body>



<!-- Navigation -->
<?php include("includes/menu.php"); ?>


<!-- Page Content -->
<div class="container">
    <title>Signup form</title>

    <div class="container">
        <form method="post" action="">
                    <h2>Log In<?php if( isset( $errMsg ) ): ?>
                            <div class="error"> <?php echo '<small>' . $errMsg . '</small>' ?> </div>
                        <?php endif; ?></h2>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="email" id="usernamelogin" class="form-control input-lg" placeholder="Email" tabindex="8">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="passwordlogin" class="form-control input-lg" placeholder="Password" tabindex="9">
                            </div>
                        </div>
                    </div>


                    <hr class="colorgraph">
                    <div class="form-group">

                          <input name="SignIn" type="submit" value="Sign In" class="btn btn-primary btn-block btn-lg" tabindex="10">

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- Footer -->
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p>Copyright &copy; IMDterest 2017</p>
        </div>
    </div>
</footer>

</div>
<!-- /.container -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
