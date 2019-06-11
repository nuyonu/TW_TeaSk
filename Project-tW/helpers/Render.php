<?php

use duncan3dc\Sessions\SessionInstance;

class Render
{
    public static function footer()
    {
        require_once(TEMPLATES . 'footer.php');
    }

    public static function navbar()
    {
        if ((new SessionInstance(Constants::NAME_APP))->get(Constants::USER) != NULL) {
            require_once(TEMPLATES . 'navbar_without_login.php');
        } else {
            require_once(TEMPLATES . 'navbar.php');
        }
    }

    public static function adminNavbar()
    {
        include '../webroot/templates/admin-common.php';
    }

    public static function moderator()
    {
        if (Parameters::getData(Constants::GRADE) == 3) {
            echo '<button type="button" class="savebutton" style="background: red; border-color: red;"
                                    onclick="moderator()">Moderator?</button>';
        } elseif (Parameters::getData(Constants::GRADE) == 2) {
            echo '<button type="button" class="savebutton" style="background: red; border-color: red;"
                                    onclick="utilizator()">Utilizator normal?</button>';
        }
    }

    public static function buttonModerator()
    {
        $session = new SessionInstance(Constants::NAME_APP);
        if ($session->get(Constants::GRADE)['grade'] == 1) {
            echo ' <div class="menu-item">
               <a href="/adminUsers"><i class="fa fa-users"></i> Utilizatori</a>
                 </div>';
        }
    }

    public static function panelModerator()
    {

    }
}