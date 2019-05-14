<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Training-uri | Skill Enhancer</title>
    <link rel="stylesheet" type="text/css" href="../webroot/styles/trainings.css"/>
    <link rel="stylesheet" type="text/css" href="../webroot/styles/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic%7cPatrick+Hand%7cMontserrat+Alternates%7cAnnie+Use+Your+Telescope%7cInconsolata" rel="stylesheet">
    <script src="../webroot/scripts/navbar.js"></script>
</head>
<body>
<div class="container-main container-col-flex">
    <h1>Training-uri</h1>
    <p>Pe această pagină poți găsi totalitatea training-urilor specifice preferințelor tale.</p>
    <div class="container-row-flex">
        <div class="container-details">
            <h2>Filtrează training-urile</h2>
            <form action="trainingsfilter" class="filter-form" method="get">
                Nume:<br><input type="text" name="title"><br>
                Locație:<br><input type="text" name="location"><br>
                Are loc după:<br><input type="date" name="dateStart"><br>
                Are loc înainte de:<br><input type="date" name="dateEnd"><br>
                Domeniu:<br><input type="text" name="domain"><br>
                Specificații:<br><input type="text" name="specs"><br>
                Stele:<br>
                Minim: <select name="minStars">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                Maxim: <select name="maxStars">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5" selected>5</option>
                </select><br>
                Dificultate:<br>
                <label>
                    <input type="checkbox" name="diffs[]" value="0" checked>Ușoară
                </label>
                <label>
                    <input type="checkbox" name="diffs[]" value="1" checked>Medie
                </label>
                <label>
                    <input type="checkbox" name="diffs[]" value="2" checked>Grea<br>
                </label>
                Preț:<br>
                <input type="text" name="minPrice"> -
                <input type="text" name="maxPrice"><br>
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
                    <div class="training container-col-flex">
                        <p class="training-name">Super Training</p>
                        <p class="training-location">Iași</p>
                        <p class="training-date">16 Aprilie 2019</p>
                        <p class="training-domain">Dezvoltator Web</p>
                        <p class="training-specifications">C++, C#, Java</p>
                        <img class="training-ratings-picture" src="../webroot/images/stars-3.png" alt="5 Stele"/>
                        <p class="training-difficulty">Dificultate: Medie</p>
                        <p class="training-price">Preț: 20 de lei</p>
                        <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                             alt="Mai multe detalii"/>
                    </div>
                    <div class="training container-col-flex">
                        <p class="training-name">Super Training</p>
                        <p class="training-location">Iași</p>
                        <p class="training-date">16 Aprilie 2019</p>
                        <p class="training-domain">Dezvoltator Web</p>
                        <p class="training-specifications">C++, C#, Java</p>
                        <img class="training-ratings-picture" src="../webroot/images/stars-3.png" alt="5 Stele"/>
                        <p class="training-difficulty">Dificultate: Medie</p>
                        <p class="training-price">Preț: 20 de lei</p>
                        <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                             alt="Mai multe detalii"/>
                    </div>
                </div>
            </div>
            <div class="container-col-flex trainings-near">
                <h2>Din apropiere</h2>
                <div class="container-row-flex">
                    <div class="training container-col-flex">
                        <p class="training-name">Mega Training</p>
                        <p class="training-location">Suceava</p>
                        <p class="training-date">18 Mai 2019</p>
                        <p class="training-domain">Tester</p>
                        <p class="training-specifications">Haskell</p>
                        <img class="training-ratings-picture" src="../webroot/images/stars-4.png" alt="5 Stele"/>
                        <p class="training-difficulty">Dificultate: Ușoară</p>
                        <p class="training-price">Preț: 50 de lei</p>
                        <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                             alt="Mai multe detalii"/>
                    </div>
                    <div class="training container-col-flex">
                        <p class="training-name">Mega Training</p>
                        <p class="training-location">Suceava</p>
                        <p class="training-date">18 Mai 2019</p>
                        <p class="training-domain">Tester</p>
                        <p class="training-specifications">Haskell</p>
                        <img class="training-ratings-picture" src="../webroot/images/stars-4.png" alt="5 Stele"/>
                        <p class="training-difficulty">Dificultate: Ușoară</p>
                        <p class="training-price">Preț: 50 de lei</p>
                        <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                             alt="Mai multe detalii"/>
                    </div>
                </div>
            </div>
            <div class="container-col-flex trainings-ratings">
                <h2>Cu recenzii bune</h2>
                <div class="container-row-flex">
                    <div class="training container-col-flex">
                        <p class="training-name">Hyper Training</p>
                        <p class="training-location">Timișoara</p>
                        <p class="training-date">22 Iunie 2019</p>
                        <p class="training-domain">Manager</p>
                        <p class="training-specifications">Team Leader Skills</p>
                        <img class="training-ratings-picture" src="../webroot/images/stars-5.png" alt="5 Stele"/>
                        <p class="training-difficulty">Dificultate: Grea</p>
                        <p class="training-price">Preț: 150 de lei</p>
                        <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                             alt="Mai multe detalii"/>
                    </div>
                    <div class="training container-col-flex">
                        <p class="training-name">Hyper Training</p>
                        <p class="training-location">Timișoara</p>
                        <p class="training-date">22 Iunie 2019</p>
                        <p class="training-domain">Manager</p>
                        <p class="training-specifications">Team Leader Skills</p>
                        <img class="training-ratings-picture" src="../webroot/images/stars-5.png" alt="5 Stele"/>
                        <p class="training-difficulty">Dificultate: Grea</p>
                        <p class="training-price">Preț: 150 de lei</p>
                        <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                             alt="Mai multe detalii"/>
                    </div>
                </div>
            </div>
            <div class="container-col-flex trainings-price">
                <h2>Ieftine</h2>
                <div class="container-row-flex">
                    <div class="training container-col-flex">
                        <p class="training-name">Extreme Training</p>
                        <p class="training-location">Botoșani a.k.a. Vaslui</p>
                        <p class="training-date">30 Martie 2019</p>
                        <p class="training-domain">Dezvoltator Desktop</p>
                        <p class="training-specifications">C++, ASM</p>
                        <img class="training-ratings-picture" src="../webroot/images/stars-3.png" alt="5 Stele"/>
                        <p class="training-difficulty">Dificultate: Medie</p>
                        <p class="training-price">Preț: Gratuit</p>
                        <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                             alt="Mai multe detalii"/>
                    </div>
                    <div class="training container-col-flex">
                        <p class="training-name">Extreme Training</p>
                        <p class="training-location">Botoșani a.k.a. Vaslui</p>
                        <p class="training-date">30 Martie 2019</p>
                        <p class="training-domain">Dezvoltator Desktop</p>
                        <p class="training-specifications">C++, ASM</p>
                        <img class="training-ratings-picture" src="../webroot/images/stars-3.png" alt="5 Stele"/>
                        <p class="training-difficulty">Dificultate: Medie</p>
                        <p class="training-price">Preț: Gratuit</p>
                        <img class="training-more-picture" src="../webroot/images/click-for-more.png"
                             alt="Mai multe detalii"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="page-footer">

    <small id="copyright"><i class="fas fa-copyright"></i>Copyright 2019. All rights reserved.</small>
    <ul>
        <li>
            <a href="" target="_blank">
                <i class="fab fa-facebook-f" style="color: #888888"></i>
            </a>
        </li>
        <li>
            <a href="" target="_blank" style="color: #888888">
                <i class="fab fa-twitter"></i>
            </a>
        </li>
        <li>
            <a href="" target="_blank">
                <i class="fab fa-linkedin" style="color: #888888"></i>
            </a>
        </li>
        <li>
            <a href="" target="_blank">
                <i class="fab fa-github" style="color: #888888"></i>
            </a>
        </li>
    </ul>
</footer>
<script src="../webroot/scripts/trainings.js"></script>
</body>
</html>
