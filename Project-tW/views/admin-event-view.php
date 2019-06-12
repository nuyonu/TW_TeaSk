<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skill Enhancer | Admin Evenimente Informatii</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-common.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-event-view.css">
</head>
<body>
<?php
include '../webroot/templates/admin-common.php'; ?>
<div class="main-admin">
    <div class="page-title">
        <h1>Mai multe informații</h1>
    </div>
    <div class="body-admin">
        <div class="more-details">
            <?php if ($event != null) { ?>
                <div class="row">
                    <div class="column">
                        <h2>Titlu</h2>
                        <p><?php echo $event->getTitle() ?></p>
                    </div>
                    <div class="column">
                        <h2>Tipul evenimentului</h2>
                        <p><?php echo $event->getType() ?></p>
                    </div>
                    <div class="column">
                        <h2>Locatia</h2>
                        <p><?php echo $event->getLocation() ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <h2>Pret</h2>
                        <p><?php if ($event->getPrice() == 0)
                                echo "Gratis";
                            else
                                echo $event->getPrice() ?></p>
                    </div>
                    <div class="column">
                        <h2>Cod unic</h2>
                        <p><?php echo $event->getCode() ?></p>
                    </div>
                    <div class="column">
                        <h2>Data de start</h2>
                        <p><?php echo $event->getBeginDate() . " " . $event->getBeginTime() ?></p>
                    </div>
                    <div class="column">
                        <h2>Data de terminare</h2>
                        <p><?php echo $event->getEndDate() . " " . $event->getEndTime() ?></p>
                    </div>
                    <div class="column">
                        <h2>Dificultate</h2>
                        <p><?php echo $event->getDifficulty() ?></p>
                    </div>
                    <div class="column">
                        <h2>Tag-uri</h2>
                        <p><?php echo $event->getTags() ?></p>
                    </div>
                </div>
                <div class="column">
                    <h2>Descriere</h2>
                    <p id="description"><?php echo $event->getDescription() ?></p>
                </div>
                <div class="button-back">
                    <button type="button" onclick="location.href = '/adminEvents'">Înapoi la Admin Evenimente</button>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
</body>
</html>