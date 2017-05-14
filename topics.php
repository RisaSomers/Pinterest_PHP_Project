<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});

session_start();

    if (!empty($_SESSION['email'])) {
    } else {
        header('Location: login.php');
    }

        $ts = new Topic();
        $topics = $ts->getAllTopics();


        if (!empty($_POST)) {
            $topics = new Topic();
            $topics->Description = $_POST['topic'];
            $topics->Username = $_SESSION['email'];
            $topics->updateSubscriptions($_POST["topic"]);
            header("Location: index.php");
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
        
        ul{
            text-decoration: none;
            list-style-type: none;
            
        }
        
        a{
            text-decoration: none;
            color: white;
        }
        
        img{
            width: 20%;
            margin-top: 5px;
        }
        
        .flex-container{
            padding: 0;
            margin: 0;
            list-style: none;
            display: flex;
            justify-content: space-around;
        }
        
        .flex-item{
            
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

<ul class="flex-cntainer">
	<?php foreach ($topics as $row) :?>
    <li class="flex-item"><a href='topics.php?Name=<?php echo $row['id'] ?>'></li>
			<div class='topics'>
			
			<li class="flex-item"><img src="<?php echo $row['image'] ?>" alt=""></li>
			
			<li class="flex-item"><div class='photo'><input class="check" type="checkbox" name="topic[]" value=<?php echo $row['id'] ?>></div></li>

			<li class="flex-item"><p class='topicname'><?php echo $row['name'] ?></p></li>
			
			</div>
			</a>

	<?php endforeach; ?>
      
      </ul>

      <button>Get started</button>

  </div>
</article>

     </form>

    </div>

</body>
</html>
