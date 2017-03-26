<?php
session_start();






try {
    // if geregistreerd
    if (!empty($_POST)) {


        // checken of velden ingevuld zijn
        $FullName = $_POST['FullName'];
        $UserName = $_POST['UserName'];
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];
        $Passwordcon = $_POST['Password_confirmation'];


        if ($_POST['Password'] == $_POST['Password_confirmation']) {

            if (strlen($Password) >= 6) {

                if (!empty($_POST)) {
                    //formulier is verzonden, controleer formulier
                    if (empty($_POST['FullName'])) $veldfout['FullName'] = TRUE;

                    $sameEmail = $conn->prepare("SELECT Email FROM Users WHERE Email = :Email ");
                    $sameEmail->bindValue(':Email', $Email);
                    $sameEmail->execute();

                    if($sameEmail->fetch(PDO::FETCH_ASSOC) == $Email){
                        throw new Exception("Email bestaat al");
                    }
                    //afhandeling
                    if (!empty($veldfout)) {
                        //formulier incorrect ingevuld
                        throw new Exception("Vul alle velden in");
                    } else {
                        //formulier correct
                        header("Location: index.php");

                    }

                } else {
                    throw new Exception("Paswoord komt niet overeen");
                }

            } else {
                throw new Exception("Passwoord moet minstens 6 karakters hebben");
            }


            $PasswordHash = password_hash($Password, PASSWORD_BCRYPT, array("cost" => 12) );

            // connectie met databank



            $statement = $conn->prepare("INSERT INTO Users (FullName, UserName, Email, Password) VALUES(:FullName, :UserName, :Email, :Password)");
            $statement->bindValue(":FullName", $FullName);
            $statement->bindValue(":UserName", $UserName);
            $statement->bindValue(":Email", $Email);
            $statement->bindValue(":Password", $PasswordHash);

            $res = $statement->execute();
            return ($res);
            header('Location: signup.php');


        }
    }

    }catch (Exception $e){
    $error = $e->getMessage();

}









?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Thumbnail Gallery - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>

        h3{
            color: red;
        }

    </style>
</head>

<body>



<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">IMDterest</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
    <title>Signup form</title>

    <div class="container">

        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form role="form" method="post">
                    <h2>Please Sign Up<?php if( isset( $error ) ): ?>
                                <div class="error"> <?php echo '<h3>' . $error . '</h3>' ?> </div>
                            <?php endif; ?></h2>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="FullName" id="fullname" class="form-control input-lg" placeholder="Volledige naam" tabindex="1">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="UserName" id="username" class="form-control input-lg" placeholder="Gebruikersnaam" tabindex="2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" name="Email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="4">
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="Password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="Password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
                            </div>
                        </div>
                    </div>
                    <br/>



                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                            <input name="Registration" type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <a href="login.php"><input name="SignIn"  value="Sign In" class="btn btn-primary btn-block btn-lg" tabindex="10"></a>
                        </div>
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
