<?php

    session_start();

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
	session_start();
	if ( isset($_SESSION['UserName'] ) ){
		
	}
	else{
		header('Location: login.php');
	}
		
		$conn= Db::getInstance();
		$sth = $conn->prepare("SELECT * FROM Topics;");
		
		$sth->execute();
=======

>>>>>>> origin/master
=======
    include_once("classes/Db.class.php");
>>>>>>> parent of dc4e534... Topics

=======
    include_once("classes/Db.class.php");

>>>>>>> parent of dc4e534... Topics
    

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

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
    
=======
>>>>>>> parent of dc4e534... Topics
=======
>>>>>>> parent of dc4e534... Topics
  
  <ul>
    
<?php $conn= Db::getInstance(); ?>

    <?php foreach ($conn->query($sql) as $key => $topic):?>
<div class="topic">
        <li><a href="topics.php?topics=<?php echo $key;?>&topicid=<?php echo $_GET['topic'] ;?>"><?php echo $topic['Name']; ?></a></li>
        <img src="<?php echo $topic['Image']; ?>" alt="Afbeelding van  <?php $topic['Name']; ?>">
        </div>
        <hr>
    <?php endforeach; ?>
</ul>
  

  </div>
</article>   
 
<<<<<<< HEAD
<<<<<<< HEAD
     </form>
=======

  <ul>

<?php $conn= Db::getInstance(); ?>

    <?php foreach ($conn->query($sql) as $key => $topic):?>
<div class="topic">
        <li><a href="topics.php?topics=<?php echo $key;?>&topicid=<?php echo $_GET['topic'] ;?>"><?php echo $topic['Name']; ?></a></li>
        <img src="<?php echo $topic['Image']; ?>" alt="Afbeelding van  <?php $topic['Name']; ?>">
        </div>
        <hr>
    <?php endforeach; ?>
</ul>


  </div>
</article>

 <button type="submit"> Follow 5 topics </button>
>>>>>>> origin/master


    </div>

=======
 <button type="submit"> Follow 5 topics </button>
>>>>>>> parent of dc4e534... Topics
=======
 <button type="submit"> Follow 5 topics </button>
>>>>>>> parent of dc4e534... Topics

</body>
</html>
