<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".class.php");
});

session_start();


if (isset($_POST['SignIn'])) {
    try {

    //Retrieve the field values from our login form.
    $email = $_POST['email'];
        $passwordAttempt = $_POST['password'];

    //Retrieve the user account information for the given username.
    $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT id, email, password FROM users WHERE email = :email");

    //Bind value.
    $statement->bindValue(':email', $email);

    //Execute.
    $statement->execute();

    //Fetch row.
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    //If $row is FALSE.
    if ($user === false) {
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        $error = "Incorrect email and/or password";
    } else {
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.

        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);

        //If $validPassword is TRUE, the login has been successful.
        if ($validPassword) {
            //Provide the user with a login session.
            $_SESSION['id'] = $user['id'];
            $_SESSION['logged_in'] = time();
            $_SESSION['email'] = $_POST["email"];
            
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['avatar'] = $user['avatar'];


            header('Location: index.php');
            exit;
        } else {
            //$validPassword was FALSE. Passwords do not match.
            $error = "Incorrect email and/or password";
        }
    }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/header.php"); ?>
    <title>IMDterest - Login Page</title>

    <style>



    </style>
</head>

<body class="signupbg">


<!-- Page Content -->
<div class="container">
    <title>Signup form</title>


<div class="container-fluid">

    <div class="col-md-2"></div>
    <div class="col-md-8 signupform">

        <div class="col-md-6 left"></div>
        <div class="col-md-6 right">

            <form role="form" method="post">
                <img class="logo" src="https://www.weareimd.be/img/imd-logo-black.svg">
                <h2>Log hier in<?php if (isset($error)): ?>
                        <div class="error"> <?php echo '<small>' . $error . '</small>' ?> </div>
                    <?php endif; ?></h2>

                <div class="form-group">
                    <input type="text" name="email" id="emaillogin" class="form-control input-lg" placeholder="E-mail" tabindex="8">
                </div>

                <div class="form-group">
                    <input type="password" name="password" id="passwordlogin" class="form-control input-lg" placeholder="Password" tabindex="9">
                </div>

                <div class="form-group">
                    <input name="SignIn" type="submit" value="Log in" class="btn btn-primary btn-block btn-lg red" tabindex="7">
                </div>
            </form>

            <p class="signup">of <a href="signup.php">Registreer je hier</a> </p>

        </div>

    </div>
    <div class="col-md-2"></div>

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
