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


$links = $images = array();
$default_check = 'checked';

$href = isset($_GET['href']) ? 1 : 0;
$image = isset($_GET['image']) ? 1 : 0;
$meta = isset($_GET['meta']) ? 1 : 0;
$target_url = isset($_GET['target_url']) ? $_GET['target_url'] : '';
$link_type = isset($_GET['link_type']) ? $_GET['link_type'] : 'all';

$parser = new WebsiteParser($target_url, $link_type);

if (isset($_GET['target_url'])) {
    $default_check = '';

    $title = $parser->getTitle(true);

    if ($href)
        $links = $parser->getHrefLinks(false);

    if ($image)
        $images = $parser->getImageSources();

    if ($meta)
        $meta_tags = $parser->getMetaTags();

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

        ul li a, .meta td {
          font-size: 10px;
      }

      .images {
          margin-left: 0px;
      }

      .images img {
          margin: 5px;
          max-width: 50px;
          max-height: 50px;
      }

      small.error {
          color: red;
          font-size: 10px;
      }

      .input-append select.link-type {
          width: 100px;
          font-size: 10px;
          height: 20px;
      }

      h3.title {
          border-bottom: 1px solid #c0c0c0;
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
        <label for="fileToUpload">Afbeelding</label>
        <input type="file" name="fileToUpload" id="fileToUpload">

        <label for="link">Afbeelding URL</label>
        <input type="url" name="link" id="link" value="<?php echo htmlspecialchars($target_url)?>">

        <?php
        $count = count($images);

        if ($count) {

            echo '<h4>Multiple Images Found: ' . $count . '</h4>';

            echo '<div class="row images">';

            foreach($images as $image) {
                echo '<img src="' . $image . '" />';
            }

            echo '</div>';
        } ?>

        <label for="beschrijving" id="labelbeschrijving">Beschrijving</label>
        <input type="text" name="beschrijving" id="beschrijving" value="<?php echo htmlspecialchars($title); ?>">

        <label for="country">Land</label>
        <input type="text" name="country" id="country"><a href="#" id="get-country">Waar ben ik?</a>
        <!-- Veld voor land in te steken -->

        <input type="submit" value="Upload Item" name="submit" id="submit">

    </form>
</div>
<h1>Or upload trough URL!</h1>
<div class="container" style="margin-top: 60px;">
    <div>
        <h4>
            Extract data uit URL:
            <small class="error"><?= $parser->message ? ('( ' . $parser->message . ' )') : '' ?></small>
        </h4>

        <form method="get" action="">

            <div class="input-prepend input-append">
                <input class="span2" type="text" style="width: 550px;height: 20px;"
                       value="<?= $target_url ?>" name="target_url"
                       placeholder="Enter a public website URL to an image/gif"/>


                <span class="add-on">
                        <input type="checkbox" name="image"
                               value="1" <?= $image ? 'checked' : $default_check ?> /> Image URL

                        <input type="checkbox" name="meta"
                               value="1" <?= $meta ? 'checked' : $default_check ?> /> Beschrijving
                </span>

                <input class="btn btn-primary" type="submit" name="extract" value="Extract Data"/>
            </div>
            <br/>
        </form>
        <?php
if ($title !== null) {
    ?>
    <h3 class="title">Title :: <?= $title ?></h3>
<?php
} ?>

<?php
if (is_array($meta_tags) && count($meta_tags)):
    echo '<h4>Meta Tags: ' . count($meta_tags) . '</h4>';
    ?>
    <table class="meta">
        <?php
        foreach ($meta_tags as $meta_tag):
            ?>
            <tr>
                <td><?= ucfirst($meta_tag[0]) ?></td>
                <td> : </td>
                <td><?= $meta_tag[1] ?></td>
            </tr>
        <?php
        endforeach;
        ?>
    </table>
<?php
endif; ?>


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
