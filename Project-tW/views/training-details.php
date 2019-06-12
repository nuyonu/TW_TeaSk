<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skill Enhancer | Detalii Training</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-common.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-event-view.css">
    <link rel="stylesheet" type="text/css" href="../styles/navbar-new.css"/>
    <link rel="stylesheet" type="text/css" href="../webroot/styles/training-details.css"/>
    <link rel="stylesheet" type="text/css" href="../webroot/styles/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic%7cPatrick+Hand%7cMontserrat+Alternates%7cAnnie+Use+Your+Telescope%7cInconsolata" rel="stylesheet">
</head>
<body>
<?php require_once(TEMPLATES . 'navbar_without_login.php'); ?>
<div class="main-admin">
    <div class="page-title">
        <h1>Detalii Training "<?php echo $training->getTitle(); ?>" </h1>
    </div>
    <div class="body-admin">
        <div class="more-details">
            <div class="row">
                <div class="column">
                    <h2>Organizator</h2>
                    <p><?php echo $training->getOrganizer() ?></p>
                </div>
                <div class="column">
                    <h2>Postat de user-ul</h2>
                    <p><?php echo $training->getUsername() ?></p>
                </div>
                <div class="column">
                    <h2>Locatia</h2>
                    <p><?php echo $training->getLocation() ?></p>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <h2>Specificatii</h2>
                    <p><?php echo $training->getSpecifications() ?></p>
                </div>
                <div class="column">
                    <h2>Domeniu</h2>
                    <p><?php echo $training->getDomain() ?></p>
                </div>
                <div class="column">
                    <h2>Data de start</h2>
                    <p><?php echo $training->getDatetime() ?></p>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <h2>Pret</h2>
                    <p> <?php
                        if ($training->getPrice() <= 0) echo "Gratuit";
                        elseif ($training->getPrice() == 1) echo "1 leu";
                        else echo $training->getPrice() . " lei";
                        ?></p>
                </div>
                <div class="column">
                    <h2>Recenzii</h2>
                    <?php if ($training->getStars() == 0) echo "-"; ?>
                    <?php for ($index = 0; $index < $training->getStars(); $index++) { ?>
                        <img class="training-star" src="../webroot/images/star-icon.png" alt="Stele"/>
                    <?php } ?>
                </div>
                <div class="column">
                    <h2>Dificultate</h2>
                    <p> <?php
                        if ($training->getDifficulty() == 0) echo "Ușoară";
                        elseif ($training->getDifficulty() == 1) echo "Medie";
                        else echo "Grea";
                        ?></p>
                </div>
            </div>
            <div class="column">
                <h2>Descriere</h2>
                <p id="description"><?php echo $training->getDescription() ?></p>
            </div>
            <div class="button-back">
                <button type="button" onclick="location.href = '/trainings'">Înapoi la Training-uri</button>
            </div>
        </div>
    </div>
</div>
<?php require_once(TEMPLATES . 'footer.php'); ?>
</body>
</html>