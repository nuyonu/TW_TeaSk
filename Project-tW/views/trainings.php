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
            <form class="filter-form">
                Nume:<br>
                <input type="text" name="name"><br>
                Locație:<br>
                <input type="text" name="location"><br>
                Dată:<br>
                <input type="text" name="date"><br>
                Domeniu:<br>
                <input type="text" name="domeniu"><br>
                Specificații:<br>
                <input type="text" name="specifications"><br>
                Dificultate:<br>
                <label>
                    <input type="radio" name="difficulty" value="easy" checked>Ușoară
                </label>
                <label>
                    <input type="radio" name="difficulty" value="medium">Medie
                </label>
                <label>
                    <input type="radio" name="difficulty" value="hard">Grea<br>
                </label>
                Preț:<br>
                <input type="text" name="min-price"> -
                <input type="text" name="max-price"><br>
                <div class="filter-buttons">
                    <input type="submit" value="Filtrează">
                    <input type="submit" value="Resetează">
                </div>
            </form>

            <div class="trainings-list">
                <div>
                    <div class="training-header">
                        <img src="../webroot/images/c++.png" alt="Super Training"/>
                        <a href="#">Super Training</a>
                        <input type="image" src="../webroot/images/heart2.png" alt="Added to preferences" width="24"
                               height="24"/>
                    </div>
                    <ul>
                        <li>Iași</li>
                        <li>17 Aprilie 2019</li>
                        <li>Dezvoltator Web</li>
                        <li>C++, C#, Java</li>
                    </ul>
                </div>
                <div>
                    <div class="training-header">
                        <img src="../webroot/images/haskell.png" alt="Mega Training"/>
                        <a href="#">Mega Training</a>
                        <input type="image" src="../webroot/images/heart3.png" alt="Add to preferences" width="24"
                               height="24"/>
                    </div>
                    <ul>
                        <li>Suceava</li>
                        <li>18 Mai 2019</li>
                        <li>Tester</li>
                        <li>Haskell</li>
                    </ul>
                </div>
                <div>
                    <div class="training-header">
                        <img src="../webroot/images/hardware.jpg" alt="Hardware Training"/>
                        <a href="#">Hardware Training</a>
                        <input type="image" src="../webroot/images/heart3.png" alt="Add to preferences" width="24"
                               height="24"/>
                    </div>
                    <ul>
                        <li>Botoșani</li>
                        <li>20 Iunie 2019</li>
                        <li>Dezvoltator Desktop</li>
                        <li>ASM</li>
                    </ul>
                </div>
                <div>
                    <div class="training-header">
                        <img src="../webroot/images/excel.png" alt="Tech Lead Training"/>
                        <a href="#">Tech Lead Training</a>
                        <input type="image" src="../webroot/images/heart3.png" alt="Add to preferences" width="24"
                               height="24"/>
                    </div>
                    <ul>
                        <li>Timișoara</li>
                        <li>6 Decembrie 2020</li>
                        <li>Tech Lead</li>
                        <li>Excel, Word, Access</li>
                    </ul>
                </div>
                <div>
                    <div class="training-header">
                        <img src="../webroot/images/javascript.png" alt="BestWeb Training"/>
                        <a href="#">BestWeb Training</a>
                        <input type="image" src="../webroot/images/heart2.png" alt="Add to preferences"/>
                    </div>
                    <ul>
                        <li>București</li>
                        <li>30 Ianuarie 2019</li>
                        <li>Front-End Developer</li>
                        <li>Javascript, HTML, CSS</li>
                    </ul>
                </div>
                <div>
                    <div class="training-header">
                        <img src="../webroot/images/c-sharp.png" alt="Mega Dev Training"/>
                        <a href="#">Mega Dev Training</a>
                        <input type="image" src="../webroot/images/heart2.png" alt="Add to preferences"/>
                    </div>
                    <ul>
                        <li>Vaslui</li>
                        <li>23 Mai 2019</li>
                        <li>Dezvoltator Desktop</li>
                        <li>Java, C#</li>
                    </ul>
                </div>
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
</body>
</html>