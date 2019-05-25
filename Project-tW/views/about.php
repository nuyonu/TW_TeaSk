<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Despre | Skill Enhancer</title>
    <link rel="stylesheet" type="text/css" href="../webroot/styles/about.css"/>
    <link rel="stylesheet" type="text/css" href="../webroot/styles/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic%7cPatrick+Hand%7cMontserrat+Alternates%7cAnnie+Use+Your+Telescope%7cInconsolata"
          rel="stylesheet">

</head>
<body>
<?php

if (strcmp(Parameters::getData("show"), "hidden") == 0) {
    require_once(TEMPLATES . 'navbar_without_login.php');
} else {
    include TEMPLATES . 'navbar.php';
}

?>
<div class="container-main container-col-flex">
    <h1 >Despre</h1>
    <h4><i>"Tehnologia este natura omului modern"</i> - Octavio Paz</h4>
    <h2>Țelul site-ului</h2>
    <div class="container-row-flex">
        <img src="../webroot/images/about.png" alt="Despre">
        <p>
            Skill Enhancer este o platformă ce conferă utilizatorilor o listă a celor mai importante evenimente ce țin
            de domeniul IT.
            Atât conferințele, atelierele de lucru, concursurile și stagiile de practica, cât și proiectele software la
            care un utilizator
            ar putea participa, sunt sugerate în funcție de profilul tehnic al utilizatorului. Echipa din spatele
            proiectului Skill Enhancer
            dorește să evoluționeze felul în care persoanele pasionate de programare își aleg preferințele în ceea ce
            privește informatica.
        </p>
    </div>
    <h2>Dezvoltatorii site-ului</h2>
    <div class="container-row-flex">
        <ul>
            <li>Grigoraș Alexandru-Ionel</li>
            <li>Filoș Gabriel</li>
            <li>Maxim Paul</li>
        </ul>
        <img src="../webroot/images/about2.png" alt="Dezvoltatori">
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
