<?php


	session_start();
	if ( isset($_SESSION['UserName'] ) ){
		
	}
	else{
		header('Location: login.php');
	}
		
		$conn= Db::getInstance();
		$sth = $conn->prepare("SELECT * FROM Topics;");
		
		$sth->execute();


    include_once("classes/Db.class.php");

    

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
 


     </form>



 <button type="submit"> Follow 5 topics </button>



    </div>




</body>
</html>
