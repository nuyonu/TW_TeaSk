<?php
class AdminUsersController extends Controller
{
    public function show()
    {
        require_once (ROOT . DS . 'views' . DS . 'admin-users.php');
    }
}
