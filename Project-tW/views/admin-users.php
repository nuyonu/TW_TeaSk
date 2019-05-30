<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Skill Enhancer | Admin Utilizatori</title>
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic|Patrick+Hand|Montserrat+Alternates|Annie+Use+Your+Telescope"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-common.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-common.css">
    <link type="text/css" rel="stylesheet" href="../webroot/styles/admin-events.css">
</head>
<body>
<?php
include '../webroot/templates/admin-common.php'; ?>
<div class="main-admin">
    <div class="page-title">
        <h1>Admin Utilizatori</h1>
    </div>
    <div class="body-admin">
        <div class="utils">
            <div class="search-event">
                <form action="adminUsers" method="post">
                    <input id="search-event-input" type="text" placeholder="Caută după numde de utilizator..."
                           name="search">
                </form>
            </div>

        </div>
        <div class="data">
            <form action="adminUsers/delete" id="delete-events">
                <table class="data-show">
                    <tr>
                        <th>Id.</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Nume</th>
                        <th>Prenume</th>
                        <th>Github</th>
                        <th>Linkedln</th>
                        <th>Șterge</th>
                    </tr>
                    <?php
                    $result = Parameters::getData("users");
                    foreach ($result as $user) {
                        ?>
                        <tr>
                            <td><?php echo $user->getId() ?></td>
                            <td><?php echo $user->getUsername() ?></td>
                            <td><?php echo $user->getEMail() ?></td>
                            <td><?php echo $user->getLastName() ?></td>
                            <td><?php echo $user->getFirstName() ?></td>
                            <td><?php echo $user->getGithubToken() ?></td>
                            <td><?php echo $user->getLinkedlnToken() ?></td>
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
</body>
</html>
