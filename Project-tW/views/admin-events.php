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
                <form action="/adminEvents">
                    <input id="search-event-input" type="text" placeholder="Caută după titlu..." name="title">
                </form>
            </div>
            <div class="buttons">
                <button class="button-common" type="button" onclick="location.href='adminEventsAdd'">Adaugă un
                    eveniment
                </button>
                <?php if ($grade == 1)
                    echo '<button class="button-common" type = "submit" id = "delete-button"
                        onclick = "document.getElementById(\'delete-events\').submit()" > Elimină evenimente
                </button >'?>
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
                        <?php if ($grade == 1)
                            echo "<th>Șterge</th>" ?>
                    </tr>
                    <?php if ($events != null && strcmp(array_values($events)[0]->getId(), '')) {
                        foreach ($events as $event) {
                            ?>
                            <tr>
                                <td><?php echo $event->getId() ?></td>
                                <td><?php echo $event->getTitle() ?></td>
                                <td><?php echo $event->getOrganizer() ?></td>
                                <td><?php echo $event->getUsername() ?></td>
                                <td><a href="<?= '/adminEventsView?eventId=' . $event->getId() ?>"><i
                                                class="fa fa-list"></i></a></td>
                                <?php if ($grade == 1)
                                    echo '<td><input type="checkbox" class="check-for-delete" name="check_list_for_delete[]"
                                           value="'. $event->getId() .'" onclick="renameButton()"></td>' ?>
                            </tr>
                        <?php }
                    } ?>
                </table>
            </form>
        </div>
        <div class="pagination">
            <?php
            if (isset($_GET['page'])) {
                $current_page = $_GET['page'];
                if (!is_numeric($current_page))
                    $current_page = 1;
                if ($current_page < 1 || $current_page > $number_of_pages)
                    $current_page = 1;
            } else
                $current_page = 1;
            if (isset($_GET['title']))
                $title = $_GET['title'];
            else
                $title = "";
            if (!($number_of_pages <= 1)) {
                echo '<a href="adminEvents?page=' . 1 . '&title=' . $title . '">' . '&laquo;' . '</a> ';
                if ($current_page - 2 > 0)
                    echo '<a href="adminEvents?page=' . ($current_page - 2) . '&title=' . $title . '">' . ($current_page - 2) . '</a> ';
                if ($current_page - 1 > 0)
                    echo '<a href="adminEvents?page=' . ($current_page - 1) . '&title=' . $title . '">' . ($current_page - 1) . '</a> ';
                echo '<a class="active" href="adminEvents?page=' . $current_page . '">' . $current_page . '</a> ';
                if ($current_page + 1 <= $number_of_pages)
                    echo '<a href="adminEvents?page=' . ($current_page + 1) . '&title=' . $title . '">' . ($current_page + 1) . '</a> ';
                if ($current_page + 2 <= $number_of_pages)
                    echo '<a href="adminEvents?page=' . ($current_page + 2) . '&title=' . $title . '">' . ($current_page + 2) . '</a> ';
                echo '<a href="adminEvents?page=' . $number_of_pages . '&title=' . $title . '">' . '&raquo;' . '</a> ';
            }
            ?>
        </div>
    </div>
</div>
</body>
<script src="../webroot/scripts/admin-events.js"></script>
</html>
