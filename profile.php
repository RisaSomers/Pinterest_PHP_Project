<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});

session_start();




if (!isset($_FILES['avatar'])) {
    $feedback = "Please select a file";
    $feedback2 = "Change your information";
} else {
    if (!empty($_POST)) {
        $upload = new Users();

        $upload->upload($_FILES);
        $feedback = "Your avatar was uploaded!";
        $feedback2 = "Change your information";
    }
}


if (!isset($_SESSION["email"])) {
}


    if (!empty($_POST['email'])) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['firstname'] = $_POST['firstname'];

        $update = new users();

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
      <link rel="stylesheet" href="css/jquery.modal.css" type="text/css" media="screen" />

      <!-- SEARCH FUNCTION (AJAX LIVE PREVIEW)-->
      <style type="text/css">
          /* Formatting search box */
          .search-box{
              width: 300px;
              position: relative;
              display: inline-block;
              font-size: 14px;
          }
          .search-box input[type="text"]{
              height: 32px;
              padding: 5px 10px;
              border: 1px solid #CCCCCC;
              font-size: 14px;
          }
          .result{
              position: absolute;
              z-index: 999;
              top: 100%;
              left: 0;
          }
          .search-box input[type="text"], .result{
              width: 100%;
              box-sizing: border-box;
          }
          /* Formatting result items */
          .result p{
              margin: 0;
              padding: 7px 10px;
              border: 1px solid #CCCCCC;
              border-top: none;
              cursor: pointer;
          }
          .result img{
            width:50px;
            height: 50px;
            padding: 2px 5px;
          }

          .result p:hover{
              background: #f2f2f2;
          }
      </style>
      <script type="text/javascript">
      $(document).ready(function(){
          $('.search-box input[type="text"]').on("keyup input", function(){
              /* Get input value on change */
              var inputVal = $(this).val();
              var resultDropdown = $(this).siblings(".result");
              if(inputVal.length){
                  $.get("backend-search.php", {term: inputVal}).done(function(data){
                      // Display the returned data in browser
                      resultDropdown.html(data);
                  });
              } else{
                  resultDropdown.empty();
              }
          });

          // Set search input value on click of result item
          $(document).on("click", ".result p", function(){
              $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
              $(this).parent(".result").empty();
          });
      });
      </script>



          <title>Account</title>

            <style>
                .nav li {
                    @@ -51,
                    7 +83,
                    12 @@ echo 'Congratulations! You are logged in!';
                    text-decoration: none;
                }

            </style>

    </head>

    <!-- Navigation -->
    <?php include("includes/menu.php"); ?>

        <body>

            <div class="col-lg-12">
                <h1 class="page-header">Profile</h1>
                <h4>Create your own board!</h4>

            </div>
            <div class="col-xs-12 no-padding">
                <a href="#ex1" rel="modal:open"><button type="button" class="btn btn-info btn-lg" >Create Board</button></a>

                <div id="ex1" style="display:none;">
    <p>Let's make a board.<?php if (isset($error)): ?>
                    <div class="error"> <?php echo '<small>' . $error . '</small>' ?> </div>
                    <?php endif; ?></p>

        <form action="board.php" method="post" id="createBoard" enctype="multipart/form-data">
            <label for="boardTitle">Name</label>
            <input type="text" name="boardTitle" id="boardTitle">

            <label for="privateSwitch">Private?</label>
            <input id="privateSwitch" type="checkbox"/>
            <br>
            <input type="submit" value="Submit" />
        </form>
        <p><a href="#" rel="modal:close">Close</a> or press ESC</p>
  </div>


            <div class="col-lg-12">
                <h4><?php echo $feedback ?></h4>
            </div>
            <div class="col-xs-12 no-padding">
                <img src="<?php echo $_SESSION[" avatar "] ; ?>" alt="" style=" width: 10%; margin-left: 50px;" class="">
                <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post"></form>
            </div>






            <input type="hidden" name="MAX_FILE_SIZE" value="99999999" />
            <div>
                <input name="avatar" type="file" />
            </div>
            <br>
            <div>
                <input type="submit" value="Submit" />
            </div>





            <br>
            <br>
            <br>

            <div class="col-xs-12 no-padding">


                <div class="col-md-6 styleguide">





                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <h4><?php echo $feedback2 ?></h4>
                            <label for="name">Name</label>
                            <input name="firstname" type="text" class="form-control" id="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input name="email" type="email" class="form-control" id="email">
                        </div>
                        <div class="form-group">
                            <label for="pass">Old password</label>
                            <input name="password" type="password" class="form-control" id="pass">
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
