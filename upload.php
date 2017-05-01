<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});

session_start();


if (!empty($_POST)) {
    try {
        // create prepared statement
        $item = new Items();
        $item->setDescription($_POST["beschrijving"]);
        $item->setCountry($_POST["country"]);
        if (empty($_POST["link"])) {
            $item->setImage($_FILES["fileToUpload"]);
        } else {
            $item->setUrl($_POST["link"]);
        }

        $item->create();
        echo "Item is created";
        header("Location: index.php?success=true");
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

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

<h1>Upload your item!</h1>
<!-- Page Content -->
<div class="container">
    <form action="" method="post" id="upload" enctype="multipart/form-data">
        <label for="fileToUpload">Image</label>
        <input type="file" name="fileToUpload" id="fileToUpload">

        <label for="link">Image Link</label>
        <input type="url" name="link" id="link">

        <label for="beschrijving" id="labelbeschrijving">Beschrijving</label>
        <input type="text" name="beschrijving" id="beschrijving">

        <label for="country">Land</label>
        <input type="text" name="country" id="country"><a href="#" id="get-country">Waar ben ik?</a>
        <!-- Veld voor land in te steken -->

        <input type="submit" value="Upload Item" name="submit" id="submit">
    </form>
</div>

</div>
<script src="js/jquery.js"></script>

<script>
    $("#get-country").bind("click", function(e) {
        e.preventDefault();

        navigator.geolocation.getCurrentPosition(function(location) {
            $.get("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + location.coords.latitude +","+ location.coords.longitude + "&result_type=country&key=AIzaSyDHaF6eSbeVHKUauLOTQi9ri6hCbx8B88g", function(data) {
                $("#country").val(data.results[0].formatted_address);
            });
        });
    });
</script>

<?php include_once ('includes/footer.php') ?>

</div>
<!-- /.container -->

<!-- jQuery -->

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
