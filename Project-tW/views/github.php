<?php
echo '<link rel="stylesheet" type="text/css" href="../styles/navbar-new.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
          integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <nav class="navbar" style="z-index: 3">
        <img  src="../images/logo.png" alt="Skill Enhancer"/>
        <ul>
            <li><a href="/home"><i class="fas fa-home"></i>Acasă</a></li>
            <li><a href="/events"><i class="fas fa-calendar-week"></i>Evenimente</a></li>
            <li><a href="/trainings"><i class="fas fa-user-graduate"></i>Training-uri</a></li>
            <li><a href="/contact"> <i class="fas fa-mobile-alt"></i>Contact</a></li>
            <li><a href="/support"><i class="fas fa-question-circle"></i>Suport</a></li>
            <li><a href="/about"><i class="fas fa-info-circle"></i>Despre</a></li>
            <button class="btn" id="signin" onclick="document.getElementById(\'id1\').style.display=\'block\'"  >
                Disconnect
            </button>
            <button class="btn" id="signup" >
                Settings
            </button>
        </ul>
    </nav>
    <div id="id1" class="modal" style="display: block;z-index: 2;position: fixed;top: unset;">
        <form class="modal-content animate" action="login1" method="post" id="login">
            <div class="imgcontainer">
              
                <!--<img src="./images/user.png" alt="Avatar user" class="avatar">-->
            </div>
            <div class="container">
                <label for="name"><b>Username</b></label>
                <input type="text"  name="data[user]" placeholder="Username" id="name" class="inputcontainer" required>
                <label for="pws"><b>Parola</b></label>
                <input type="password"  name="data[password]" placeholder="Introduceti parola" id="pws" class="inputcontainer" required>
                <button type="submit" id="logare" class="buttonmodal">Logare</button>
              
                
            </div>
            <div class="container">
                <button type="button" onclick="document.getElementById(\'id1\').style.display=\'none\'"
                        class="buttonmodal">
                    Anuleaza
                </button>
                <span class="psw"></span>
            </div>
        </form>
    </div>
    
    </div>';