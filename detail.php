<?php

spl_autoload_register(function($class){
    include_once("classes/".$class.".class.php");
});


session_start();

	if ( !empty($_SESSION['email'] ) ){


	}

    $conn = Db::getInstance();
    $details = new Items();
    $id = $_GET['id'];
    $details = $conn->prepare("SELECT * FROM items WHERE id = $id;");
    $details->execute();


    $user = new users();
    $user = $conn->prepare("SELECT * FROM Users WHERE id = $id;");
    $user->execute();




	//Eerst bouwen we onze applicatie uit zodat ze werkt, ook zonder JavaScript

	
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
	
	//altijd alle laatste activiteiten ophalen
	$recentActivities = $activity->GetRecentActivities();




?><!DOCTYPE html>
<html lang="en">

<head>
    <?php include("includes/header.php"); ?>
    <title>IMDterest - Upload Item</title>

    <style>

        h1 {
            margin-left: 10%;
            margin-bottom: 30px;
        }

        #fileToUpload {
            margin-bottom: 25px;
        }

        #link {
            display: block;
        }

        #labelbeschrijving {
            display: block;
        }
        #beschrijving {
        height: 80px;
        }

        #submit {
            display: block;
            margin-top: 40px;
        }


    </style>
</head>

<body>

<!-- Navigation -->
<?php include("includes/menu.php"); ?>

<a href="index.php">Go back to your dashboard</a>

<?php foreach($details as $row => $detail): ?>

<!-- Page Content -->
<div class="container">

  
  <div class="col-lg-3 col-md-4 col-xs-6 thumb">
   <h1 id="post" data-id="<?php echo $detail['id'] ?>"><?php echo $detail['Beschrijving']; ?></h1>

<a class="thumbnail" href="">
<img src="uploads/posts/<?php echo $detail['Image']; ?>" class="thumbnail"alt="">
    </a>
    </div>
   
</div>



	<div class="errors"></div>
	
	<form method="post" action="">
		<div class="statusupdates">
		<h5>Comments</h5>
		<input type="text" value="What's on your mind?" id="activitymessage" name="activitymessage" />
		<input id="btnSubmit" type="submit" value="Share" />
		
		<ul id="listupdates">
		<?php 
            
            
            
			if($recentActivities > 0)
			{		
				while($singleActivity = mysqli_fetch_assoc($recentActivities))
				{
					echo "<li><h2>GoodBytes.be</h2> ". htmlspecialchars($singleActivity['activity_description'] )."</li>";
				}
			}

		?>
		</ul>
		
		</div>
	</form>
	
</div>




<?php endforeach; ?>

<!-- Footer -->
<footer>
    <div class="row">
        <div class="col-lg-12">
            <p>Copyright &copy; IMDterest 2017</p>
        </div>
    </div>
</footer>


<!-- /.container -->

    <script src="js/jquery.js"></script>
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"   integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="   crossorigin="anonymous"></script>
    
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
   $("#btnSubmit").on("click", function(e){
       //console.log("clicked");

       // tekst vak uitlezen
       var update = $("#activitymessage").val();
       var postID = document.getElementById("post").getAttribute("data-id");
       // via AJAX update naar databank sturen
       $.ajax({
           method: "POST",
           url: "AJAX/save_update.php",
           data: { update: update, postID: postID } //update: is de naam en update is de waarde (value)
       })

           .done(function( response ) {

               // code + message
               if( response.code == 200 ){

                   // iets plaatsen?
                    var li = $("<li style='display: none;'>");
                    li.html(response.user + ": " + response.message);

                   // waar?
                   $("#listupdates").prepend( li );
                   $("#listupdates li").first().slideDown();
                   $("#activitymessage").val("").focus();
               }
           });

       e.preventDefault();
   });
}); 
</script>

</body>

</html>
