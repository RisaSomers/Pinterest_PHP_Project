<?php

function time_elapsed_string($datetime, $full = false)
{
	$now = new DateTime;
	$ago = new DateTime($datetime);
	$diff = $now->diff($ago);

	$diff->w = floor($diff->d / 7);
	$diff->d -= $diff->w * 7;

	$string = array(
		'y' => 'year',
		'm' => 'month',
		'w' => 'week',
		'd' => 'day',
		'h' => 'hour',
		'i' => 'minute',
		's' => 'second',
	);
	foreach ($string as $k => &$v) {
		if ($diff->$k) {
			$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
		} else {
			unset($string[$k]);
		}
	}

	if (!$full) {
		$string = array_slice($string, 0, 1);
	}
	return $string ? implode(', ', $string) . ' ago' : 'just now';
}

spl_autoload_register(function ($class) {
	include_once("classes/" . $class . ".php");
});


session_start();

if (!empty($_SESSION['email'])) {

}


$detail = new Item();
$id = $_GET['id'];
$item = $detail->getById($id);

if (!(bool)$item['status']) {
	header('Location:blocked.php');
	die();
}

//Add Board
$b = new Board();
$userID = $_SESSION['id'];
$boards= $b->loadBoards($userID);



//Eerst bouwen we onze applicatie uit zodat ze werkt, ook zonder JavaScript
$activity = new Activity();

//controleer of er een update wordt verzonden
if (!empty($_POST['activitymessage'])) {
	$activity->Text = $_POST['activitymessage'];
	try {
		$activity->Save();
	} catch (Exception $e) {
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

        img {
            width: 100%;
        }

        #avatar {
            width: 5%;
        }

        li {
            list-style-type: none;
            margin-top: 5px;
        }


    </style>
</head>

<body>

<!-- Navigation -->
<?php include_once("includes/menu.php"); ?>

<a href="index.php">Go back to your dashboard</a>
<p><a href="inappropriate.php?id=<?php print $id ?>"><span style="color:red" class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Markeer als ongepast</a></p>

<!-- Page Content -->
<div class="container">
	<?php echo time_elapsed_string('@' . $item["uploaded"]); ?>
	<?php if ($item["user_id"] == $_SESSION["id"]): ?>
      <a href="delete_post.php?id=<?php echo htmlentities($_GET["id"]); ?>"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
	<?php endif; ?>

    <div class="col-lg-3" style="width:50%;">
        <h1 id="post" data-id="<?php echo $item['id'] ?>"><?php echo $item['Beschrijving']; ?></h1>
        <p>
            Posted in <?php echo $item["city"]; ?>
        </p>
        <a class="thumbnail" href="">
					<?php if (empty($item["Image"])): ?>

              <img src="<?php echo $item['Url']; ?>" class="thumbnail" alt="">
					<?php else: ?>

              <img src="uploads/posts/<?php echo $item['Image']; ?>" class="thumbnail" alt="">
					<?php endif; ?>
        </a>




										<!--Item toevoegen aan Bord-->
										<form method="post" action="update.php">
											<input type="text" name="id" value="<?php echo $id?>" style="visibility:hidden;">
											<div class="btn-group">
												<?php foreach($boards as $key) : ?>
												<label class="btn btn-primary">

													<input type="radio" name="option" value="<?php echo $key['boardID']; ?>">

														<?php echo $key['boardTitle']; ?>
														</label>

													<?php endforeach ?>

															<br/><br/>

																				<input class="btn btn-danger" type="submit" id="addBoard" name="addBoard" value="Toevoegen">
																				</div>
										 </form>


    </div>
	</div>

<div class="errors"></div>
<form method="post" action="">
    <div class="statusupdates">
        <h5>Comments</h5>
        <input type="text" placeholder="What's on your mind?" id="activitymessage" name="activitymessage"/>
        <input id="btnSubmit" type="submit" value="Share"/>

        <ul id="listupdates">


       <?php $comment = new Activity();
            $comments = $comment->Comments();


        foreach($comments as $c):?>

    </li>

    <img id='avatar' src=' <?php echo $c["avatar"] ?> ' </img>
    <a href="userprofile.php?user=<?php  echo $c['id_user']?>"><?php echo $c['firstname']?></a>
    <p><?php echo $c['comments']?></p>

    <li>


        <?php endforeach; ?>
        </ul>

    </div>
</form>

<?php include_once ('includes/footer.php') ?>


<!-- /.container -->

<script src="js/jquery.js"></script>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>


<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $("#btnSubmit").on("click", function (e) {
            //console.log("clicked");

            // tekst vak uitlezen
            var update = $("#activitymessage").val();
            var postID = document.getElementById("post").getAttribute("data-id");
            // via AJAX update naar databank sturen
            $.ajax({
                method: "POST",
                url: "ajax/save_update.php",
                data: {update: update, postID: postID} //update: is de naam en update is de waarde (value)
            })

                .done(function (response) {

                    // code + message
                    if (response.code == 200) {

                        // iets plaatsen?
                        var li = $("<li style='display: none;'>");
                        li.html("<img id='avatar' src='" + response.avatar + "' </img>" + "   " + "  " + "<a href='http://localhost/GIT/Pinterest_PHP_Project/userprofile.php?user=" + response.id + "'>" + response.user + "</a>: " + response.message);
                        // waar?
                        $("#listupdates").prepend(li);
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
