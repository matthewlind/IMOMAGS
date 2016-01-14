<?php 
$long = $_GET['long'];
$lat = $_GET['lat'];
$zoom = $_GET['zoom'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="authenticity_token" name="csrf-param" />
    <title>Navionics Web API v2</title>

    <link rel="stylesheet" href="http://webapiv2.navionics.com/dist/webapi/webapi.min.css">
    <script type="text/javascript" src="http://webapiv2.navionics.com/dist/webapi/webapi.min.no-dep.js"></script>

    <style type="text/css">
        html, body, .test_map_div {
            margin: 0;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body data-root="http://webapiv2.navionics.com/dist/webapi/images">
   <div class="test_map_div"></div>
    <script>
        var webapi = new JNC.Views.BoatingNavionicsMap({
            tagId: '.test_map_div',
            center: [  <?php echo $long; ?>, <?php echo $lat; ?> ],
            <?php if($zoom){ ?>zoom: '<?php echo $zoom; ?>',<?php } ?>
            navKey: 'Navionics_webapi_01190'
        });

        webapi.showSonarControl(true);
    </script>
</body>
</html>