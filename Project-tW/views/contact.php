<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="author" content="Filos Gabriel">
    <meta charset="UTF-8">
    <title>Skill Enhancer</title>
    <!--<link rel="stylesheet" type="text/css" href="./styles/index.css">-->
    <link rel="stylesheet" type="text/css" href="../styles/navbar-new.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/footer.css">
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic%7cPatrick+Hand%7cMontserrat+Alternates%7cAnnie+Use+Your+Telescope%7cInconsolata"
          rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Lilita+One" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/contact.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <script src="../webroot/scripts/navbar.js"></script>-->
</head>
<body>
<?php

if (strcmp(Parameters::getData("show"), "hidden") == 0) {
    require_once(TEMPLATES . 'navbar_without_login.php');
} else {
    include TEMPLATES . 'navbar.php';
}

?>

<div class="body" style="margin-top: 0">
    <div class="linie">
        <div class="title">
            <div class="subtitle">
                <span class="subtitle1">Don't be a stranger</span>
                <span class="subtitle2">just say hello.</span>
            </div>
            <div class="descibe">
                <div class="text">
                    <p>
                        Feel free to get in touch with me. I am always open to discussing new projects, creative ideas
                        or
                        opportunities to be part of your visions.
                    </p>
                    <div class="help">
                        <p>Ai nevoie de ajutor? </p>
                        <span class="gmail">email@gmail.</span>
                        <!--<p><email class="email">email@gmail.</email>com</p>-->
                    </div>
                    <div class="help">
                        <p>Simtete liber sa ne suni </p>
                        <span class="gmail">072324424223</span>
                    </div>
                </div>
                <div class="input">
                    <form method="post" action="/contact/send" >
                        <input type="text" placeholder="Numele" class="contact" name="contact[name]" required>
                        <input type="text" placeholder="E-mail" class="contact" name="contact[email]" required>
                        <input type="text" placeholder="Problema" class="contact" name="contact[type]" id="namesend" required>
                        <input type="text" placeholder="Descrieti problema  " name="contact[problem]" class="contact" id="description" required>
                        <button type="submit" name="Trimite" class="butontrimitere" id="okbutton">Trimite</button>
                    </form>
                </div>

            </div>


        </div>

    </div>

</div>
<div class="basefooter">
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
</div>
</body>
</html>