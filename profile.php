<?php

spl_autoload_register(function ($class) {
	include_once("classes/" . $class . ".php");
});

session_start();

$user = new Users();
$user = $user->getAllUserSpecific($_SESSION['id']);

if (isset($_FILES['avatar'])) {
	if (!empty($_POST)) {
		$upload = new Users();
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

		$updatedUser = new Users();
		$user = $updatedUser->getAllUserSpecific($_SESSION['id']);
	}
}

if (!empty($_POST['email'])) {
	$_SESSION['email'] = $_POST['email'];
	$_SESSION['firstname'] = $_POST['firstname'];

	$update = new Users();

	$update->email = $_SESSION['email'];
	$update->update();
	$feedback2 = "Your changes have been made!";
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

<div class="container">
    <div class="">
        <h1 class="page-header">Change your profile</h1>
			<?php if (isset($feedback_image['value'])): ?>
          <div class="alert <?php echo $feedback_image['success'] ? 'alert-success' : 'alert-danger' ?>" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              <?php echo $feedback_image['value'] ?>
          </div>
			<?php endif; ?>
    </div>

    <div class="row">
        <div class="col-md-8">
            <img src="<?php print $user['avatar'] ?>" alt="" class="">

            <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>"
                  method="post">

                <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
                <div>
                    <input name="avatar" type="file" id="avatar"/>
                </div>
                <br>
                <div>
                    <input type="submit" class="btn btn-default" value="Submit"/>
                </div>

            </form>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-8">
          <?php if (isset($feedback_profile)): ?>
              <div class="alert <?php echo $feedback_profile['success'] ? 'alert-success' : 'alert-danger' ?>" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  <span class="sr-only">Error:</span>
                  <?php echo $feedback_profile ?>
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
                    <label for="pass_rep">Nieuw wachtwoord</label>
                    <input type="password" class="form-control" id="pass_rep" name="pass_rep">
                </div>
                <button name="submit" type="submit" class="btn btn-default">Change profile</button>
                <button src="index.php" class="btn btn-default">Cancel changes</button>
            </form>
        </div>
    </div>
</div>

<hr>
<?php include_once('includes/footer.php') ?>

</body>

<script src="js/bootstrap.min.js"></script>

</html>
