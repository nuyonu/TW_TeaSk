<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skill Enhancer | Admin Evenimente Informatii</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-common.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-event-modify.css">
</head>
<body>
<?php
include '../webroot/templates/admin-common.php'; ?>
<div class="main-admin">
    <div class="page-title">
        <h1>Mai multe informații</h1>
    </div>
    <div class="body-admin">
        <div class="modify-event-body">
            <div class="buttons-modify-event">
                <button class="button-common" type="submit" onclick="document.getElementById('modify-event').submit()">
                    Salvează modificările
                </button>
                <button class="button-common" type="button" onclick="location.href='/adminEvents'">Înapoi</button>
            </div>
            <?php if ($event != null) ?>
            <div class="row-event-modify">
                <div class="old">
                    <label>Titlu</label>
                    <p><?php echo $event->getTitle() ?></p>
                    <label>Tipul evenimentului</label>
                    <p><?php echo $event->getType() ?></p>
                    <label>Locatia</label>
                    <p><?php echo $event->getLocation() ?></p>
                    <label>Organizator</label>
                    <p><?php echo $event->getOrganizer() ?></p>
                    <label>Data de inceput</label>
                    <p><?php echo $event->getBeginDate() . " " . $event->getBeginTime() ?></p>
                    <label>Data de sfarsit</label>
                    <p><?php echo $event->getEndDate() . " " . $event->getEndTime() ?></p>
                    <label>Dificultate</label>
                    <p><?php echo $event->getDifficulty() ?></p>
                    <label>Descriere</label>
                    <p><?php echo $event->getDescription() ?></p>
                </div>
                <form class="new" id="modify-event" action="/adminEvents/modifyEvent">
                    <label>Titlu</label>
                    <input name="params[title]" type="text">
                    <label>Tipul evenimentului</label>
                    <input name="params[type]" type="text">
                    <label>Locatia</label>
                    <input name="params[location]" type="text">
                    <label>Organizator</label>
                    <input name="params[organizer]" type="text">
                    <label>Data de inceput</label>
                    <div class="row-event-modify">
                        <input name="params[begin-date]" id="start-date" type="date" onchange="checkDate(this)">
                        <input name="params[begin-time]" id="start-time" type="time">
                    </div>
                    <label>Data de sfarsit</label>
                    <div class="row-event-modify">
                        <input name="params[end-date]" id="end-date" type="date" onchange="checkDate(this)">
                        <input name="params[end-time]" id="end-time" type="time">
                    </div>
                    <label>Dificultate</label>
                    <select name="params[difficulty]">
                        <option value="1">Ușor</option>
                        <option value="2">Mediu</option>
                        <option value="3">Greu</option>
                    </select>
                    <label>Descriere</label>
                    <textarea name="params[description]" rows="10" form="modify-event"></textarea>
                </form>
                <?php ?>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../webroot/scripts/admin-event-modify.js"></script>
</html>