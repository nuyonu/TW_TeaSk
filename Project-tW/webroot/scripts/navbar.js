document.write(
    '<link rel="stylesheet" type="text/css" href="../styles/navbar-new.css"/>\
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"\
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">\
    <nav class="navbar">\
        <img  src="../images/logo.png" alt="Skill Enhancer"/>\
        <ul>\
            <li><a href="/home"><i class="fas fa-home"></i>Acasă</a></li>\
            <li><a href="/events"><i class="fas fa-calendar-week"></i>Evenimente</a></li>\
            <li><a href="/trainings"><i class="fas fa-user-graduate"></i>Training-uri</a></li>\
            <li><a href="/contact"> <i class="fas fa-mobile-alt"></i>Contact</a></li>\
            <li><a href="/suport"><i class="fas fa-question-circle"></i>Suport</a></li>\
            <li><a href="/about"><i class="fas fa-info-circle"></i>Despre</a></li>\
            <button class="btn" id="signin" onclick="document.getElementById(\'id1\').style.display=\'block\'" <?php echo  $navbar; >\
                Autentificare\
            </button>\
            <button class="btn" id="signup" onclick="document.getElementById(\'id2\').style.display=\'block\'" <?php echo  $navbar; >>\
                Înregistrare\
            </button>\
        </ul>\
    </nav>\
    <div id="id1" class="modal">\
        <form class="modal-content animate" action="home/login" method="post" id="login">\
            <div class="imgcontainer">\
                <span onclick="document.getElementById(\'id1\').style.display=\'none\'" class="close"\
                      title="Close modal">&times;</span>\
                <!--<img src="./images/user.png" alt="Avatar user" class="avatar">-->\
            </div>\
            <div class="container">\
                <label for="name"><b>Username</b></label>\
                <input type="text"  name="data[user]" placeholder="Username" id="name" class="inputcontainer" required>\
                <label for="pws"><b>Parola</b></label>\
                <input type="password"  name="data[password]" placeholder="Introduceti parola" id="pws" class="inputcontainer" required>\
                <button type="submit" id="logare" class="buttonmodal">Logare</button>\
                <div class="logincustom">\
                    <button type="submit" id="github" class="buttonmodal">GitHub</button>\
                    <button type="submit" id="linkedln" class="buttonmodal">Linkedln</button>\
                </div>\
                <label class="conectat">\
                    <input name="data[conn]"  type="checkbox" checked="checked" form="login">Mentine-ma conectat.\
                </label>\
            </div>\
            <div class="container">\
                <button type="button" onclick="document.getElementById(\'id1\').style.display=\'none\'"\
                        class="buttonmodal">\
                    Anuleaza\
                </button>\
                <span class="psw"></span>\
            </div>\
        </form>\
    </div>\
    <div id="id2" class="modal">\
        <form class="modal-content animate" action="home/register" method="post" id="register">\
            <div class="imgcontainer">\
                <span onclick="document.getElementById(\'id2\').style.display=\'none\'" class="close"\
                      title="Close modal">&times;&#215;</span>\
            </div>\
            <div class="container">\
                <label for="namec"><b>Alegeti un nume de utilizator</b></label>\
                <input type="text" placeholder="Introduceti  numele de utilizator " id="namec"\
                       class="inputcontainer" name="reg[username]"   form="register"  required>\
                <label for="email"><b>Email</b></label>\
                <input type="email" placeholder="username@domain.com" id="email" name="reg[email]"  class="inputcontainer" required>\
                <label for="pwsc"><b>Parola</b></label>\
                <input type="password" placeholder="Introduceti o parola" id="pwsc" name="reg[password]" class="inputcontainer" required>\
                <label for="pwscr"><b>Confirma parola</b></label>\
                <input type="password" placeholder="Introduceti parola din nou" name="reg[confirm]" id="pwscr" class="inputcontainer"\
                       required>\
                <label for="nameuser"><b>Nume</b></label>\
                <label>\
                    <input type="text" id="nameuser" class="inputcontainer" name="reg[name]" placeholder="Introduceti numele"\
                           required>\
                </label>\
                <label for="prenumeuser"><b>Prenume</b></label>\
                <label>\
                    <input type="text" id="prenumeuser" class="inputcontainer" name="reg[lastname]" placeholder="Introduceti prenumele"\
                           required>\
                </label>\
                <div class="butoanean">\
                    <button type="submit" class="buttonmodal">Creaza cont</button>\
                </div>\
            </div>\
        </form>\
    </div>'
);
