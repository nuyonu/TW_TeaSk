<link rel="stylesheet" href="../webroot/styles/mod.css" type="text/css  ">
<link rel="stylesheet" type="text/css" href="../styles/navbar-new.css"/>
<nav class="navbar">
    <img src="../images/logo.png" alt="Skill Enhancer"/>
    <ul>
        <li><a href="/home"><i class="fas fa-home"></i>Acasă</a></li>
        <li><a href="/contact"> <i class="fas fa-mobile-alt"></i>Contact</a></li>
        <li><a href="/support"><i class="fas fa-question-circle"></i>Suport</a></li>
        <li><a href="/about"><i class="fas fa-info-circle"></i>Despre</a></li>
        <button class="btn" id="signin" onclick="document.getElementById('id1').style.display='block'">
            Autentificare
        </button>
        <button class="btn" id="signup" onclick="document.getElementById('id2').style.display='block'">
            Înregistrare
        </button>
    </ul>
</nav>
<div id="id1" class="modal">
    <form class="modal-content animate" action="/home/login" method="post" id="login">
        <div class="imgcontainer">
                <span onclick="document.getElementById('id1').style.display='none'" class="close"
                      title="Close modal">&times;</span>
            <!--<img src="./images/user.png" alt="Avatar user" class="avatar">-->
        </div>
        <div class="container">
            <div class="alert alert-error" id="cred" style="color: red" hidden>
                <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                <strong>Eroare! </strong>
                Credentialele sunt greșite.Va rugăm incercați din nou.
            </div>
            <input style="display:none" type="text" name="usernameremembered"/>
            <input style="display:none" type="password" name="fakepasswordremembered"/>
            <label for="name"><b>Nume de utilizator</b></label>
            <input type="text" name="data[user]" placeholder="Username" id="name" class="inputcontainer" required>
            <label for="pws"><b>Parola</b></label>
            <input type="password" name="data[password]" placeholder="Introduceti parola" id="pws"
                   class="inputcontainer" required>

        </div>
        <div class="container">
            <button type="submit" id="logare" class="buttonmodal">Logare</button>
            <button type="button" onclick="document.getElementById('id1').style.display='none'"
                    class="buttonmodal">
                Anuleaza
            </button>
            <span class="psw"></span>
        </div>
    </form>
</div>
<div id="id2" class="modal">
    <form class="modal-content animate" name="myform" action="home/register" autocomplete="off" method="post"
          id="register" autocomplete="off">
        <div class="imgcontainer">
                <span onclick="document.getElementById('id2').style.display='none'" class="close"
                      title="Close modal" style="color: red">&times;</span>
        </div>
        <div class="container">
            <input style="display:none" type="text" name="username"/>
            <input style="display:none" type="password" name="fakepasswordremembered"/>

            <label for="namec"><b>Alegeti un nume de utilizator</b></label>
            <input type="text" onfocusout="usernameExist()" onkeyup="val()" placeholder="Introduceti  numele de utilizator " id="namec"
                   class="inputcontainer" name="reg[username]" autocomplete="new-password" form="register" required>
            <div class="alert alert-error" id="error_username" style="color: red" hidden>
                <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                <strong>Eroare! </strong>
                Numele de utilizator exista deja.Incercati altul.
            </div>
            <div class="alert alert-error" id="error-alert2" style="color: red" hidden>
                <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                <strong>Eroare! </strong>
                Numele de utilizator trebuie sa aiba cel putin 6 caractere .
            </div>
            <label for="email"><b>Email</b></label>
            <input type="email" onkeyup="valided()" placeholder="username@domain.com" id="email" name="reg[email]"
                   class="inputcontainer" required>
            <div class="alert alert-error" id="error-alert3" style="color: red" hidden>
                <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                <strong>Eroare! </strong>
                Email-ul nu e valid.
            </div>
            <label for="pwsc"><b>Parola</b></label>
            <input type="password" onkeyup="verifyPass()" placeholder="Introduceti o parola" id="pwsc"
                   name="reg[password]" class="inputcontainer" required>
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
            <label for="pwscr"><b>Confirma parola</b></label>
            <input type="password" onkeyup="pass_confirm()" placeholder="Introduceti parola din nou"
                   name="reg[confirm]" id="pwscr" class="inputcontainer"
                   required>
            <div class="alert alert-error" id="error-alert6" style="color: red" hidden>
                <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                <strong>Eroare! </strong>
                Parolele nu corespund.
            </div>
            <label for="nameuser"><b>Nume</b></label>
            <label>
                <input type="text" id="nameuser" class="inputcontainer" name="reg[name]"
                       placeholder="Introduceti numele"
                       required>
            </label>
            <div class="alert alert-error" id="error-name" style="color: red" hidden>
                <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                Numele poate contine doar litere.
            </div>
            <label for="prenumeuser"><b>Prenume</b></label>
            <label>
                <input type="text" id="prenumeuser" class="inputcontainer" name="reg[lastname]"
                       placeholder="Introduceti prenumele"
                       required>
            </label>
            <div class="alert alert-error" id="error-alert5" style="color: red" hidden>
                <button type="button" class="close" data-dismiss="alert" hidden>x</button>
                Prenumele poate contine doar litere , spatiu si \'-\'.
            </div>
            <div class="butoanean">
                <button type="submit" onsubmit="" id="reg" class="buttonmodal">Creaza cont</button>
            </div>
        </div>
    </form>
</div>