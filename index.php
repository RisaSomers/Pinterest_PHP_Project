<?php

spl_autoload_register(function ($class) {
	include_once("classes/" . $class . ".php");
});

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




session_start();

if (!empty($_SESSION['email'])) {
} else {
	header('Location: login.php');
}

$conn = Db::getInstance();

if (!empty($_GET["filter"])) {
	switch ($_GET["filter"]) {
		case "mostlikes":
            $items = Filter::mostLikes();
			break;
		case "mostdislikes":
            $items = Filter::mostDislikes();
			break;
		default:
            $items = Filter::getDefault();
			break;
	}
} else {
    $items = Filter::getDefault();
}


$t = new Topic();
$feed = $t->getUserPosts();

$u = new User();



?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
	<?php include("includes/header.php"); ?>

    <title>IMDterest</title>

    <style>


        .liked, .liked:hover, .liked:focus {
            font-weight: bold;
        }

        .disliked, .disliked:hover, .disliked:focus {
            font-weight: bold;
        }

    </style>

</head>

<style>

    img {
        width: 70%;
    }

</style>

<body>

<!-- Navigation -->
<?php include("includes/menu.php"); ?>


<!-- Page Content -->
<h1 class="page-header text-center headersubject">Startpagina</h1>
<div class="container">

    <div class="row">

        <div class="col-lg-12">



            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="filter">Filter:</label>
                            <select name="filter" id="filter" class="form-control">
															<?php if (empty($_GET["filter"])): ?>
                                  <option selected="selected" value="none">None</option>
															<?php else: ?>
                                  <option value="none">None</option>
															<?php endif; ?>

															<?php if ($_GET["filter"] == "mostlikes"): ?>
                                  <option selected="selected" value="mostlikes">Most Likes</option>
															<?php else: ?>
                                  <option value="mostlikes">Most Likes</option>
															<?php endif; ?>

															<?php if ($_GET["filter"] == "mostdislikes"): ?>
                                  <option selected="selected" value="mostdislikes">Most Dislikes</option>
															<?php else: ?>
                                  <option value="mostdislikes">Most Dislikes</option>
															<?php endif; ?>

                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <?php if(!empty($_GET["success"])): ?>
                <div class="success" style="float:right;font-weight: bold;">
                    <?php echo htmlspecialchars($_GET["success"]); ?>
                </div>
            <?php endif; ?>

            <?php if(!empty($_GET["error"])): ?>
                <div class="error" style="float:right;font-weight: bold;>
                    <?php echo htmlspecialchars($_GET["error"]); ?>
                </div>
            <?php endif; ?>













        </div>

        <form action="" method="post">

            <div class="wrapper">
                    <div class="container">
                        <div class="row">
                            <div id="items" class="results">

                             <h1 class="page-header">Inspiration</h1>
                              <?php foreach ($items as $key => $row): ?>
                                <?php $pp = new Item();
                                $pp->setId($row["id"]);
                                $likes = $pp->getLike();
                                $dislikes = $pp->getDislike(); ?>

                                  <div class="col-md-4">


                                      <h2><?php print $row['Beschrijving'] ?></h2>
                                      <a href="userprofile.php?user=<?php print $u->getAllUserSpecific($row['user_id'])['id'] ?>"><?php print $u->getFirstnameUserO($row['user_id'])['0']['firstname'] ?></a>
                                      <a href="detail.php?id=<?php print $row['id'] ?>">


                                          <div class="post_img">
                                            <?php if (!empty($row['Url'])): ?>
                                                <img src="<?php print $row['Url'] ?>" alt="<?php print $row['id'] ?>">
                                            <?php else: ?>
                                                <img src="uploads/posts/<?php print $row['Image'] ?>"
                                                     alt="<?php print $row['id'] ?>">
                                            <?php endif; ?>
                                          </div>
                                      </a>
                                      <?php if ($pp->checkIfLiked($row['id'])): ?>
                                        <a href="#" class="like liked" data-id="<?php print $row['id'] ?>">UNLIKE- <?php echo $likes ?></a>
                                      <?php else: ?>
                                          <a href='#' class='like' data-id='<?php echo $row["id"] ?>'>LIKE - <?php echo $likes ?></a>
                                      <?php endif; ?>

                                      <?php if ($pp->checkIfDisliked($row['id'])): ?>
                                        <a href='#' class='dislike disliked' data-id='<?php echo $row["id"] ?>'>UNDISLIKE - <?php echo $dislikes ?></a>
                                      <?php else: ?>
                                        <a href='#' class='dislike' data-id='<?php echo $row["id"] ?>'>DISLIKE- <?php echo $dislikes ?></a>
                                      <?php endif; ?>
                                      <br>
                                      <span class="time_elapsed"><?php print time_elapsed_string('@' . $row["uploaded"]); ?></span>

                                  </div>

                              <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
            </div>
            <input type="hidden" id="result_no" value="20">
        </form>


    </div>
    <button type='submit' name='more' id='more'>Load more</button>


</div>
    </div>

<hr>

<?php include_once ('includes/footer.php') ?>

</div>
<!-- /.container -->

<!-- jQuery -->

<script src="js/jquery.js"></script>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script src="js/comments.js"></script>
<script src="js/loadmore.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<script>
    function refreshEventListeners() {
        $(".like, .dislike, .liked, .disliked").off();

        $(".like:not(.liked)").bind("click", function (e) {
            e.preventDefault();
            var el = $(this);
            $.get("ajax/like.php", {post_id: this.getAttribute("data-id")}, function (data) {
                if (data.success == true) {
                    el.html("UNLIKE - " + data.count++).addClass("liked");
                    refreshEventListeners();
                }
            })
        });

        $(".dislike:not(.disliked)").bind("click", function (e) {
            e.preventDefault();
            var el = $(this);
            $.get("ajax/dislike.php", {post_id: this.getAttribute("data-id")}, function (data) {
                if (data.success == true) {
                    el.html("UNDISLIKE - " + data.count++).addClass("disliked");
                    refreshEventListeners();
                }
            })
        });

        $(".liked").bind("click", function (e) {
            e.preventDefault();
            var el = $(this);
            $.get("ajax/unlike.php", {post_id: this.getAttribute("data-id")}, function (data) {
                if (data.success == true) {
                    el.html("LIKE - " + data.count--).removeClass("liked");
                    refreshEventListeners();
                }
            })
        });

        $(".disliked").bind("click", function (e) {
            e.preventDefault();
            var el = $(this);
            $.get("ajax/undislike.php", {post_id: this.getAttribute("data-id")}, function (data) {
                if (data.success == true) {
                    el.html("DISLIKE - " + data.count--).removeClass("disliked");
                    refreshEventListeners();
                }
            })
        });

        $("#filter").bind("change select", function (e) {
            window.location.href = 'index.php?filter=' + $("#filter").find("option:selected").val();

        })
    }


    refreshEventListeners();
</script>
<script>
    $(document).ready(function () {
        $("#more").click(function () {
            loadmore();
        });

        $("#like").click(function () {
            like();
        });
    });

    function loadmore() {
        var val = document.getElementById("result_no").value;
        $.ajax({
            type: 'post',
            url: 'AJAX/loadMore.php',
            data: {getresult: val},
            success: function (response) {
                var content = document.getElementById("items");
                content.innerHTML = content.innerHTML + response;
                // LIMIT + 20
                document.getElementById("result_no").value = Number(val) + 20;
            }
        });
    }

</script>


</body>

</html>
