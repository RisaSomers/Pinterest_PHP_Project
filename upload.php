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

include 'includes/website_parser.php';

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

<div class="container" style="margin-top: 60px;">
    <div>
        <h4>
            Extract website links
            <small class="error"><?= $parser->message ? ('( ' . $parser->message . ' )') : '' ?></small>
        </h4>

        <form method="get" action="">

            <div class="input-prepend input-append">
                <input class="span2" type="text" style="width: 550px;height: 20px;"
                       value="<?= $target_url ?>" name="target_url"
                       placeholder="Enter a public website URL with trailing slash"/>

                <span class="add-on">
                        <input type="checkbox" name="href"
                               value="1" <?= $href ? 'checked' : $default_check ?> /> Href

                    <select name="link_type" class="link-type">
                        <option <?= $link_type == WebsiteParser::LINK_TYPE_ALL ? 'selected' : '' ?>
                            value="<?= WebsiteParser::LINK_TYPE_ALL ?>">All Links
                        </option>
                        <option <?= $link_type == WebsiteParser::LINK_TYPE_INTERNAL ? 'selected' : '' ?>
                            value="<?= WebsiteParser::LINK_TYPE_INTERNAL ?>">Internal
                        </option>
                        <option <?= $link_type == WebsiteParser::LINK_TYPE_EXTERNAL ? 'selected' : '' ?>
                            value="<?= WebsiteParser::LINK_TYPE_EXTERNAL ?>">External
                        </option>
                    </select>
                </span>

                <span class="add-on">
                        <input type="checkbox" name="image"
                               value="1" <?= $image ? 'checked' : $default_check ?> /> Image

                        <input type="checkbox" name="meta"
                               value="1" <?= $meta ? 'checked' : $default_check ?> /> Meta Tag
                </span>

                <input class="btn btn-primary" type="submit" name="extract" value="Extract Links"/>
                
                <?php include 'views/title.html.php'; ?>
                        <?php include 'views/meta.html.php'; ?>
                        <?php include 'views/href.html.php'; ?>
                        <?php include 'views/image.html.php'; ?>
            </div>
            <br/>
        </form>


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
