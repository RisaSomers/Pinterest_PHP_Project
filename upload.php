<?php

spl_autoload_register(function ($class) {
    include_once("classes/".$class.".php");
});

session_start();


if (!empty($_POST)) {
    try {
        // create prepared statement
        $item = new Item();
        $item->setDescription(htmlspecialchars($_POST["beschrijving"]));
        $item->setCity(htmlspecialchars($_POST["city"]));
        if (empty($_POST["link"])) {
            $item->setImage($_FILES["fileToUpload"]);
        } else {
            $item->setUrl(htmlspecialchars($_POST["link"]));
        }

        $item->create();
        echo "Item is created";
        header("Location: index.php?success=Item successfully uploaded!");
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
      #country {
          float: left;
          margin-right: 10px;
      }
        #labelcountry {
            display: block;
        }
        img{
            cursor: pointer;


        }


    </style>
</head>

<body>

<!-- Navigation -->
<?php include("includes/menu.php"); ?>

<h1 class="page-header text-center headersubject">Voeg je werk toe</h1>
<!-- Page Content -->
<div class="container">
    <div class="col-md-2"></div>
    <div class="col-md-8 text-center profilechangeblock">
    <form action="" method="post" id="upload" enctype="multipart/form-data">
        <div class="form-group">
        <label for="fileToUpload">Voeg je afbeelding toe <br>(Maximumgrootte 3mb)</label>
        <input type="file"    class="center-block" name="fileToUpload" id="fileToUpload">

        <label for="link">URL</label>
        <input type="text" name="link" class="form-control url_img" id="link url_img">
            <br>
        <?php
        $count = count($images);

        if ($count) {

            echo '<h4>Meerdere afbeeldingen gevonden, selecteer 1 afbeelding: ' . $count . '</h4>';

            echo '<div class="row images">';

            foreach($images as $image) {
                echo '<img src="' . $image . '" />';
            }

            echo '</div>';
        } ?>

        <label for="beschrijving" id="labelbeschrijving" >Beschrijving</label>
        <input type="text"  class="form-control" name="beschrijving" id="beschrijving" value="<?php echo htmlspecialchars($meta_tags['1']['1'])?>">
             <br>
        <label for="city" id="labelcountry">City</label>
        <input type="text" class="form-control" name="city" id="city"><a href="#" id="get-city">Verkrijg locatie</a>
        <br>
        <!-- Veld voor land in te steken -->

        <input type="submit" class="btn btn-danger btn-block btn-lg center-block" value="Upload Item" name="submit" id="submit">
        </div>
    </form>
</div>

<div class="col-md-2"></div>
<div class="col-md-8 text-center profilechangeblock urlBlock">
<h1 style="text-align: center; color:black;"><small>Of geef een URL om afbeeldingen op te laden van een andere site!</small></h1>

    <div class="form-group">
        <h4>
            <small class="error"><?= $parser->message ? ('( ' . $parser->message . ' )') : '' ?></small>
        </h4>

        <form method="get" action="">

            <div class="input-prepend input-append">
                <input class="span2 form-control" type="text"
                       value="<?= $target_url ?>" name="target_url"
                       placeholder="Geef de link naar de website en wij zoeken de afbeeldingen voor jouw!" style="margin-bottom:5%; margin-top:5%;"/>


                <span class="add-on">
                        <label for="checkbox-inline" >Website URL
                        <input type="checkbox"  name="image"
                        value="1" <?= $image ? 'checked' : $default_check ?> /></label>
                               <label for="checkbox-inline" >Beschrijving
                        <input type="checkbox" name="meta"
                               value="1" <?= $meta ? 'checked' : $default_check ?> /></label>
                </span>

                <input class="btn btn-danger btn-block btn-lg center-block" type="submit" name="extract" value="Zoek afbeelding via URL" style="margin-top:5%;"/>
            </div>
            <br/>
        </form>

    </table>
</div>
</div>
<div class="col-md-2"></div>
</div>

<script src="js/jquery.js"></script>

<script>
    $("#get-city").bind("click", function(e) {
        e.preventDefault();

        navigator.geolocation.getCurrentPosition(function(location) {
            $.get("https://maps.googleapis.com/maps/api/geocode/json?latlng=" + location.coords.latitude +","+ location.coords.longitude + "&result_type=locality&key=AIzaSyDHaF6eSbeVHKUauLOTQi9ri6hCbx8B88g", function(data) {
                $("#city").val(data.results[0].formatted_address);
            });
        });
    });

    $('img').on('click',function(){
  //using id
  $('#url_image').val($(this).attr('src'));
   //using class
  $('.url_img').val($(this).attr('src'));
});
</script>

<?php include_once ('includes/footer.php') ?>

</div>


<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
</body>

</html>
