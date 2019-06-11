<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Training-uri | Skill Enhancer</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../styles/navbar-new.css"/>
    <link rel="stylesheet" type="text/css" href="../webroot/styles/trainings.css"/>
    <link rel="stylesheet" type="text/css" href="../webroot/styles/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic%7cPatrick+Hand%7cMontserrat+Alternates%7cAnnie+Use+Your+Telescope%7cInconsolata" rel="stylesheet">
</head>
<body>
<?php require_once(TEMPLATES . 'navbar_without_login.php'); ?>
<div class="container-main container-col-flex">
    <h1>Training-uri</h1>
    <p>Pe această pagină poți găsi totalitatea training-urilor specifice preferințelor tale.</p>
    <div class="container-row-flex">
        <div class="container-details">
            <h2>Filtrează training-urile</h2>
            <form action="trainingsfilter" class="filter-form" method="get">

                <div class="container-flex-center-row">
                    <div>
                        <p>Titlu:</p>
                        <input type="text" name="title">
                        <p>Domeniu:</p>
                        <input type="text" name="domain">
                        <p>Are loc după:</p>
                        <input type="date" name="dateStart">
                    </div>
                    <div>
                        <p>Locație:</p>
                        <input type="text" name="location">
                        <p>Specificații:</p>
                        <input type="text" name="specs">
                        <p>Are loc înainte de:</p>
                        <input type="date" name="dateEnd">
                    </div>
                </div>

                <div class="container-flex-center-row">
                    <div>
                        <p>Preț minim:</p>
                        <input type="text" name="minPrice">
                    </div>
                    <div>
                        <p>Preț maxim:</p>
                        <input type="text" name="maxPrice">
                    </div>
                </div>

                <div class="container-flex-center-row">
                    <div class="flex-baseline">
                        <p>Stele minim:</p>
                        <select name="minStars">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="flex-baseline">
                        <p>Stele maxim:</p>
                        <select name="maxStars">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5" selected>5</option>
                        </select>
                    </div>
                </div>

                <div class="container-flex-center-row">
                    <p>Dificultate:</p>
                    <label>
                        <input type="checkbox" name="diffs[]" value="0" checked>Ușoară
                    </label>
                    <label>
                        <input type="checkbox" name="diffs[]" value="1" checked>Medie
                    </label>
                    <label>
                        <input type="checkbox" name="diffs[]" value="2" checked>Grea<br>
                    </label>
                </div>

                <div class="filter-buttons">
                    <input type="submit" value="Filtrează">
                </div>
            </form>

            <div class="trainings-list">
                <?php foreach($trainings as $training): ?>
                    <div>
                        <div class="training-header">
                            <img class="training-header-image" src= <?= $training->getImage() ?> alt= <?= $training->getTitle() ?> />
                            <a class="training-header-title" href="#"> <?= $training->getTitle() ?> </a>
                            <input type="image" src="../webroot/images/heart2.png" alt="Added to preferences" width="24"
                                   height="24"/>
                        </div>
                        <div class="training-table-container">
                            <table class="training-table">
                                <tr>
                                    <th>Locație</th>
                                    <th>Dată</th>
                                    <th>Domeniu</th>
                                    <th>Specificații</th>
                                    <th>Recenzie</th>
                                    <th>Dificultate</th>
                                    <th>Preț</th>
                                </tr>
                                <tr>
                                    <td><?= $training->getLocation() ?></td>
                                    <td><?= $training->getDatetime() ?></td>
                                    <td><?= $training->getDomain() ?></td>
                                    <td><?= $training->getSpecifications() ?></td>
                                    <td>
                                        <?php for ($index = 0; $index < $training->getStars(); $index++) { ?>
                                            <img class="training-star" src="../webroot/images/star-icon.png" alt="Stele"/>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php
                                            if ($training->getDifficulty() == 0) echo "Ușoară";
                                            elseif ($training->getDifficulty() == 1) echo "Medie";
                                            else echo "Grea";
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if ($training->getPrice() <= 0) echo "Gratuit";
                                            elseif ($training->getPrice() == 1) echo "1 leu";
                                            else echo $training->getPrice() . " lei";
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <div class="training-table-show">
                                <button class="training-table-show-button">&#11167</button>
                            </div>
                            <div class="training-table-description">
                                <p>Descriere</p>
                                <?=
                                    mb_substr($training->getDescription(), 0, 300) .
                                    ((strlen($training->getDescription()) >= 300) ? "..." : "")
                                ?>
                                <a href="#" class="training-find-out-more"> ...află mai multe despre '<?= $training->getTitle() ?>' </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="vertical-line"></div>
        <div class="container-trainings">
            <div class="container-col-flex trainings-recent ">
                <h2>Recente</h2>
                <div class="container-row-flex">
                    <?php foreach($recent_trainings as $recent): ?>
                        <div class="training container-col-flex">
                            <p class="training-name"><?= $recent->getTitle() ?></p>
                            <p class="training-location"><?= $recent->getLocation() ?></p>
                            <p class="training-date"><?= $recent->getDatetime() ?></p>
                            <p class="training-domain"><?= $recent->getDomain() ?></p>
                            <p class="training-specifications"><?= $recent->getSpecifications() ?></p>
                            <div>
                                <?php for ($index = 0; $index < $recent->getStars(); $index++) { ?>
                                    <img class="training-star" src="../webroot/images/star-icon.png" alt="Stele"/>
                                <?php } ?>
                            </div>
                            <p class="training-difficulty">Dificultate: <?= $recent->getDifficulty() ?></p>
                            <p class="training-price">Preț:
                                <?php
                                    if ($recent->getPrice() <= 0) echo "Gratuit";
                                    elseif ($recent->getPrice() == 1) echo "1 leu";
                                    else echo $recent->getPrice() . " lei";
                                ?>
                            </p>
                            <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                                 alt="Mai multe detalii"/>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="container-col-flex trainings-near">
                <h2>Cu recenzii bune</h2>
                <div class="container-row-flex">
                    <?php foreach($favorable_trainings as $favorable): ?>
                        <div class="training container-col-flex">
                            <p class="training-name"><?= $favorable->getTitle() ?></p>
                            <p class="training-location"><?= $favorable->getLocation() ?></p>
                            <p class="training-date"><?= $favorable->getDatetime() ?></p>
                            <p class="training-domain"><?= $favorable->getDomain() ?></p>
                            <p class="training-specifications"><?= $favorable->getSpecifications() ?></p>
                            <div>
                                <?php for ($index = 0; $index < $favorable->getStars(); $index++) { ?>
                                    <img class="training-star" src="../webroot/images/star-icon.png" alt="Stele"/>
                                <?php } ?>
                            </div>
                            <p class="training-difficulty">Dificultate: <?= $favorable->getDifficulty() ?></p>
                            <p class="training-price">Preț:
                                <?php
                                    if ($favorable->getPrice() <= 0) echo "Gratuit";
                                    elseif ($favorable->getPrice() == 1) echo "1 leu";
                                    else echo $favorable->getPrice() . " lei";
                                ?>
                            </p>
                            <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                                 alt="Mai multe detalii"/>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="container-col-flex trainings-ratings">
                <h2>Ieftine</h2>
                <div class="container-row-flex">
                    <?php foreach($cheap_trainings as $cheap): ?>
                        <div class="training container-col-flex">
                            <p class="training-name"><?= $cheap->getTitle() ?></p>
                            <p class="training-location"><?= $cheap->getLocation() ?></p>
                            <p class="training-date"><?= $cheap->getDatetime() ?></p>
                            <p class="training-domain"><?= $cheap->getDomain() ?></p>
                            <p class="training-specifications"><?= $cheap->getSpecifications() ?></p>
                            <div>
                                <?php for ($index = 0; $index < $cheap->getStars(); $index++) { ?>
                                    <img class="training-star" src="../webroot/images/star-icon.png" alt="Stele"/>
                                <?php } ?>
                            </div>
                            <p class="training-difficulty">Dificultate: <?= $cheap->getDifficulty() ?></p>
                            <p class="training-price">Preț:
                                <?php
                                    if ($cheap->getPrice() <= 0) echo "Gratuit";
                                    elseif ($cheap->getPrice() == 1) echo "1 leu";
                                    else echo $cheap->getPrice() . " lei";
                                ?>
                            </p>
                            <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                                 alt="Mai multe detalii"/>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="container-col-flex trainings-price">
                <h2>Din apropiere</h2>
                <div class="container-row-flex">
                    <?php foreach($close_trainings as $close): ?>
                        <div class="training container-col-flex">
                            <p class="training-name"><?= $close->getTitle() ?></p>
                            <p class="training-location"><?= $close->getLocation() ?></p>
                            <p class="training-date"><?= $close->getDatetime() ?></p>
                            <p class="training-domain"><?= $close->getDomain() ?></p>
                            <p class="training-specifications"><?= $close->getSpecifications() ?></p>
                            <div>
                                <?php for ($index = 0; $index < $close->getStars(); $index++) { ?>
                                    <img class="training-star" src="../webroot/images/star-icon.png" alt="Stele"/>
                                <?php } ?>
                            </div>
                            <p class="training-difficulty">Dificultate: <?= $close->getDifficulty() ?></p>
                            <p class="training-price">Preț:
                                <?php
                                    if ($close->getPrice() <= 0) echo "Gratuit";
                                    elseif ($close->getPrice() == 1) echo "1 leu";
                                    else echo $close->getPrice() . " lei";
                                ?>
                            </p>
                            <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                                 alt="Mai multe detalii"/>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once(TEMPLATES . 'footer.php'); ?>

<script src="../webroot/scripts/trainings.js"></script>
</body>
</html>
