<?php

use duncan3dc\Sessions\SessionInstance;

class NavigatorUsers
{
    public static function firstPage()
    {
        $search = Parameters::getData("search");
        if ($search != NULL) {
            echo '1&search=' . $search;
        } else {
            echo 1;
        }
    }

    public static function prevPage()
    {
        $val = intval(Parameters::getData("current_page"));
        $search = Parameters::getData("search");
        if ($val > 1) {
            $val--;
        } else {
            $val = 1;
        }
        if ($search != NULL) {
            echo $val . "&search=" . $search;
        } else {
            echo $val;
        }
    }

    public static function nextPage()
    {
        $maxPage = intval(Parameters::getData("max_page"));
        $currentPage = intval(Parameters::getData("current_page"));
        $search = Parameters::getData("search");
        if ($maxPage > $currentPage) {
            $currentPage++;
        }
        if ($search != NULL) {
            echo $currentPage . "&search=" . $search;
        } else {
            echo $currentPage;
        }
    }

    public static function lastPage()
    {
        $search = Parameters::getData("search");
        if ($search != NULL) {
            echo Parameters::getData("max_page") . "&search=" . $search;
        } else {
            echo Parameters::getData("max_page");
        }
    }

    public static function intermediarPage()
    {
        $currentPage = intval(Parameters::getData("current_page"));
        $begin = $currentPage - 10;
        if ($begin < 1) {
            $begin = 1;
        }
        $search = Parameters::getData("search");
        $search = $search == NULL ? "" : $search;
        for ($begin; $begin < $currentPage; $begin++) {
            echo '<a href="/adminUsers?page=' . $begin . '&search=' . $search . '" class="linkPage">' . $begin . '</a>';
        }
        echo '<a href="#" class="currentPage">' . $currentPage . '</a>';
        $end = $currentPage + 11;
        $currentPage++;
        if ($end > intval(Parameters::getData("max_page"))) {
            $end = intval(Parameters::getData("max_page"));
        }
        for ($currentPage; $currentPage <= $end; $currentPage++) {
            echo '<a  class="linkPage" href="/adminUsers?page=' . $currentPage . '&search=' . $search . '">' . $currentPage . '</a>';

        }
    }

    public static function currentPage()
    {
        echo Parameters::getData("current_page");
    }

    public static function allPageSelect()
    {
        for ($index = 1; $index < intval(Parameters::getData("max_page")); $index++) {
            echo '<option value="' . $index . '">' . $index . '</option>';
        }
    }

    public static function isAdmin()
    {
        $session = new SessionInstance(Constants::NAME_APP);
        $grade = $session->get(Constants::GRADE)['grade'];
        if ($grade == 1) {
            echo '<a href="/adminHome"><button class="btn" id="signup">Admin Panel</button></a>';
        } elseif ($grade == 2) {
            echo '<a href="/settings"><button class="btn" id="signup">Settings</button></a>';
            echo '<a href="/adminHome"><button class="btn" id="signup">Moderator</button></a>';
        } else {
            echo '<a href="/settings"><button class="btn" id="signup">Settings</button></a>';

        }
    }
}
