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
} else {
    header('Location: login.php');
}

$conn = Db::getInstance();

$statement = $conn->prepare("select * from items order by id DESC limit 0,20");
$statement->execute();

$t = new Topics();
$feed = $t->getUserPosts();

$u = new Users();


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

                                <?php $items = $statement->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($items as $key => $row) {
                                    $pp = new Items();
                                    $pp->setId($row["id"]);
                                    $likes = $pp->getLike();
                                    $dislikes = $pp->getDislike();
                                    echo "<h2>" . $row['Beschrijving'] . "</h2>
            <a href=userprofile.php?user=" . $u->getAllUserSpecific($row['user_id'])['id'] . ">" . $u->getFirstnameUserO($row['user_id'])['0']['firstname'] . "</a>
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
                           </a>";

                                    if ($pp->checkIfLiked($row['id'])): ?>
                                        <a href='#' class='like liked' data-id='<?php echo $row["id"] ?>'>UNLIKE
                                            - <?php echo $likes ?></a>
                                    <?php else: ?>
                                        <a href='#' class='like' data-id='<?php echo $row["id"] ?>'>LIKE
                                            - <?php echo $likes ?></a>
                                    <?php endif; ?>

                                    <?php if ($pp->checkIfDisliked($row['id'])): ?>
                                        <a href='#' class='dislike disliked' data-id='<?php echo $row["id"] ?>'>UNDISLIKE
                                            - <?php echo $dislikes ?></a>
                                    <?php else: ?>
                                        <a href='#' class='dislike' data-id='<?php echo $row["id"] ?>'>DISLIKE
                                            - <?php echo $dislikes ?></a>
                                    <?php endif;
                                    echo "<br>";
                                    echo time_elapsed_string('@' . $row["uploaded"]);
                                } ?>

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