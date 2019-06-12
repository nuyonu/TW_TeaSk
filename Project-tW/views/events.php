<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Evenimente | Skill Enhancer</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/events.css">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/footer.css">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/navbar-new.css">
</head>
<body>
<?php require_once(TEMPLATES . 'navbar_without_login.php'); ?>
<div class="events-body">
    <div class="events-title">
        <h1>Evenimente</h1>
    </div>
    <div class="search-bar-and-advanced-search">
        <form>
            <div class="search-bar">
                <input type="text" placeholder="Caută un eveniment..." id="title" name="title">
                <button type="button" class="button-show-advanced-search"
                        onclick="openButtonForm('advanced-searh-popup')">
                    <i class="fa fa-button">&#9660;</i>
                </button>
                <button type="submit" class="search-button">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <div class="advanced-search" id="advanced-searh-popup">
                <div class="row-advanced-search">
                    <div class="column-25">
                        <label>Locație:</label>
                    </div>
                    <div class="column-75">
                        <input type="text" placeholder="Introdu o locație..." name="location">
                    </div>
                </div>

                <div class="row-advanced-search">
                    <div class="column-25">
                        <label>Data:</label>
                    </div>
                    <div class="column-75">
                        <label>Incepe pe:</label>
                        <input type="date" name="beginDate" id="beginDate">
                        <label>Se termina pe:</label>
                        <input type="date" name="endDate" id="endDate">
                    </div>
                </div>

                <div class="row-advanced-search">
                    <div class="column-25">
                        <label>Dificultate:</label>
                    </div>
                    <div class="column-75">
                        <select id="difficulty" name="difficulty">
                            <option value=""></option>
                            <option value="1">Ușor</option>
                            <option value="2">Mediu</option>
                            <option value="3">Greu</option>
                        </select>
                    </div>
                </div>

                <div class="row-advanced-search">
                    <div class="column-25">
                        <label>Ordonează după:</label>
                    </div>
                    <div class="column-75">
                        <select name="orderBy" id="orderBy">
                            <option value=""></option>
                            <option value="price">Preț</option>
                            <option value="beginDate">Data de inceput</option>
                        </select>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <div class="events-content">
        <?php
        if ($events != null && strcmp(array_values($events)[0]->getId(), '')) {
            foreach ($events as $event) { ?>
                <div class="event-show">
                    <div class="row-event">
                        <div class="column-20">
                            <h4 class="title">Data de start</h4>
                            <p><?php echo $event->getBeginDate() ?></p>
                        </div>
                        <div class="column-60">
                            <h4 class="title">Titlul evenimentului</h4>
                            <p><?php echo $event->getTitle() ?></p>
                        </div>
                    </div>
                    <div class="row-event">
                        <div class="column-20">
                            <h4 class="title">Data de terminare</h4>
                            <p><?php echo $event->getEndDate() ?></p>
                        </div>
                        <div class="column-20">
                            <h4 class="title">Tipul evenimentului</h4>
                            <p><?php echo $event->getType() ?></p>
                        </div>
                        <div class="column-20">
                            <div class="row-event-intern">
                                <h4 class="title">Locația</h4>
                                <p><?php echo $event->getLocation() ?></p>
                            </div>
                            <div class="row-event-intern">
                                <button class="button-more-details">▼Mai multe detalii▼</button>
                            </div>
                        </div>
                        <div class="column-20">
                            <h4 class="title">Preț</h4>
                            <p><?php if ($event->getPrice() == 0)
                                    echo "Gratis";
                                else
                                    echo $event->getPrice . " lei"?></p>
                        </div>
                        <div class="column-20">
                            <h4 class="title">Eveniment organizat de</h4>
                            <p><?php echo $event->getOrganizer() ?></p>
                        </div>
                    </div>
                    <div class="event-description">
                        <h4 class="title">Descrierea evenimentului</h4>
                        <p><?php echo $event->getDescription() ?></p>
                        <h4 class="title">Locația</h4>
                        <p><?php echo $event->getLocation() ?></p>

                        <h4 class="title">Tag-uri</h4>
                        <p>
                            <?php echo $event->getTags() ?>
                        </p>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
</div>
<?php require_once(TEMPLATES . 'footer.php'); ?>
</body>

<script type="text/javascript" src="../webroot/scripts/events.js" async></script>

</html>
