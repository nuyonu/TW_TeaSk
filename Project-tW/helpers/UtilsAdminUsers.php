<?php

class UtilsAdminUsers {
    public static function getSearch($params)
    {
        if (isset($_POST[Constants::SEARCH])) {
            return $_POST[Constants::SEARCH];
        } elseif (array_key_exists('search', $params)) {
            return $params['search'];
        }
        return NULL;
    }

    public static function getPage($maxPage,$params)
    {
        $page = 1;
        if (array_key_exists('page', $params)) {

            $page = intval($params['page']);
            if ($page < 1) {
                $page = 1;
            } elseif ($page > $maxPage) {
                $page = $maxPage;
            }
        }
        return $page;
    }
}