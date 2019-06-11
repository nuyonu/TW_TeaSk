<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skill Enhancer | Admin Add Event</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-common.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-events-add.css">
</head>
<body>
<?php
include '../webroot/templates/admin-common.php'; ?>
<div class="main-admin">
    <div class="page-title">
        <h1>Admin Adaugă Eveniment</h1>
    </div>
    <div class="body-admin">
        <div class="inputs" id="inputs">
            <?php
            if(isset($_GET['error'])) {
                if($_GET["error"] == true)
                echo '<div class="alert alert-danger">Datele introduse nu sunt corecte. Poti merge la suport pentru a lua legatura cu noi.</div>';
            }
            ?>
            <form action="adminEventsAdd/addEvent" id="add-form" method="post" autocomplete="on" name="eventsParams">
                <div class="left">
                    <label>Titlul evenimentului</label>
                    <input id="title" name="eventParams[title]" type="text" onfocusout="titleCheck(this)">
                    <label>Organizator</label>
                    <input id="organizer" name="eventParams[organizer]" type="text" onfocusout="organizerCheck(this)">
                    <label>Tipul evenimentului</label>
                    <input id="type" name="eventParams[type]" type="text" onfocusout="typeCheck(this)">
                    <label>Locația</label>
                    <input id="location" name="eventParams[location]" type="text" onfocusout="locationCheck(this)">
                    <div class="row">
                        <label>Preț</label>
                        <input name="eventParams[price]" id="price" type="number"
                               onchange="checkNotNull(this)">
                        <label>Locuri</label>
                        <input name="eventParams[seats]" id="seats" type="number"
                               onchange="checkNotNull(this)">
                        <label>Dificultate</label>
                        <select id="difficulty" name="eventParams[difficulty]">
                            <option value="1">Ușor</option>
                            <option value="2">Mediu</option>
                            <option value="3">Greu</option>
                        </select>
                    </div>
                    <label>Tag-uri</label>
                    <input id="tags" type="text" name="eventParams[tags]" onfocusout="tagsCheck(this)">
                </div>
                <div class="right">
                    <div class="row">
                        <label>Data de inceput</label>
                        <input name="eventParams[begin-date]" id="start-date" type="date"
                               onchange="checkDate(this)">
                        <label>Ora de inceput</label>
                        <input name="eventParams[begin-time]" id="start-time" type="time">
                    </div>
                    <div class="row">
                        <!--&nbsp; pentru a fi aranjate exact la acelasi nivel cu cele de sus-->
                        <label>Data de sfarsit&nbsp;&nbsp;&nbsp;</label>
                        <input name="eventParams[end-date]" id="end-date" type="date"
                               onchange="checkDate(this)">
                        <label>Ora de sfarsit&nbsp;&nbsp;&nbsp;</label>
                        <input name="eventParams[end-time]" id="end-time" type="time">
                    </div>
                    <label>Descriere</label>
                    <textarea id="description" name="eventParams[description]" rows="11" form="add-form" onfocusout="descriptionCheck(this)"></textarea>
                </div>
            </form>
            <div class="information">
                <p>ATENȚE! Nu poți schimba tag-urile odată ce au fost setate.</p>
                <p>Tag-urile sunt foarte importante deoarece ne ajută pe noi să găsim publicul țintă.</p>
            </div>
            <div class="button-add-event-submit">
                <button type="submit" onclick="checkAllFields()" id="add-event-button">Adaugă evenimentul</button>
            </div>
            <div class="back-button">
                <button type="button" onclick="location.href='/adminEvents'">Înapoi</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../webroot/scripts/alert.js"></script>
<script src="../webroot/scripts/admin-events-add.js"></script>
</html>
