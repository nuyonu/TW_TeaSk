<?php
class AdminEventsController extends Controller
{
    public function show()
    {
        require_once(ROOT . DS . 'views' . DS . 'admin-events.php');
    }
}
