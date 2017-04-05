<?php

    include_once("classes/Db.class.php");
    include_once("classes/Topics.class.php");
    include_once("classes/user.php");

session_start();

	if ( isset($_SESSION['UserName'] ) ){

	}
	else{
		header('Location: login.php');
	}

		$conn= Db::getInstance();
		$sth = $conn->prepare("SELECT * FROM Topics;");

		$sth->execute();


        if(!empty($_POST)){
            $topics = new Topics();
            $topics->Description = $_POST['topic'];
            header("Location: profile.php");
        }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Topics</title>
<?php include("includes/header.php") ?>

    <style>

        .vierkant{
            background-color: cadetblue;
            text-align: center;
            border-radius: 5%;
            margin: 20%;
            margin-top: 15%;
            padding-top: 5%;
        }

    </style>

</head>

<?php include("includes/menu.php"); ?>

<body>

 <div class="vierkant">

 <div class="tekst">

     <h1>Like 5 topics</h1>
     <h2>Then we'll build a custom home feed for you</h2>

 </div>

  <div class="search">
    <input type="search" id="filter" placeholder='Search' />
  </div>
  <form action="" method="post">
<article class='content'>
  <div id='slats'>


	<?php while( $row = $sth->fetch() ):?>
			<a href='topics.php?Name=<?php echo $row['id'] ?>'>
			<div class='topics'>
			<div class='photo'><input class="check" type="checkbox" name="topic" value=<?php echo $row['Name'] ?>></div>

			<p class='topicname'><?php echo $row['Name'] ?></p>

			</div>
			</a>


	<?php endwhile; ?>

      <button>Get started</button>

  </div>
</article>



     </form>





    </div>




</body>
</html>
