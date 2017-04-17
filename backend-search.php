<?php

spl_autoload_register(function($class){
    include_once("classes/".$class.".class.php");
});
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
try{
    $conn = Db::getInstance();
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

// Attempt search query execution
try{
    if(isset($_REQUEST['term'])){
        // create prepared statement
        $sql = "SELECT * FROM Topics WHERE name LIKE :term";
        $stmt = $conn->prepare($sql);
        $term = $_REQUEST['term'] . '%';
        // bind parameters to statement
        $stmt->bindParam(':term', $term);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
              echo "<p>";
              echo "<a href=\"topics.php\">";
              echo "<img src=\"{$row['image']}" . "\" alt=\"\" />";
              echo $row['name'] . "</p>";
              echo "</a>";
            }
        } else{
            echo "<p>No matches found";
        }
    }
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}

// Close connection
unset($conn);
?>
