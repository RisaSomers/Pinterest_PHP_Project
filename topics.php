<?php

    include_once("classes/Db.class.php");
    include_once("classes/Topics.class.php");

	session_start();
	if ( isset($_SESSION['UserName'] ) ){
		
	}
	else{
		header('Location: login.php');
	}
		
		$conn= Db::getInstance();
		$sth = $conn->prepare("SELECT * FROM Topics;");
		
		$sth->execute();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Topics</title>
    <link rel="stylesheet" href="css/topics.css">
    <link rel="stylesheet" href="js/topics.js">
    <link href="css/bootstrap.min.css" rel="stylesheet">

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

     <h5>Like 5 topics</h1>
     <h7>Then we'll build a custom home feed for you</h2>

 </div>

  <div class="search">
    <input type="search" id="filter" placeholder='Search' />
  </div>
<article class='content'>
  <div id='slats'>

  
	<?php while( $row = $sth->fetch() ):?>
			<a href='topics.php?id=<?php echo $row['Name'] ?>'>
			<div class='topics'>
			<div class='photo'><input class="check" type="checkbox" name="calltype[]" value=""></div>
			
			<p class='topicname'><?php echo $row['Name'] ?></p>
			</div>
			</a>
			

	<?php endwhile; ?>
  

  </div>
</article>   
 


     </form>



 <button href="profile.php" type="submit"> Follow 5 topics </button>



    </div>




</body>
</html>
