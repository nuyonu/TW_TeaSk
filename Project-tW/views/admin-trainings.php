<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skill Enhancer | Admin Training-uri</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-common.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-events.css">
</head>
<body>

<?php include '../webroot/templates/admin-common.php'; ?>

<div class="main-admin">
    <div class="page-title">
        <h1>Admin Training-uri</h1>
    </div>
    <div class="body-admin">
        <div class="utils">
            <div class="search-event">
                <form action="#">
                    <input id="search-event-input" type="text" placeholder="Caută după titlu..." name="title">
                </form>
            </div>
            <div class="buttons">
                <button class="button-common" type="button" onclick="location.href='adminTrainingsAdd'">Adaugă un
                    training
                </button>
                <?php if ($grade == 1)
                    echo '<button class="button-common" type = "submit" id = "delete-button"
                        onclick = "document.getElementById(\'delete-trainings\').submit()" > Elimină training-uri
                </button >'?>
            </div>
        </div>
        <div class="data">
            <form action="adminTrainings/deleteTrainings" id="delete-trainings">
                <table class="data-show">
                    <tr>
                        <th>Id.</th>
                        <th>Titlul training-ului</th>
                        <th>Organizator</th>
                        <th>Adăugat de</th>
                        <th>Mai multe</th>
                        <?php if ($grade == 1)
                            echo "<th>Șterge</th>" ?>
                    </tr>
                    <?php if ($trainings != null && strcmp(array_values($trainings)[0]->getId(), '')) {
                        foreach ($trainings as $training) { ?>
                            <tr>
                                <td><?php echo $training->getId() ?></td>
                                <td><?php echo $training->getTitle() ?></td>
                                <td><?php echo $training->getOrganizer() ?></td>
                                <td><?php echo $training->getUsername() ?></td>
                                <td><a href="<?= '/adminTrainingsView?trainingId=' . $training->getId() ?>">
                                        <i class="fa fa-list"></i></a></td>
                                <?php if ($grade == 1)
                                    echo '<td><input type="checkbox" class="check-for-delete" name="check_list_for_delete[]"
                                           value="'. $training->getId() .'" onclick="renameButton()"></td>' ?>
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
            if (!($number_of_pages <= 1)) {
                echo '<a href="adminTrainings?page=' . 1 . '">' . '&laquo;' . '</a> ';
                if ($current_page - 2 > 0)
                    echo '<a href="adminTrainings?page=' . ($current_page - 2) . '">' . ($current_page - 2) . '</a> ';
                if ($current_page - 1 > 0)
                    echo '<a href="adminTrainings?page=' . ($current_page - 1) . '">' . ($current_page - 1) . '</a> ';
                echo '<a class="active" href="adminTrainings?page=' . $current_page . '">' . $current_page . '</a> ';
                if ($current_page + 1 <= $number_of_pages)
                    echo '<a href="adminTrainings?page=' . ($current_page + 1) . '">' . ($current_page + 1) . '</a> ';
                if ($current_page + 2 <= $number_of_pages)
                    echo '<a href="adminTrainings?page=' . ($current_page + 2) . '">' . ($current_page + 2) . '</a> ';
                echo '<a href="adminTrainings?page=' . $number_of_pages . '">' . '&raquo;' . '</a> ';
            }
            ?>
        </div>
    </div>
</div>

</body>
<script src="../webroot/scripts/admin-trainings.js"></script>
</html>
