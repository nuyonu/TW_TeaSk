<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Filos Gabriel">
    <meta charset="UTF-8">
    <title>Skill Enhancer</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../webroot/styles/setting.css">

</head>
<body>
<?php
include TEMPLATES . 'navbar_without_login.php';
?>
<div class="body" style="margin-top: 0;">

    <div class="menu" style="font-family: Karla,sans-serif">
        <span class="buttoncontact">Setari Cont</span>
        <button class="buttonMenu" onclick="opentab(event, 'datepersonale')"> Date
            personale
        </button>
        <button class="buttonMenu" onclick="opentab(event, 'datecontact')"> Conectare</button>
        <button class="buttonMenu" onclick="opentab(event, 'preferinte')"> Preferinte</button>
        <!--<button class="buttonMenu" onclick="opentab(event, 'istoric')"> Istoric</button>-->
        <button class="buttonMenu" onclick="opentab(event, 'teste')"> Teste</button>
        <!--<button class="buttonMenu" onclick="opentab(event, 'statistici')"> Statistici</button>-->
    </div>
    <div class="page1" id="datepersonale">
        <div class="setting">
            <div class="ContulM">
                <h2>Date personale</h2>
            </div>
            <form action="/settings/personal" method="post" id="personal">
                <div class="line">
                <span>
                    <label for="nameinput"><b>Nume</b></label>
                <input type="text" name="personal[name]" placeholder="Filos"
                       value="<?php echo Parameters::getData("userData")->getFirstName(); ?>" id="nameinput"
                       class="inputcontainer containerinput" required>
                </span>
                    <span>
                    <label for="lastnameinput"><b>Prenume</b></label>
                    <input type="text" name="personal[first]" placeholder="Gabriel" id="lastnameinput"
                           value="<?php echo Parameters::getData("userData")->getLastName(); ?>"
                           class="inputcontainer containerinput"
                           required>
                </span>

                </div>
                <div class="line">
                <span>
                    <label for="email2"><b>Email</b></label>
                <input form="personal" type="email" name="personal[emailSetting]"
                       value="<?php echo Parameters::getData("userData")->getEMail(); ?>"
                       placeholder="filos@gmmmmmm.com" id="email2"
                       class="inputcontainer containerinput"
                       required>
                    <button type="submit" class="savebutton">Salvează</button>
                </span>
                    <span>
                    <label for="name2"><b>Numa utilizator</b></label>
                    <input type="text" placeholder="Gabriel" name="personal[username]" id="name2"
                           value="<?php echo Parameters::getData("userData")->getUsername(); ?>"
                           class="inputcontainer containerinput" readonly required>

                    </span>

                </div>
            </form>


        </div>
        <div class="image">
            <img src="../webroot/images/user.png" class="imageaccount" alt="user">
            <p> Filos Gabriel</p>
        </div>
    </div>
    <div class="page1" id="datecontact">
        <div class="setting">
            <div class="ContulM">
                <h2>Conectare</h2>
            </div>
            <form method="post" action="/settings/contact">
                <div class="line">
                <span>
                    <label for="newpassword"><b>Parola noua</b></label>
                <input type="password" placeholder="**************" id="newpassword"
                       class="inputcontainer containerinput" required name="contact[new]">
                </span>
                    <span>
                    <label for="confirmpasword"><b>Confirma parola</b></label>
                    <input type="password" placeholder="**************" id="confirmpasword"
                           class="inputcontainer containerinput" name="contact[newC]" required>
                </span>


                </div>
                <div class="line">
                         <span>
                             <label for="confirmpasword"><b>Parola veche</b></label>
                             <input name="contact[old]" type="password" placeholder="**************" id="confirmpasword"
                                    class="inputcontainer containerinput" required>
                         </span>

                </div>
                <div class="line">

                    </span>
                    <span class="butoaneflex">
                <button type="button" class="logare" id="logare1">Gitbub</button>
                <button type="button" class="logare" id="logare2">Linkedin</button>
                <button type="submit" class="savebutton">Salveza</button>
            </span>

                </div>
            </form>

        </div>
        <div class="image">
            <img src="../webroot/images/user.png" class="imageaccount" alt="user">
            <p> Filos Gabriel</p>
        </div>
    </div>

    <div class="page1" id="preferinte">
        <div class="setting">
            <div class="ContulM">
                <h2>Preferinte</h2>
            </div>
            <div class="line">
                <label for="newemail" class="labels"><b>Tipuri de evenimente</b></label>
            </div>
            <div class="line line2">
                <span>
                    <label class="containercheck">Conferinte
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                </span>
                <span>
                    <label class="containercheck">Seminare
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
            </span>
                <span>
                    <label class="containercheck">Intalniri
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
            </span>

            </div>
            <div class="line">
                <label for="newemail" class="labels"><b>Tipuri de tarining-uri</b></label>
            </div>

            <div class="line line2">

            <span>
                    <label class="containercheck">Technical Skills Development Training
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
            </span>
                <span>
                    <label class="containercheck">Onboarding Training
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
            </span>
                <span>
                    <label class="containercheck">Orientation
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
            </span>
                <span>
                    <label class="containercheck">Soft skills development training
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
            </span>

            </div>
        </div>

    </div>

    <div class="page1" id="teste" style="margin-top: 0;">
        <div class="setting">
            <div class="ContulM">
                <h2>Teste</h2>
            </div>
            <div class="line">
                <label for="newemail" class="labels"><b>Preferite teste</b></label>
            </div>
            <div class="line">
                <span>
                    <label class="containercheck">Doriti teste
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
                </span>
                <span>
                    <label class="containercheck">Aleatoare
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
            </span>
                <span>
                    <label class="containercheck">Pauza 7 zile
                        <input type="checkbox" checked="checked">
                        <span class="checkmark"></span>
                    </label>
            </span>

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
<script>
    function opentab(evt, idtab) {
        // Declare all variables
        let i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("page1");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("buttonMenu");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(idtab).style.display = "flex";
        evt.currentTarget.className += " active";
    }
</script>
</body>
</html>