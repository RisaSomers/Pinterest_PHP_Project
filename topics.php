<?php

error_reporting(E_ALL);
     ini_set('display_errors', 1); 

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
        
        
        
        .topics{
            margin: 5px;
        }

        .vierkant{
            background-color: #D9534F;
            text-align: center;
            border-radius: 1%;
            margin: 5%;
            margin-top: 5%;
            padding-top: 5%;
            
        }
        
        ul{
            text-decoration: none;
            list-style-type: none;
           
            
        }
        
        a{
            text-decoration: none;
            color: #D9534F;
        }
        
        img{
            width: 20%;
            margin-top: 5px;
        }
        
      
        
        
        @import url(http://fonts.googleapis.com/css?family=Gudea);

body {
  font-family: 'Gudea', Helvetica, sans-serif;
  margin: 0;
  paddong: 0;
  color: #333;
}

*, *:before, *:after {
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
}

.main {
  padding: 2em;
  margin: 0 auto;
  width: 100%;
  min-width: 460px;
  max-width: 700px;
}

h1 {
  text-align: center;
  margin: 0 0 1.2em 0;
  line-height: 150%;
    color: white;
}


  .flex-container{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        }


    </style>

</head>

<?php include("includes/menu.php"); ?>

<body>
 


 <div class="vierkant">

 <div class="tekst">

     <h1>Like 5 posts zodat we jouw inspiratie kunnen opbouwen!</h1>
     

 </div>
 
    </div>


  <form action="" method="post">
<article class='content'>
  <div id='slats'>
  
  <div class="main">
  
  

<ul class="flex-container">
	<?php foreach ($topics as $row) :?>
    <li class="flex-container"><a href='topics.php?Name=<?php echo $row['id'] ?>'></li>
			<div class='topics'>
			
			<li class="flex-item"><img src="<?php echo $row['image'] ?>" alt=""></li>
			
			<li class="flex-item"><div class='photo'><input class="check" type="checkbox" name="topic[]" value=<?php echo $row['id'] ?>></div></li>
			
			<br>

			<li class="flex-item"><p class='topicname'><?php echo $row['name'] ?></p></li>
			
			</div>
			</a>

	<?php endforeach; ?>
      
      </ul>
      
     

      <button>Get started</button>
      
    </div>

  </div>
  
  
</article>

     </form>

    
    
    </div>


</div>
   

    

</body>
</html>
