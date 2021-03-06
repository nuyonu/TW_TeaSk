<?php

class Constants
{
    public const NAME_APP = 'my-app';
    public const USER = 'user';
    public const EMPTY = "";
    public const HIDDEN = "hidden";
    public const DATA = "data";
    public const PSW = "password";
    public const GRADE = "grade";

    public const SUCCESS_RESULT = "success";
    public const SUCCESS = 1;
    public const FAIL = 0;

    //  Views
    public const VIEW_SETTING = VIEW . 'setting.php';
    public const VIEW_ADMIN_USERS = VIEW . 'admin-users.php';
    public const VIEW_INDEX = VIEW . 'index.php';

//    Redirects
    public const SETTINGS = '/settings';
    public const ADMIN_USERS = "/adminusers";
    public const HOME = "/home";

//    Actions
    public const ALL_DELETE = 'check_list_for_delete';
    public const SEARCH = 'search';

    const MAX_PAGE = 30;
    const NOT_SETTED = 'nesetat';
    const MAX_SIZE = 500000;
    const FAUL_MESSAGE = 'Datele trimise fie nu sunt valabile ,fie nu au fost completate corect';
    const CONTACT = '/contact';
    const INTERVAL_UPDATE = 80000;
    const STATISTICS_VIEW =VIEW.'Statistici.php' ;

}