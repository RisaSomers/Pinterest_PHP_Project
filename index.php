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
    
    $statement = $conn->prepare("select * from items order by id DESC limit 0,20");
    $statement->execute();
		
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

        <div id="container">
        
        
        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Your feed</h1>

            </div>
            
            <form action="" method="post">    
            
<div class="wrapper">
    <ul id="results"> 
    
    
    <div class="container" style="margin:35px auto;">
        <div class="row">
            <div id="items" class="col-md-6 col-md-offset-3 results">

        <?php  $items = $statement->fetchAll(PDO::FETCH_ASSOC);

   foreach( $items as $key => $row ){
            $pp = new Items();
            $pp->setId($row["id"]);
            $likes = $pp->getLike();
            $dislikes = $pp->getDislike();
            echo "<h2>" . $row['Beschrijving'] . "</h2>  
                           <a href='detail.php?id=" . $row['id'] . "'>
                           
                               <div class='post_img'>
                                   ";
                                        if (!empty($row['Url'])) {
                                            echo "<img src='" . $row['Url'] . "' alt='" . $row['id'] . "'>";
                                        } else {
                                            echo "<img src='uploads/posts/" . $row['Image'] . "' alt='" . $row['id'] . "'>";
                                        }
                                   echo "
                               </div>
                           </a>
                           <a href='#' class='like' data-id='". $row["id"] . "'>LIKE - " . $likes . "</a>
                           <a href='#' class='dislike' data-id='". $row["id"] . "'>DISLIKE - " . $dislikes . "</a>";
}?>

                </div>
        </div>
        </div>

         </ul>
</div>   
      </form>  
        
        <input type="hidden" id="result_no" value="20">
    </div>
    <button type='submit' name='more' id='more'>Load more</button>
    
    
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
        $(".like").bind("click", function(e) {
            e.preventDefault();
            var el = $(this);
            $.get("ajax/like.php", {post_id: this.getAttribute("data-id")}, function(data) {
                if (data.success == true) {
                    el.html("LIKE - " + data.count++);
                }
            })
        });

        $(".dislike").bind("click", function(e) {
            e.preventDefault();
            var el = $(this);
            $.get("ajax/dislike.php", {post_id: this.getAttribute("data-id")}, function(data) {
                if (data.success == true) {
                    el.html("DISLIKE - " + data.count++);
                }
            })
        });
    </script>
   <script>
    $(document).ready(function(){
        $("#more").click(function(){
            loadmore();
        });

        $("#like").click(function () {
            like();
        })
    });

    function loadmore() {
        var val = document.getElementById("result_no").value;
        $.ajax({
            type: 'post',
            url: 'AJAX/loadMore.php',
            data: {     getresult:val   },
            success: function (response) {
                var content = document.getElementById("items");
                content.innerHTML = content.innerHTML+response;
                // LIMIT + 20
                document.getElementById("result_no").value = Number(val)+20;
            }
        });
    }

    </script> 
    

</body>

</html>