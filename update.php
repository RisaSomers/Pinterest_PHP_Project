<?

spl_autoload_register(function ($class) {
	include_once("classes/" . $class . ".php");
});

// Read values from detail.php
$boardID = $_POST['option'];
$postID = $_POST['id'];

// Create a Board object.
$sB = new Board();

// Update the board.
$sBoard = $sB->savePostToBoard($postID, $boardID);
header('Location:user_uploads.php?PostSuccessfullyAdded');
