<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skill Enhancer | Admin Evenimente</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-common.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-events.css">
</head>
<body>
<?php
include '../webroot/templates/admin-common.php'; ?>
<div class="main-admin">
    <div class="page-title">
        <h1>Admin Evenimente</h1>
    </div>
    <div class="body-admin">
        <div class="utils">
            <div class="search-event">
                <form action="#">
                    <input id="search-event-input" type="text" placeholder="Caută după titlu..." name="title">
                </form>
            </div>
            <div class="buttons">
                <button class="button-common" id="add-button" type="button">Adaugă un eveniment</button>
                <button class="button-common show-older-events" type="submit">Evenimente vechi</button>
                <button class="button-common remove-events" type="submit"
                        onclick="document.getElementById('delete-events').submit()">Elimină evenimentele
                </button>
            </div>
        </div>
        <div class="data">
            <form action="adminEvents/deleteEvents" id="delete-events">
                <table class="data-show">
                    <tr>
                        <th>Id.</th>
                        <th>Titlul evenimentului</th>
                        <th>Organizator</th>
                        <th>Adaugat de</th>
                        <th>Mai multe</th>
                        <th>Șterge</th>
                        <th>Modifică</th>
                    </tr>
                    <?php if ($events != null && strcmp(array_values($events)[0]->getId(), '')) {
                        foreach ($events as $event) {
                            ?>
                            <tr>
                                <td><?php echo $event->getId() ?></td>
                                <td><?php echo $event->getTitle() ?></td>
                                <td><?php echo $event->getOrganizer() ?></td>
                                <td><?php echo $event->getTitle() ?></td>
                                <td><a href="<?= '/adminEventsView?eventId=' . $event->getId() ?>"><i
                                                class="fa fa-list"></i></a></td>
                                <td><input type="checkbox" name="check_list_for_delete[]"
                                           value="<?= $event->getId() ?>"></td>
                                <td><a href="<?= 'adminEventsModify?eventId=' . $event->getId() ?>"><i
                                                class='fa fa-edit'></i></a></td>
                            </tr>
                        <?php }
                    } ?>
                </table>
            </form>
            <div id="Add-Modal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class="close-modal-div">
                        <span class="close">&times;</span>
                    </div>
                    <div class="modal-inside-content">
                        <h2>Adaugă un eveniment</h2>
                        <form action="adminEvents/addEvent" id="add-form" method="post" name="eventsParams">
                            <div class="left">
                                <label>Titlul evenimentului</label>
                                <input name="eventParams[title]" type="text">
                                <label>Organizator</label>
                                <input name="eventParams[organizer]" type="text">
                                <label>Tipul evenimentului</label>
                                <input name="eventParams[type]" type="text">
                                <label>Locația</label>
                                <input name="eventParams[location]" type="text">
                                <div class="row">
                                    <label>Preț</label>
                                    <input name="eventParams[price]" id="price" type="number"
                                           onchange="checkNotNull(this)">
                                    <label>Locuri</label>
                                    <input name="eventParams[seats]" id="seats" type="number"
                                           onchange="checkNotNull(this)">
                                    <label>Dificultate</label>
                                    <select name="eventParams[difficulty]">
                                        <option value="1">Ușor</option>
                                        <option value="2">Mediu</option>
                                        <option value="3">Greu</option>
                                    </select>
                                </div>
                                <label>Tag-uri</label>
                                <input type="text" name="eventParams[tags]">
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
                                <textarea name="eventParams[description]" rows="11" form="add-form"></textarea>
                            </div>
                        </form>
                        <div class="informations">
                            <p>ATENȚE! Nu poți schimba tag-urile odată ce au fost setate.</p>
                            <p>Tag-urile sunt foarte importante deoarece ne ajută pe noi să găsim publicul țintă.</p>
                        </div>
                        <div class="button-add-event-submit">
                            <button type="submit" onclick="addFormSubmit()">Adaugă evenimentul</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
<script src="../webroot/scripts/admin-events.js"></script>
</html>
