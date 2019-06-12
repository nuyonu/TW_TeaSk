<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skill Enhancer | Admin Suport</title>
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
        <h1>Admin Suport</h1>
    </div>
    <div class="body-admin">
        <div class="utils">
            <div class="search-event">
<!--                <form action="adminUsers" method="post">-->
<!--                    <input id="search-event-input" type="text" placeholder="Caută după numele de utilizator"-->
<!--                           name="search">-->
<!--                </form>-->
            </div>
            <div class="buttons">
                <button class="button-common remove-events" type="submit"
                        onclick="document.getElementById('delete-events').submit()">Elimină problemele
                </button>
<!--                <a href="/adminUsers">-->
<!--                    <button class="button-common remove-events" type="button">Resetează-->
<!--                    </button>-->
<!--                </a>-->
            </div>

        </div>
        <div class="data">
            <form action="adminsupport/delete" id="delete-events">
                <table class="data-show">
                    <tr>
                        <th>Nume.</th>
                        <th>Tip</th>
                        <th>Email</th>
                        <th>Problema</th>
                        <th>Șterge</th>
                    </tr>
                    <?php
                    $result = Parameters::getData("contact");
                    foreach ($result as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user->getName(); ?></td>
                            <td><?php echo $user->getType(); ?></td>
                            <td><?php echo $user->getEMail(); ?></td>
                            <td><?php echo $user->getProblem(); ?></td>
                            <td><input type="checkbox" name="check_list_for_delete[]"
                                       value="<?= $user->getId() ?>"></td>
                            <td></td>
                        </tr>
                        <?php
                    } ?>
                </table>
            </form>

        </div>

    </div>
</div>
</div>
<script type="text/javascript" src="../webroot/scripts/nav.js"></script>

</body>
</html>
