<?php

spl_autoload_register(function($class){
    include_once("classes/".$class.".class.php");
});

session_start();



    // als we submitten gaan we velden uitlezen
    if(!empty($_POST)){
        try{
            $options = [
                'cost' => 12
            ];

            //lezen de velden uit en steken die waarden in class user
            $users = new users();

            $res = "succes";
            $MinLength = 6;

            //error voor legen velden
            if(empty($users->fullname = $_POST['firstname'])){
                $error = "Firstname can not be empty.";
            }


            elseif(empty($users->lastname = $_POST['lastname'])){
                $error = "Lastname can not be empty";
            }


            elseif(empty($users->email = $_POST['email'])){
                $error = "Email can not be empty";
            }

            elseif(empty($users->password = $_POST['password'])){
                $error = "Password can not be empty";
            }


            elseif(empty($users->passwordcon = $_POST['password_confirmation'])){
                $error = "Password confirmation can not be empty";
            }

            elseif(strlen($users->password) < $MinLength){
                $error = "Your password has to be at least 6 characters long";
            }

            $users->setMSfirstname($_POST['firstname']);
            $users->setMSlastname($_POST['lastname']);
            $users->setMSemail($_POST['email']);
            $users->setMSpassword(password_hash($_POST['password'], PASSWORD_DEFAULT, $options));

            if ($_POST['password'] != $_POST['password_confirmation']){
                throw new exception("Password and confirmation password are not the same!");
            }

            $conn= Db::getInstance();

            if(!isset($error)){
                $statement = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $statement->bindValue(":email", $users->getMSemail());

                if($statement->execute() && $statement->rowCount() != 0){
                    $resultaat = $statement->fetch(PDO::FETCH_ASSOC);
                    $error = "Mail is already used";
                    $res = false;
                }

                else{
                    if($res != false){
                        $succes = "Welcome, you are registered";
                        $register = new users();
                        $register->setMSfirstname($_POST['firstname']);
                        $register->setMSlastname($_POST['lastname']);
                        $register->setMSemail($_POST['email']);
                        $register->setMSpassword(password_hash($_POST['password'], PASSWORD_DEFAULT, $options));
                        $register->save();

                        session_start();

                        $_SESSION['email'] = $users->email;
                        $_SESSION['lastName'] = $users->lastname;
                        $_SESSION['firstName'] = $users->firstname;
                        $_SESSION['id'] = $resultaat['id'];
                        
        
                        header("Location: topics.php");
                    }

                    else{
                        $fail = "oops, something went wrong! try again!";
                        header("Location: signup.php");
                    }
                } 

            }

        }
                catch(Exception $e){
                    $error = $e->getMessage();
                }
            }

         
?><!DOCTYPE html>
<html lang="en">

<head>

    <?php include("includes/header.php"); ?>

    <title>IMDterest - Sign up here!</title>


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
                    <h2>Please Sign Up<?php if( isset( $error ) ): ?>
                            <div class="error"> <?php echo '<small>' . $error . '</small>' ?> </div>
                        <?php endif; ?></h2>

                    <div class="form-group">
                        <input type="text" name="firstname" id="firstname" class="form-control input-lg" placeholder="Voornaam" tabindex="1">
                    </div>

                    <div class="form-group">
                        <input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="Achternaam" tabindex="2">
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
                    </div>

                    <div class="form-group">
                        <input name="Registration" type="submit" value="Register" class="btn btn-primary btn-block btn-lg red" tabindex="7">
                    </div>
                </form>

                <p class="signup">of <a href="login.php">log je hier in</a> </p>

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
