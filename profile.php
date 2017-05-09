<?php

spl_autoload_register(function ($class) {
	include_once("classes/" . $class . ".php");
});

session_start();

$user = new User();
$user = $user->getAllUserSpecific($_SESSION['id']);

if (isset($_FILES['avatar'])) {
	if (!empty($_POST)) {
		$upload = new User();
		$ret = $upload->upload($_FILES);
		if ($ret === true) {
			$feedback_image = [
              'success' => true,
              'value' => "Your avatar was uploaded!"
            ];
		} else {
            $feedback_image = [
                'success' => false,
                'value' => $ret
            ];
		}

		$updatedUser = new User();
		$user = $updatedUser->getAllUserSpecific($_SESSION['id']);
	}
}

if (!empty($_POST['email'])) {
	$_SESSION['email'] = $_POST['email'];

	$update = new User();

	$update->email = $_SESSION['email'];
	$update->update();
	$feedback_profile['success'] = true;
	$feedback_profile['value'] = "Your changes have been made!";
}

if (!empty($_POST['password']) && !empty($_POST['pass_new']) && !empty($_POST['pass_new_rep'])) {
    try {
        $updateUser = new User();
        $ret = $updateUser->updatePass($_POST['password'], $_POST['pass_new'], $_POST['pass_new_rep']);
        $feedback_profile['success'] = true;
        $feedback_profile['value'] = 'De wijzigingen zijn doorgevoerd!';
    } catch (Exception $e) {
        $feedback_profile['success'] = false;
        $feedback_profile['value'] = $e->getMessage();
  }
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="js/jquery.modal.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" href="css/jquery.modal.css" type="text/css" media="screen"/>

    <!-- SEARCH FUNCTION (AJAX LIVE PREVIEW)-->
    <style type="text/css">
        /* Formatting search box */
        .search-box {
            width: 300px;
            position: relative;
            display: inline-block;
            font-size: 14px;
        }

        .search-box input[type="text"] {
            height: 32px;
            padding: 5px 10px;
            border: 1px solid #CCCCCC;
            font-size: 14px;
        }

        .result {
            position: absolute;
            z-index: 999;
            top: 100%;
            left: 0;
        }

        .search-box input[type="text"], .result {
            width: 100%;
            box-sizing: border-box;
        }

        /* Formatting result items */
        .result p {
            margin: 0;
            padding: 7px 10px;
            border: 1px solid #CCCCCC;
            border-top: none;
            cursor: pointer;
        }

        .result img {
            width: 50px;
            height: 50px;
            padding: 2px 5px;
        }

        .result p:hover {
            background: #f2f2f2;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.search-box input[type="text"]').on("keyup input", function () {
                /* Get input value on change */
                var inputVal = $(this).val();
                var resultDropdown = $(this).siblings(".result");
                if (inputVal.length) {
                    $.get("backend-search.php", {term: inputVal}).done(function (data) {
                        // Display the returned data in browser
                        resultDropdown.html(data);
                    });
                } else {
                    resultDropdown.empty();
                }
            });

            // Set search input value on click of result item
            $(document).on("click", ".result p", function () {
                $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
                $(this).parent(".result").empty();
            });
        });
    </script>


    <title>Account</title>

    <style>
        .nav li {
            text-decoration: none;
        }

    </style>

</head>

<!-- Navigation -->
<?php include("includes/menu.php"); ?>

<body>



    <h1 class="page-header text-center headersubject">Change your profile</h1>

    <div class="container">
    <?php if (isset($feedback_image)): ?>
        <div class="alert <?php echo $feedback_image['success'] ? 'alert-success' : 'alert-danger' ?>" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $feedback_image['value'] ?>
        </div>
    <?php endif; ?>
    </div>
</div>

<div class="container">





    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center profilechangeblock">
            <img src="<?php print $user['avatar'] ?>" alt="" class="profilepic">

            <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"
                  method="post">

                <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                <div>
                    <input class="center-block" name="avatar" type="file" id="avatar"/>
                </div>
                <br>
                <div>
                    <input type="submit" class="btn btn-primary btn-block btn-lg red profilesubmit center-block" value="wijzig je profielfoto"/>
                </div>

            </form>
        </div>
        <div class="col-md-2"></div>
    </div>



    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center profilechangeblock">
          <?php if (isset($feedback_profile['value'])): ?>
              <div class="alert <?php echo $feedback_profile['success'] ? 'alert-success' : 'alert-danger' ?>" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only">Error:</span>
                  <?php echo $feedback_profile['value'] ?>
              </div>
          <?php endif; ?>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email"
                           value="<?php print $_SESSION['email'] ?>">
                </div>
                <div class="form-group">
                    <label for="pass">Oud wachtwoord</label>
                    <input name="password" type="password" class="form-control" id="pass">
                </div>
                <div class="form-group">
                    <label for="pass_new">Nieuw wachtwoord</label>
                    <input type="password" class="form-control" id="pass_new" name="pass_new">
                </div>
                <div class="form-group">
                    <label for="pass_new_rep">Herhaal nieuw wachtwoord</label>
                    <input type="password" class="form-control" id="pass_new_rep" name="pass_new_rep">
                </div>
                <button name="submit" type="submit" class="btn btn-primary btn-block btn-lg red profilesubmit center-block">Wijzig je profiel</button>

            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>

<hr>
<?php include_once('includes/footer.php') ?>

</body>

<script src="js/bootstrap.min.js"></script>

</html>
