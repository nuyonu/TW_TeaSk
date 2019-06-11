<?php
define("RESULT_PER_PAGE", 25);
use duncan3dc\Sessions\SessionInstance;

class AdmineventsController extends Controller
{
    private $session;

    public function __construct()
    {
        parent::__construct();
        $this->session = new SessionInstance(Constants::NAME_APP);
    }

    public function show()
    {
        $model = new EventsModel($this->database);
        $username = $this->session->get("user");
        $number_of_pages = ceil($model->getCountEventsByUsername($username)/RESULT_PER_PAGE);
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        if(!is_numeric($page))
            $page = 1;
        if($page < 1 || $page > $number_of_pages)
            $page = 1;
        $this_page_first_result = ($page-1)*RESULT_PER_PAGE;
        $events = $model->getAllEventsByUsernameOrderByDateASC($username, $this_page_first_result, RESULT_PER_PAGE);
        require_once(VIEW . 'admin-events.php');
    }

    public function deleteEvents()
    {
        if (isset($_GET['check_list_for_delete'])) {
            $eventsForRemove = $_GET['check_list_for_delete'];
            $model = new EventsModel($this->database);
            foreach ($eventsForRemove as $key => $id)
                $model->deleteEventById($id);
        }

        echo "<script>window.location.replace('/adminEvents')</script>";
    }
}
