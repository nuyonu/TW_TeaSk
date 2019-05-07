<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Evenimente | Skill Enhancer</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/events.css">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/footer.css">
    <script src="../webroot/scripts/navbar.js"></script>
</head>
<body>

<div class="events-body">
    <div class="events-title">
        <h1>Evenimente</h1>
    </div>
    <div class="search-bar-and-advanced-search">
        <form class="search-bar">
            <input type="text" placeholder="Caută un eveniment...">
            <button type="button" class="button-show-advanced-search"
                    onclick="openButtonForm('advanced-searh-popup')">
                <i class="fa fa-button">&#9660;</i>
            </button>
            <button type="submit" class="search-button">
                <i class="fa fa-search"></i>
            </button>
        </form>
        <form class="advanced-search" id="advanced-searh-popup">
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
                    <input type="date" name="date">
                    <label>Se termina pe:</label>
                    <input type="date" name="date">
                </div>
            </div>

            <div class="row-advanced-search">
                <div class="column-25">
                    <label>Dificultate:</label>
                </div>
                <div class="column-75">
                    <select>
                        <option value=""></option>
                        <option value="easy">Ușor</option>
                        <option value="medium">Mediu</option>
                        <option value="hard">Greu</option>
                    </select>
                </div>
            </div>

            <div class="row-advanced-search">
                <div class="column-25">
                    <label>Ordonează după:</label>
                </div>
                <div class="column-75">
                    <select>
                        <option value=""></option>
                        <option value="price">Preț</option>
                        <option value="data_de_inceput">Data de inceput</option>
                        <option value="points">Puncte</option>
                    </select>
                </div>
            </div>

        </form>
    </div>
    <div class="events-content">
        <div class="event-show">
            <div class="row-event">
                <div class="column-20">
                    <h4 class="title">Data de start</h4>
                    <p>25-09-2019</p>
                </div>
                <div class="column-60">
                    <h4 class="title">Titlul evenimentului</h4>
                    <p>Voi nu v-ați săturat să fiți români?</p>
                </div>
                <div class="column-20">
                    <button class="validate-button" type="button">Verifică valabilitatea</button>
                </div>
            </div>
            <div class="row-event">
                <div class="column-20">
                    <h4 class="title">Data de terminare</h4>
                    <p>25-09-2019</p>
                </div>
                <div class="column-20">
                    <h4 class="title">Tipul evenimentului</h4>
                    <p>Social</p>
                </div>
                <div class="column-20">
                    <div class="row-event-intern">
                        <h4 class="title">Locația</h4>
                        <p>Suceava, Fălticeni</p>
                    </div>
                    <div class="row-event-intern">
                        <button class="button-more-details">▼Mai multe detalii▼</button>
                    </div>
                </div>
                <div class="column-20">
                    <h4 class="title">Preț</h4>
                    <p>500Lei</p>
                </div>
                <div class="column-20">
                    <h4 class="title">Eveniment organizat de</h4>
                    <p>Maxim Paul S.R.L</p>
                </div>
            </div>
            <div class="event-description">
                <h4 class="title">Descrierea evenimentului</h4>
                <p>
                    Maximilian Paulo Arabu, deținătorul firmei "Maxim Paul S.R.L" organizează un eveniment cu ocazia
                    împlinirii a 2zile de când a deschis compania. Astfel evenimentul va avea ca scop strangerea de
                    fonduri pentru berea domnului Maximilian Paulo Arabu. Cine doreste sa contribuie...este asteptat
                    la Strada Suceveni, nr 4.
                </p>
                <h4 class="title">Locația</h4>
                <p>
                    Suceava, Fălticeni, Strada Suceveni, nr 4
                </p>
                <h4 class="title">Tag-uri</h4>
                <p>
                    c++, bere, mici, grătar
                </p>
            </div>
        </div>
        <div class="event-show">
            <div class="row-event">
                <div class="column-20">
                    <h4 class="title">Data de start</h4>
                    <p>23-06-2019</p>
                </div>
                <div class="column-60">
                    <h4 class="title">Titlul evenimentului</h4>
                    <p>CppCon</p>
                </div>
                <div class="column-20">
                    <button class="validate-button" type="button">Verifică valabilitatea</button>
                </div>
            </div>
            <div class="row-event">
                <div class="column-20">
                    <h4 class="title">Data de terminare</h4>
                    <p>30-06-2019</p>
                </div>
                <div class="column-20">
                    <h4 class="title">Tipul evenimentului</h4>
                    <p>Congress</p>
                </div>
                <div class="column-20">
                    <div class="row-event-intern">
                        <h4 class="title">Locația</h4>
                        <p>Gaylord Rockies</p>
                    </div>
                    <div class="row-event-intern">
                        <button class="button-more-details">▼Mai multe detalii▼</button>
                    </div>
                </div>
                <div class="column-20">
                    <h4 class="title">Preț</h4>
                    <p>Free</p>
                </div>
                <div class="column-20">
                    <h4 class="title">Eveniment organizat de</h4>
                    <p>CppCon</p>
                </div>
            </div>
            <div class="event-description">
                <h4 class="title">Descrierea evenimentului</h4>
                <p>
                    The grand opening of the Gaylord Rockies, CppCon’s new home as of this year, was held this past
                    weekend and they invited Gaylord Rockiesyour Conference Chair (that would be me) and the team
                    from our event management partners, Krueger Event Management (that would be Mike and Karen
                    Krueger), along with five hundred other event planners to spend the weekend. This gave the team
                    at the GR (yes, that’s what we call it) a chance to show off the brand new convention center and
                    what they can do with everything from food and beverage to decorating and AV.
                </p>
                <h4 class="title">Locația</h4>
                <p>
                    6700 North Gaylord Rockies Boulevard
                </p>
                <h4 class="title">Tag-uri</h4>
                <p>
                    c++
                </p>
            </div>
        </div>
        <div class="event-show">
            <div class="row-event">
                <div class="column-20">
                    <h4 class="title">Data de start</h4>
                    <p>25-06-2019</p>
                </div>
                <div class="column-60">
                    <h4 class="title">Titlul evenimentului</h4>
                    <p>Oameni importanți</p>
                </div>
                <div class="column-20">
                    <button class="validate-button" type="button">Verifică valabilitatea</button>
                </div>
            </div>
            <div class="row-event">
                <div class="column-20">
                    <h4 class="title"></h4>
                    <p></p>
                </div>
                <div class="column-20">
                    <h4 class="title">Tipul evenimentului</h4>
                    <p>Ceremonie</p>
                </div>
                <div class="column-20">
                    <div class="row-event-intern">
                        <h4 class="title">Locația</h4>
                        <p>Iași</p>
                    </div>
                    <div class="row-event-intern">
                        <button class="button-more-details">▼Mai multe detalii▼</button>
                    </div>
                </div>
                <div class="column-20">
                    <h4 class="title">Preț</h4>
                    <p>Gratuit</p>
                </div>
                <div class="column-20">
                    <h4 class="title">Eveniment organizat de</h4>
                    <p>Palas Mall</p>
                </div>
            </div>
            <div class="event-description">
                <h4 class="title">Descrierea evenimentului</h4>
                <p>
                    Palas Mall a ales să organizeze un eveniment în care vom prezenta oamenii cei mai importanți din
                    Județul Iași. Vor veni persoane precum Grigoraș Alexandru-Ionel, Filoș Gabriel, Maxim Paul
                </p>
                <h4 class="title">Locația</h4>
                <p>
                    Palas Mall Iași
                </p>
                <h4 class="title">Tag-uri</h4>
                <p>
                    best, important
                </p>
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

<script type="text/javascript" src="../webroot/scripts/events.js" async></script>

</html>
