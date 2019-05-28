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
                       value="<?php echo Parameters::getData("userData")->getLastName(); ?>" id="nameinput"
                       class="inputcontainer containerinput" required>
                </span>
                    <span>
                    <label for="lastnameinput"><b>Prenume</b></label>
                    <input type="text" name="personal[first]" placeholder="Gabriel" id="lastnameinput"
                           value="<?php echo Parameters::getData("userData")->getFirstName(); ?>"
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

                    </span>
                    <span>
                        <label for="name2"><b>Nume utilizator</b></label>
                        <input type="text" placeholder="Gabriel" name="personal[username]" id="name2"
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
                        <button type="submit" class="savebutton">Salvează</button>
                        <button type="button" class="savebutton" onclick="getLocation()">Actualizeaza locatia</button>
                        <input name="personal[lat]" id="lat" readonly hidden>
                        <input name="personal[long]" id="long" readonly hidden>
                    </span>


                </div>
            </form>
            <div class="line">
                <span>
                     <form action="/settings/upload" method="post" enctype="multipart/form-data">
                        Select image to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                     </form>
                </span>
            </div>


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
                             <label><b>Parola veche</b></label>
                             <input name="contact[old]" type="password" placeholder="**************" id="oldpasword"
                                    class="inputcontainer containerinput" required>
                         </span>

                </div>
                <div class="line">
                    <span>
                        <?php
                        //                        if (Parameters::getData('github')) {
                        //                            echo  '<a href="/settings/dissconect1"> <button type="button" class="logare" id="logare1">Disconnect Github</button></a>';
                        //                        } else {
                        echo '<a href="/settings/github"> <button type="button" class="logare" id="logare1">Gitbub</button></a>';
                        //                        }
                        //                        if (Parameters::getData('linkedln')) {
                        //                            echo '<a href="/settings/dissconect2"> <button type="button" class="logare" id="logare2">Disconnect Linkedin</button></a>';
                        //                        } else {
                        echo '<a href="/settings/linkedln"> <button type="button" class="logare" id="logare2">Linkedin</button></a>';
                        //                        }
                        ?>
<!---->
                        <!--                       <a href="/settings/github"> <button type="button" class="logare" id="logare1">Gitbub</button></a>-->
                        <!--                       <a href="/settings/linkedln"> <button type="button" class="logare" id="logare2">Linkedin</button></a>-->
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
<script>
    function getLocation() {

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            window.alert('Browser-ul nu suporta geolocatia');
        }
    }

    function showPosition(position) {
        document.getElementById("lat").value = position.coords.latitude;
        document.getElementById("long").value = position.coords.longitude;

        console.log("ok");
        fetch('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + position.coords.latitude + '&lon=' + position.coords.longitude)
            .then(function (response) {
                return response.json();
            })
            .then(function (myJson) {
                answer = JSON.stringify(myJson);
                obj = JSON.parse(answer);
                document.getElementById("place").value = obj.display_name;
                document.getElementById("lat").value = position.coords.latitude;
                document.getElementById("long").value = position.coords.longitude;
            });
    }
</script>
</body>
</html>