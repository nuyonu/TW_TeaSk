<?php
class AdminSupportController extends Controller
{
    public function show()
    {
        require_once (ROOT . DS . 'views' . DS . 'admin-support.php');
    }
}