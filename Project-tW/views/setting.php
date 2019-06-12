<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Filos Gabriel">
    <meta charset="UTF-8">
    <title>Setari | Skill Enhancer</title>
    <link rel="stylesheet" type="text/css" href="../styles/navbar-new.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!--    <meta http-equiv="refresh" content="2">-->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/setting.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

</head>
<body>
<?php
include TEMPLATES . 'navbar_without_login.php';
?>
<div class="body" style="margin-top: 0;">

    <div class="menu" id="menu" style="font-family: Karla,sans-serif">
        <span class="buttoncontact">Setari Cont</span>
        <button class="buttonMenu" onclick="opentab(event, 'datepersonale')">Date personale</button>
        <button class="buttonMenu" onclick="opentab(event, 'datecontact')"> Conectare</button>
        <button class="buttonMenu" onclick="opentab(event, 'evolution')"> Evoluție</button>
    </div>
    <div class="page1" id="datepersonale">
        <div class="setting">
            <div class="ContulM">
                <h2>Date personale</h2>
            </div>
            <div class="container" id="page1">

                <form action="/settings/personal" method="post" id="personal">

                    <div class="line">
                        <div>
                            <span>
                                <label for="nameinput"><b>Nume</b></label>
                            <input type="text" name="personal[name]"
                                   value="<?php echo Parameters::getData("userData")->getLastName(); ?>" id="nameinput"
                                   class="inputcontainer containerinput"
                                   onkeyup="nameI()"
                                   required>
                            </span>
                            <div class="alert alert-error" id="error-alert4" style="color: red" hidden>
                                <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                                <strong>Eroare! </strong>
                                Numele trebuie sa contina cel putin o literă.
                            </div>
                        </div>
                        <div>
                                <span>
                                    <label for="lastnameinput"><b>Prenume</b></label>
                                    <input type="text" name="personal[first]" id="lastnameinput"
                                           value="<?php echo Parameters::getData("userData")->getFirstName(); ?>"
                                           class="inputcontainer containerinput"
                                           onkeyup="first()"
                                           required>
                                </span>
                            <div class="alert alert-error" id="error-alert5" style="color: red" hidden>
                                <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                                <strong>Eroare! </strong>
                                Prenumele trebuie sa contina cel putin o literă.
                            </div>
                        </div>
                    </div>
                    <div class="line">
                        <div>
                            <span>
                                <label for="email2"><b>Email</b></label>
                                    <input form="personal"
                                           type="email"
                                           name="personal[emailSetting]"
                                           value="<?php echo Parameters::getData("userData")->getEMail(); ?>"
                                           id="email2"
                                           class="inputcontainer containerinput"
                                           onkeyup="email()"
                                           required>

                            </span>
                            <div class="alert alert-error" id="error-alert3" style="color: red" hidden>
                                <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                                <strong>Eroare! </strong>
                                Email-ul nu e valid.
                            </div>
                        </div>
                        <span>
                            <label for="name2"><b>Nume utilizator</b></label>
                            <input type="text" id="name2"
                                   value="<?php echo Parameters::getData("userData")->getUsername(); ?>"
                                   class="inputcontainer containerinput" readonly required>
                        </span>

                    </div>
                    <div class="line">
                        <span>
                            <label for="name2"><b>Locatie actuala</b></label>
                            <input type="text" name="personal[place]" id="place"
                                   value="<?php echo Parameters::getData("location"); ?>"
                                   class="inputcontainer containerinput" readonly required>

                            <input name="personal[lat]" id="lat" readonly hidden>
                            <input name="personal[long]" id="long" readonly hidden>
                        </span>

                        <div>
                            <button type="submit" onsubmit="return notifyM();" class="savebutton">Salvează</button>
                            <button type="button" class="savebutton"
                                    onclick="getLocation()">Actualizeaza locatia
                            </button>

                        </div>
                        <div>
                            <h1 style="color: red">Pericol</h1>
                            <button type="button" class="savebutton" style="background: red; border-color: red;"
                                    onclick="sterge()">Sterge contul
                            </button>
                            <?php Render::moderator(); ?>

                        </div>

                    </div>


                </form>

                <div class="photoImage">
                    <span>
                        <div class="image">
                            <img src="../webroot/uploads/<?php echo Parameters::getData("image") ?>"
                                 class="imageaccount"
                                 alt="user">
                            <p>Nume de utilizator: <?php echo Parameters::getData("user") ?></p>
                         </div>
                         <form action="/settings/upload" method="post" enctype="multipart/form-data" class="photo">

                             <label class="labelFile ">Schimba imaginea de profil <input type="file" class="savebutton "
                                                                                         name="fileToUpload"
                                                                                         id="fileToUpload"
                                                                                         required></label>
                            <input type="submit" class="savebutton upload" value="Salvează imaginea" name="submit">
                         </form>
                    </span>
                </div>

            </div>
        </div>
    </div>
    <div class="page1" id="datecontact">
        <div class="setting">
            <div class="ContulM">
                <h2>Conectare</h2>
            </div>
            <div class="container">

                <form method="post" action="/settings/contact" class="contact" id="contact">

                    <div class="line">
                     <span>
                            <label for="newpassword"><b>Parola noua</b></label>
                            <input type="password" placeholder="**************" id="newpassword"
                                   class="inputcontainer containerinput" onkeyup="verifyPass()" required
                                   name="contact[new]">
                     </span>
                        <div class="alert alert-error" id="error-alertStr" style="color:red;display: none">
                            <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                            <strong>Eroare!Parola trebuie sa contina </strong>
                            <ul>
                                <li style="display: none" id="i1">sa aiba cel putin 8 caractere</li>
                                <li style="display: none" id="i2">cel putin o litera mica</li>
                                <li style="display: none" id="i3">cel putin una mare</li>
                                <li style="display: none" id="i4">cel putin o cifra</li>
                                <li style="display: none" id="i5">cel putin un simbol(!@#$%^&*)</li>
                            </ul>
                        </div>
                        <span>
                        <label for="confirmpasword"><b>Confirma parola</b></label>
                        <input type="password" placeholder="**************" onfocusout="pass_confirm()"
                               id="confirmpasword"
                               class="inputcontainer containerinput" name="contact[newC]" required>
                    </span>
                        <div class="alert alert-error" id="error-alert6" style="color: red" hidden>
                            <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                            <strong>Eroare! </strong>
                            Parolele nu corespund.
                        </div>


                    </div>
                    <div class="line">
                         <span>
                             <label><b>Parola veche</b></label>
                             <input name="contact[old]" type="password" placeholder="**************" id="oldpasword"
                                    class="inputcontainer containerinput" required>
                         </span>

                    </div>
                    <div class="line">
                        <div>
                            <?php RenderSettings::buttons(); ?>
                        </div>
                        <div>
                            <button type="submit" class="savebutton">Salveza</button>

                        </div>

                    </div>
                </form>

                <div class="photoImage">
                    <span>
                        <div class="image">
                            <img src="../webroot/uploads/<?php echo Parameters::getData("image") ?>"
                                 class="imageaccount"
                                 alt="user">
                            <p>Nume de utilizator: <?php echo Parameters::getData("user") ?></p>
                         </div>
                    </span>
                </div>

            </div>
        </div>
    </div>

    <div class="page1" id="evolution">
        <div class="body-evolution">
            <div class="body-body-evolution">
                <div class="insert-code" id="insert-code">
                    <div class="column-evolution">
                        <p id="info-code">În cazul în care ai primit un cod la evenimentul sau training-ul la care ai fost, te rog să-l
                            introduci jos pentru a ne ajuta să îți urmărim evoluția mai bine.</p>
                        <div class="row-evolution">
                            <input id="code" type="text" placeholder="Introdu codul...">
                            <button id="evolution-button" type="button" onclick="sendCode()">Trimite codul</button>
                        </div>
                    </div>
                </div>
                <div class="last-events-trainings">
                    <?php
                    if ($lastEventsTrainings != null) {
                        echo '<table class="table-show">
                        <tr>
                        <th>Tip</th>
                        <th>Titlu</th>
                        <th>Data</th>
                        <th>Organizator</th>
                        <th>Locatie</th>
                        <th>Pret</th>
                        </tr>';
                        foreach ($lastEventsTrainings as $eventsTraining) {
                            echo '<tr>';
                            echo '<td>' . ($eventsTraining->getType() == "1" ? "Training" : "Eveniment") . '</td>';
                            echo '<td>' . $eventsTraining->getTitle() . '</td>';
                            echo '<td>' . $eventsTraining->getDate() . '</td>';
                            echo '<td>' . $eventsTraining->getOrganizer() . '</td>';
                            echo '<td>' . $eventsTraining->getLocation() . '</td>';
                            echo '<td>' . ($eventsTraining->getPrice() == 0 ? "Gratis" : $eventsTraining->getPrice()) . '</td>';
                        }
                        echo '</table>';
                    } ?>

                </div>
                <div class="statistics">
                    <?php $this->getStatistics();
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php //require_once(TEMPLATES . 'footer.php'); ?>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
<script type="text/javascript" src="../webroot/scripts/settingp.js"></script>
<script type="text/javascript" src="../webroot/scripts/location.js"></script>
<script type="text/javascript" src="../webroot/scripts/newPass.js"></script>
<script type="text/javascript" src="../webroot/scripts/personal-data.js"></script>
<script type="text/javascript" src="../webroot/scripts/settingsEvolution.js"></script>
</body>
</html>