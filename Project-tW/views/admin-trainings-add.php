<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skill Enhancer | Admin Add Training</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-common.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-events-add.css">
</head>
<body>

<?php include '../webroot/templates/admin-common.php'; ?>

<div class="main-admin">
    <div class="page-title">
        <h1>Admin Adaugă Training</h1>
    </div>
    <div class="body-admin">
        <div class="inputs" id="inputs">
            <?php
            if(isset($_GET['error'])) {
                if($_GET["error"] == true)
                    echo '<div class="alert alert-danger">Datele introduse nu sunt corecte. Poti merge la suport pentru a lua legatura cu noi.</div>';
            }
            ?>
            <form action="adminTrainingsAdd/addTraining" id="add-form" method="post" autocomplete="on" name="trainingParams">
                <div class="left">
                    <label>Titlul</label>
                    <input id="title" name="trainingParams[title]" type="text" onfocusout="titleCheck(this)">
                    <label>Organizator</label>
                    <input id="organizer" name="trainingParams[organizer]" type="text" onfocusout="organizerCheck(this)">
                    <label>Domeniu</label>
                    <input id="domain" name="trainingParams[domain]" type="text" onfocusout="locationCheck(this)">
                    <label>Specificații</label>
                    <input id="specifications" name="trainingParams[specifications]" type="text" onfocusout="locationCheck(this)">
                    <label>Locația</label>
                    <input id="location" name="trainingParams[location]" type="text" onfocusout="locationCheck(this)">
                    <div class="row">
                        <label>Preț</label>
                        <input name="trainingParams[price]" id="price" type="number"
                               onchange="checkNotNull(this)">
                        <label>Dificultate</label>
                        <select id="difficulty" name="trainingParams[difficulty]">
                            <option value="0">Ușor</option>
                            <option value="1">Mediu</option>
                            <option value="2">Greu</option>
                        </select>
                    </div>
                </div>
                <div class="right">
                    <div class="row">
                        <label>Înscrierile pot începe după: </label>
                        <input name="trainingParams[begin-date]" id="start-date" type="date"
                               onchange="checkDate(this)">
                        <label>Ora de inceput</label>
                        <input name="trainingParams[begin-time]" id="start-time" type="time">
                    </div>
                    <label>Descriere</label>
                    <textarea id="description" name="trainingParams[description]" rows="11" form="add-form" onfocusout="descriptionCheck(this)"></textarea>
                </div>
            </form>
            <div class="button-add-event-submit">
                <button type="submit" onclick="checkAllFields()" id="add-event-button">Adaugă training-ul</button>
            </div>
            <div class="back-button">
                <button type="button" onclick="location.href='/adminTrainings'">Înapoi</button>
            </div>
        </div>
    </div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="../webroot/scripts/alert.js"></script>
<script src="../webroot/scripts/admin-trainings-add.js"></script>
</html>
