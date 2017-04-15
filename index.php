<?php

spl_autoload_register(function($class){
    include_once("classes/".$class.".class.php");
});


session_start();

	if ( !empty($_SESSION['email'] ) ){


	}
	else{
		header('Location: login.php');
	}

    $conn = Db::getInstance();
    $sth = $conn->prepare("SELECT * FROM items;");

    $sth->execute();
		
    $t = new Topics();
    $feed = $t->getUserPosts();



    $comments = new Comments();
	
	//controleer of er een update wordt verzonden
	if(!empty($_POST['activitymessage']))
	{
		$comments->Text = $_POST['activitymessage'];
		try 
		{
			
            
		} 
		catch (Exception $e) 
		{
			$feedback = $e->getMessage();
		}
	}

    $recentActivities = $comments->GetRecentActivities();
    var_dump($recentActivities);

?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include("includes/header.php"); ?>

    <title>IMDterest</title>

</head>

<body>

    <!-- Navigation -->
  <?php include("includes/menu.php"); ?>


    <!-- Page Content -->


    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Your feed</h1>

            </div>
        
     <?php while( $row = $sth->fetch() ):?>

            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">

        
<img src="uploads/posts/<?php echo $row['Image'] ?>" class="thumbnail"alt="">
               
               
               </a>
               
                <p></p><?php echo $row['Beschrijving'] ?></p>
                
                <h5>Comments</h5>
                
                <form action="" method="post">
                
                <input type="text" value="comments" id="activitymessage" name="activitymessage" />
                <input type="hidden" name="item_id" value="<?php echo $row["id"] ?>">
		        <input id="btnSubmit" type="submit" value="Share" />
               
                </form>
                
                <ul id="listupdates">
		
		<?php if($comments->getItemComments($row["id"])["comments"] != ""){
             echo "<li>" . $comments->getItemComments($row["id"])["comments"] . "</li>"; 

            echo "<li>" . . "</li>";
    
    
            echo "<li>" . . "</li>";
}?>
             
             
             
		
		</ul>
		
		</div> 
  
            </div>
                    <?php endwhile; ?>     
                                  

        </div>

        <hr>

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
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
    
    <script src="js/comments.js"></script>
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>