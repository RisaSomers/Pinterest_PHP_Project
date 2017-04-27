<?php

spl_autoload_register(function ($class) {
	include_once("classes/" . $class . ".class.php");
});

session_start();

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
        <h2>Sorry, dit item is niet meer beschikbaar</h2>
        <p><i>Het bericht werd gemarkeerd als aanstootgevend of ongepast.</i></p>
        <p><a href="index.php" class="">Home</a></p>
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
