<?php

spl_autoload_register(function ($class) { //zoekt alle classes die je nodig heeft autoload
	include_once("classes/" . $class . ".php");
});

session_start();


$id = $_GET['id']; //leest van url balk welk item uit db dit is

$item = new Items();
$result = $item->makeInappropriate($id);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("includes/header.php"); ?>
	<title>IMDterest - Ongepast?</title>
</head>

<body>

<!-- Navigation -->
<?php include("includes/menu.php"); ?>

	<!-- Page Content -->
	<div class="container">
        <?php if ($result): ?>
		    <h2>Bedankt voor je feedback!</h2>
        <?php else: ?>
            <h2>Sorry, je hebt voor dit bericht al feedback gegeven!</h2>
        <?php endif; ?>
        <a href="detail.php?id=<?php print $id ?>">Terug naar het bericht</a>
	</div>

	<div class="errors"></div>

<!-- Footer -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<p>Copyright &copy; IMDterest <?php echo date('Y') ?></p>
			</div>
		</div>
	</div>
</footer>

<!-- /.container -->

<script src="js/jquery.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"
				integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script src="js/comments.js"></script>
<script src="js/loadmore.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
