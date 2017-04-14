<?php
include_once("classes/user.class.php");
include_once("classes/db.class.php");
include_once("classes/topics.class.php");
include_once("classes/comments.class.php");


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



    $activity = new Activity();
	
	//controleer of er een update wordt verzonden
	if(!empty($_POST['activitymessage']))
	{
		$activity->Text = $_POST['activitymessage'];
		try 
		{
			$activity->Save();
            
		} 
		catch (Exception $e) 
		{
			$feedback = $e->getMessage();
		}
	}

    $recentActivities = $activity->GetRecentActivities();

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
                
                <input type="text" value="comments" id="activitymessage" name="activitymessage" />
		        <input id="btnSubmit" type="submit" value="Share" />
                
                <ul id="listupdates">
		<?php 
			if(mysqli_num_rows($recentActivities) > 0)
			{		
				while($singleActivity = mysqli_fetch_assoc($recentActivities))
				{
					echo "<li><h2>GoodBytes.be</h2> ". htmlspecialchars($singleActivity['activity_description'] )."</li>";
				}
			}

		?>
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
    <script   src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
    
    <script scr="js/comments.js"></script>
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>