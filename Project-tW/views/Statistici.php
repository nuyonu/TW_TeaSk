<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statistici | Skill Enhancer</title>
    <link rel="stylesheet" type="text/css" href="../styles/navbar-new.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic%7cPatrick+Hand%7cMontserrat+Alternates%7cAnnie+Use+Your+Telescope%7cInconsolata"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lilita+One" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/statistics.css">
    <script src="https://cdn.anychart.com/js/8.0.1/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/js/8.0.1/anychart-pie.min.js"></script>

</head>
<body>
<?php Render::navbar(); ?>
<div class="body">
    <div class="containerS">
        <div class="part">
            <div id="pieLanguages" style="width: 100%; height: 100%"></div>
        </div>


    </div>

</div>

</body>

<script type="text/javascript">
    anychart.onDocumentReady(function () {

        // set the data
        var data = [
            <?php Draw::lang() ?>
        ];

        // create the chart
        var chart = anychart.pie();

        // set the chart title
        chart.title("Procentajul limbajelor folosite");

        // add the data
        chart.data(data);

        // display the chart in the container
        chart.container('pieLanguages');
        chart.legend().position("right");
// set items layout
        chart.legend().itemsLayout("vertical");
        chart.draw();

    });
    document.getElementsByClassName('anychart-credits-text').style.display='none';
    <!-- chart code will be here -->
</script>
</html>