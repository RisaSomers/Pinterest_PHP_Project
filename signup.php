<?php
    
try{
    // if geregistreerd
    if( !empty( $_POST ) ) {


                // checken of velden ingevuld zijn
                $FullName = $_POST['FullName'];
                $UserName = $_POST['UserName'];
                $Email = $_POST['Email'];
                $Password = $_POST['Password'];
                $Passwordcon = $_POST['Password_confirmation'];


        if($_POST['Password'] == $_POST['Password_confirmation']){
            echo "OK";
        }

        else{
            throw new Exception("Paswoord komt niet overeen");
        }

                $options = [
                    'cost' => 12,
                ];

                $Password = password_hash($Password, PASSWORD_DEFAULT, $options);

                // connectie met databank

                    $conn = new PDO('mysql:host=localhost;dbname=Pinterest_PHP', 'root', '');

                    $statement = $conn->prepare("INSERT INTO Users (FullName, UserName, Email, Password) VALUES(:FullName, :UserName, :Email, :Password)");
                    $statement->bindValue(":FullName", $FullName);
                    $statement->bindValue(":UserName", $UserName);
                    $statement->bindValue(":Email", $Email);
                    $statement->bindValue(":Password", $Password);

                    $res = $statement->execute();
                    return ($res);



    }}catch (Exception $e){
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

        .error{
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
            <a class="navbar-brand" href="#">Start Bootstrap</a>
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
                    <h2>Please Sign Up <?php if( isset( $error ) ): ?>
                                <div class="error"> <?php echo '<small>' . $error . '</small>' ?> </div>
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


                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-md-6"><input name="Registration" type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
                        <div class="col-xs-12 col-md-6"><a href="#" name="SignIn" class="btn btn-success btn-block btn-lg">Sign In</a></div>
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
            <p>Copyright &copy; Your Website 2014</p>
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
