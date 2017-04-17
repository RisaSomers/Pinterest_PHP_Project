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
    $results = $conn->prepare("SELECT * FROM items;");
    $results->execute();
		
    $t = new Topics();
    $feed = $t->getUserPosts();


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
            
            
     <form action="" method="post">    
            
<div class="wrapper">
    <ul id="results"> 
    
    
    <div class="container" style="margin:35px auto;">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 results"> </div>
        </div>
    
    
    
    <?php while( $row = $results->fetch() ):?>
    
        

    <div class="col-lg-3 col-md-4 col-xs-6 thumb">
        <a class="thumbnail" href="detail.php?id=<?php echo $row['id']; ?>">

        
            <img src="uploads/posts/<?php echo $row['Image'] ?>" class="thumbnail"alt="">
               
            <p><?php echo $row['Beschrijving'] ?></p>
               
        </a>
    </div> 
  
    </div>  
    
       
    
    <?php endwhile; ?>  
    
    </ul>
</div>   
      </form>   
       
           
        <div class="text-center">
            <button class="btn btn-default" id="loadmorebtn">
                <img src="ajax-loader.gif" class="ani_image" style="float:left">
                &nbsp; Load More
            </button>
        </div>
                                         
        </div>

       
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
    <script src="js/loadmore.js" ></script>
    

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    
    
   <script>
    var mypage = 1;
    mycontent(mypage);
    $('#loadmorebtn').click(function(e){
        mypage++;
        mycontent(mypage);
    })
    function mycontent(mypage){
        $('.ani_image').show()
        $.post('data.php', {page: mypage}, function(data){
            if(data.trim().length == 0){
                $('#loadmorebtn').text("No more posts").prop("disabled", true)
            }
            $('.results').append(data)
            $("html, body").animate({scrollTop: $("#loadmorebtn").offset().top}, 800)
            $('.ani_image').hide()
        })
    }
    </script> 
    

</body>

</html>