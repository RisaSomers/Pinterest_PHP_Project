<?php

if (!empty($_POST['SignUp'])){
    try{
        $dbh = new PDO('mysql:host=localhost; dbname=Pinterest_PHP', 'root', 'root');
    } catch (PDOException $e){
        $error = $e->getMessage();
    }
     $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username =:username LIMIT 1";
    $query = $dbh->prepare($sql);
    $query->execute(array(':email'=>$email));
    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach($results as $row){
        if(password_verify($password,$row['password'])){
            session_start();
            $_SESSION['username'] = $username;
            header('Location: index.php');
        } else {
            header('Location: login.php');
        }
    }
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
        small{
            color: #fff;
            background-color: red;
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

                    <h2>Log In<?php if( isset( $error ) ): ?>
                            <div class="error"> <?php echo '<small>' . $error . '</small>' ?> </div>
                        <?php endif; ?></h2>
                    <hr class="colorgraph">
                    <div class="row">
                        <form method="post"  action="">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control input-lg" placeholder="Gebruikersnaam" tabindex="1">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="2">
                            </div>
                        </div>
                        </form>
                    </div>


                    <hr class="colorgraph">
                    <div class="form-group">

                            <input name="SignIn" type="submit" value="Sign In" class="btn btn-primary btn-block btn-lg" tabindex="3">
                        <br/><p>Or register <a href="signup.php">here</a></p>

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
