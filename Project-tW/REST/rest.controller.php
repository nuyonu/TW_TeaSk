<?php
define("RESULT_PER_PAGE", 25);


use Firebase\JWT\JWT;

class RestController extends Controller
{


    public function trainings()
    {
        if (Method::isGet()) {
            $this->getTrainings();
        } elseif (Method::isDelete()) {
            $this->deleteTraining();
        }
    }

    public function events()
    {
        if (Method::isGet()) {
            $this->getEvents();
        } elseif (Method::isDelete()) {
            $this->deleteEvent();
        }
    }

    public function addEvents()
    {
        if (Method::isPost()) {
            if ($this->getAuth() != NULL) {
                $token = $this->getAuth();
                if ($token) {
                    try {
                        $decoded = JWT::decode($token, Config::get("KEY"), array('HS256'));
                        $data = $decoded->data;
                        $user = new UserDAO($data->username, $data->pass);
                        if ($user->valid()) {
                            $data_file = json_decode(file_get_contents("php://input"));
                            if ($this->verAddEvents($data_file)) {
                                $event = new EventsDAO($data_file->title, $data_file->organizer,
                                    $data_file->type, $data_file->location,
                                    $data->username, $data_file->price/*, $eventParams['seats']*/,
                                    $data_file->difficulty,
                                    $data_file->begin_date,
                                    $data_file->end_date, $data_file->begin_time, $data_file->end_time,
                                    $data_file->description,
                                    $data_file->tags);


                                $model = new EventsModel($this->database);
                                $model->saveEvent($event);
                                header('Content-Type: application/json');
                                http_response_code(200);
                                echo json_encode(
                                    array(
                                        "title" => "Technical Skill Enhancer",
                                        "message" => "Added successfully",
                                        "response" => 200,
                                    )
                                );
                            } else {
                                Headers::badFormat();
                            }
                        }

                    } catch (Exception $e) {
                        http_response_code(401);
                        echo json_encode(array(
                            "message" => "Access denied.",
                            "error" => $e->getMessage()
                        ));
                    }

                } else {
                    Headers::unauthorized();
                }
            }
        } else {
            Headers::acceptedMethod("POST");
        }
    }

    private function deleteEvent()
    {
        if ($this->getAuth() != NULL) {
            $token = $this->getAuth();
            if ($token) {
                try {
                    $decoded = JWT::decode($token, Config::get("KEY"), array('HS256'));
                    $data = $decoded->data;
                    $user = new UserDAO($data->username, $data->pass);
                    if ($user->valid()) {
                        $data_file = json_decode(file_get_contents("php://input"));
                        $model = new EventsModel($this->database);
                        $number_of_pages = ceil($model->getCountEventsByUsername($data->username) / RESULT_PER_PAGE);

                        if (!isset($data_file->id)) {
                            Headers::badFormat();
                        } else {
                            $model = new EventsModel($this->database);
                            $model->deleteEventById(intval($data_file->id));
                            header('Content-Type: application/json');
                            http_response_code(200);
                            echo json_encode(
                                array(
                                    "title" => "Technical Skill Enhancer",
                                    "message" => "Deleted successfully",
                                    "response" => 200,
                                )
                            );

                        }
                    }

                } catch (Exception $e) {
                    http_response_code(401);
                    echo json_encode(array(
                        "message" => "Access denied.",
                        "error" => $e->getMessage()
                    ));
                }

            } else {
                Headers::unauthorized();
            }
        }
    }

    private function deleteTraining()
    {
        if ($this->getAuth() != NULL) {
            $token = $this->getAuth();
            if ($token) {
                try {
                    $decoded = JWT::decode($token, Config::get("KEY"), array('HS256'));
                    $data = $decoded->data;
                    $user = new UserDAO($data->username, $data->pass);
                    if ($user->valid()) {
                        $data_file = json_decode(file_get_contents("php://input"));
                        if (!isset($data_file->id)) {
                            Headers::badFormat();
                        } else {
                            $model = new TrainingModel($this->database);
                            $model->deleteTrainingById(intval($data_file->id));
                            header('Content-Type: application/json');
                            http_response_code(200);
                            echo json_encode(
                                array(
                                    "title" => "Technical Skill Enhancer",
                                    "message" => "Deleted successfully",
                                    "response" => 200,
                                )
                            );

                        }
                    }

                } catch (Exception $e) {
                    http_response_code(401);
                    echo json_encode(array(
                        "message" => "Access denied.",
                        "error" => $e->getMessage()
                    ));
                }

            } else {
                Headers::unauthorized();
            }
        }
    }

    private function getEvents()
    {
        if ($this->getAuth() != NULL) {
            $token = $this->getAuth();
            if ($token) {
                try {
                    $decoded = JWT::decode($token, Config::get("KEY"), array('HS256'));
                    $data = $decoded->data;
                    $user = new UserDAO($data->username, $data->pass);
                    if ($user->valid()) {
                        $data_file = json_decode(file_get_contents("php://input"));
                        $model = new EventsModel($this->database);
                        $number_of_pages = ceil($model->getCountEventsByUsername($data->username) / RESULT_PER_PAGE);

                        if (!isset($data_file->page)) {
                            $page = 1;
                        } else {
                            $page = $data_file->page;
                        }

                        if (isset($data_file->title)) {
                            $title = $data_file->title;
                            $number_of_pages = ceil($model->getCountEventsByUsernameAndTitle($data->username,
                                    $title) / RESULT_PER_PAGE);
                        }
                        if (!is_numeric($page)) {
                            $page = 1;
                        }
                        if ($page < 1 || $page > $number_of_pages) {
                            $page = 1;
                        }
                        $this_page_first_result = ($page - 1) * RESULT_PER_PAGE;
                        if (isset($title)) {
                            $title = "%" . $title . "%";
                            $events = $model->getAllEventsByUsernameAndTitleOrderByDateASC($data->username, $title,
                                $this_page_first_result, RESULT_PER_PAGE);
                        } else {
                            $events = $model->getAllEventsByUsernameOrderByDateASC($data->username,
                                $this_page_first_result,
                                RESULT_PER_PAGE);
                        }
//
                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode(
                            array(
                                "title" => "Technical Skill Enhancer",
                                "message" => "Updated successfully",
                                "response" => 200,
                                "data" => Transform::toArrayEvents($events)
                            )
                        );

                    }
                } catch (Exception $e) {
                    http_response_code(401);
                    echo json_encode(array(
                        "message" => "Access denied.",
                        "error" => $e->getMessage()
                    ));
                }
            } else {
                Headers::unauthorized();
            }
        }
    }


    public function show()
    {
        header('Status: 200 OK');
        header('Content-Type: application/json');
        Headers::setHeader("", "*");
        http_response_code(200);
        echo json_encode(
            array(
                "title" => "Technical Skill Enhancer",
                "message" => "Welcome!",
            )
        );
    }

    public function contact()
    {
        Headers::setHeader("contact");
        if (Method::isPost()) {
            $data = json_decode(file_get_contents("php://input"));
            if (!isset($data->name) || !isset($data->email) || !isset($data->problem) || !isset($data->description) || empty($data->name) || empty($data->email) || empty($data->problem) || empty($data->description)) {
                Headers::badFormat();
            } else {
                $name = $data->name;
                $email = $data->email;
                $problem = $data->problem;
                $desc = $data->description;
                $contact = new ContactDao($name, $email, $problem, $desc);
                $db = new ContactModel($this->database);
                $db->save($contact);
                header('Status: 200 OK');
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode(
                    array(
                        "message" => "Problem added to database. You will be notified.",
                    )
                );
            }
        } else {
            Headers::acceptedMethod("POST");
        }
    }

    public function updateAccount()
    {
        if (Method::isPost()) {
            if ($this->getAuth() != NULL) {
                $token = $this->getAuth();
                if ($token) {
                    try {
                        $decoded = JWT::decode($token, Config::get("KEY"), array('HS256'));
                        $data = $decoded->data;
                        $user = new UserDAO($data->username, $data->pass);
                        if ($user->valid()) {
                            $database = new UserModel($this->database);
                            if ($database->getUser($user)) {
                                $result = $database->getUserDb($data->username);

                                if (isset($data->password) && !empty($data->password)) {
                                    $result->setPassword($data->password);
                                }
                                if (isset($data->email) && !empty($data->email)) {
                                    $result->setEMail($data->email);
                                }
                                if (isset($data->name) && !empty($data->name)) {
                                    $result->setLastName($data->name);
                                }
                                if (isset($data->firstname) && !empty($data->firstname)) {
                                    $result->setFirstName($data->firstname);
                                }
                                if (!$result->valid()) {
                                    header('Content-Type: application/json');
                                    http_response_code(400);
                                } else {
                                    header('Content-Type: application/json');
                                    http_response_code(200);
                                    echo json_encode(
                                        array(
                                            "title" => "Technical Skill Enhancer",
                                            "message" => "Updated successfully",
                                            "response" => 200,
                                        )
                                    );
                                }
                            }
                        }
                    } catch (Exception $e) {
                        http_response_code(401);
                        echo json_encode(array(
                            "message" => "Access denied.",
                            "error" => $e->getMessage()
                        ));
                    }
                } else {
                    Headers::unauthorized();
                }
            } else {
                Headers::unauthorized();
            }
        } else {
            Headers::acceptedMethod("POST");
        }
    }


    public function about()
    {
        Headers::setHeader("about");
        if (Method::isGet()) {
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode(
                array(
                    "Țelul site-ului" => "Skill Enhancer este o platformă ce conferă utilizatorilor o listă a celor mai importante evenimente ce țin de domeniul IT. Atât conferințele, atelierele de lucru, concursurile și stagiile de practica, cât și proiectele software la care un utilizator ar putea participa, sunt sugerate în funcție de profilul tehnic al utilizatorului. Echipa din spatele proiectului Skill Enhancer dorește să evoluționeze felul în care persoanele pasionate de programare își aleg preferințele în ceea ce privește informatica.",
                    "Dezvoltatorii site-ului" => array(
                        "Grigoraș Alexandru-Ionel ",
                        "Filoș Gabriel",
                        "Maxim Paul"
                    )
                )
            );
        } else {
            Headers::acceptedMethod("GET");
        }
    }


    public function auth()
    {
        Headers::setHeader("auth");
        if (Method::isPost()) {
            $data = json_decode(file_get_contents("php://input"));
            if (!isset($data->username) || !isset($data->password) || empty($data->username) || empty($data->password)) {
                Headers::badFormat();
            } else {
                $username = $data->username;
                $password = $data->password;
                $user = new UserDAO($username, $password);
                if ($user->valid()) {
                    $database = new UserModel($this->database);
                    if ($database->getUser($user)) {
                        $token = array(
                            "iss" => Config::get("ISS"),
                            "aud" => Config::get("AUD"),
                            "iat" => Config::get("IAT"),
                            "nbf" => Config::get("NBF"),
                            "data" => array(
                                "username" => $username,
                                "pass" => $password
                            )
                        );
                        header('Content-Type: application/json');
                        http_response_code(200);
                        $jwt = JWT::encode($token, Config::get("KEY"));
                        echo json_encode(
                            array(
                                "message" => "Successful login",
                                "jwt" => $jwt
                            )
                        );
                    } else {
                        Headers::unauthorized();
                    }
                } else {
                    Headers::unauthorized();
                }
            }
        } else {

            Headers::acceptedMethod("POST");
        }


    }


    public function register()
    {
        Headers::setHeader("register");
        if (Method::isPost()) {
            $data = json_decode(file_get_contents("php://input"));
            if ($this->ver1($data) || $this->ver2($data)) {
                Headers::badFormat();
            } else {
                $register = new Register();
                $register->setUsername($data->username);
                $register->setPassword($data->password);
                $register->setEmail($data->email);
                $register->setName($data->firstname);
                $register->setConfirm($data->password);
                $register->setLastName($data->name);
                $UserRepository = new UserModel($this->database);
                if ($register->validate()) {
                    if (!$UserRepository->existUsername($register->getUsername())) {
                        $UserRepository->saveUser($register);
                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode(
                            array(
                                "title" => "Technical Skill Enhancer",
                                "message" => "Registration successfully",
                            )
                        );
                    } else {
                        header('Content-Type: application/json');
                        http_response_code(401);
                        echo json_encode(
                            array(
                                "title" => "Technical Skill Enhancer",
                                "message" => "Registration failed",
                            )
                        );
                    }
                } else {
                    http_response_code(401);
                    header('Content-Type: application/json');
                    echo json_encode(array(
                        "title" => "Technical Skill Enhancer",
                        "message" => "Registration failed."
                    ));
                }
            }
        } else {
            Headers::acceptedMethod("POST");
        }
    }


    public function info()
    {
        if (Method::isGet()) {
            if ($this->getAuth() != NULL) {
                $token = $this->getAuth();
                if ($token) {
                    try {
                        $decoded = JWT::decode($token, Config::get("KEY"), array('HS256'));
                        $data = $decoded->data;
                        $user = new UserDAO($data->username, $data->pass);
                        if ($user->valid()) {
                            $database = new UserModel($this->database);
                            if ($database->getUser($user)) {
                                $result = $database->getUserDb($data->username);
                                header('Content-Type: application/json');
                                http_response_code(200);
                                echo json_encode(
                                    array(
                                        "title" => "Technical Skill Enhancer",
                                        "message" => "Succesful",
                                        "response" => 200,
                                        "user" => array(
                                            "id" => $result->getId(),
                                            "username" => $result->getUsername(),
                                            "email" => $result->getEMail(),
                                            "first name" => $result->getFirstName(),
                                            "last name" => $result->getLastName(),
                                            "Github" => $result->getGithubToken() == NULL ? "No" : "Yes",
                                            "Linkedln" => $result->getLinkedlnToken() == NULL ? "No" : "Yes"
                                        )
                                    )
                                );

                            }

                        }
                    } catch (Exception $e) {
                        http_response_code(401);
                        header('Content-Type: application/json');

                        echo json_encode(array(
                            "message" => "Access denied.",
                            "error" => $e->getMessage(),
                            "token" => $this->getAuth()
                        ));
                    }

                }

            } else {
                Headers::unauthorized();
            }

        } else {

            Headers::acceptedMethod("GET");
        }
    }

    private function ver1($data)
    {
        return !isset($data->username) || !isset($data->password) || !isset($data->email) || !isset($data->name) || !isset($data->firstname);
    }

    private function ver2($data)
    {
        return empty($data->username) || empty($data->password) || empty($data->email) || empty($data->name) || empty($data->firstname);
    }

    private function getAuth()
    {
        $header = apache_request_headers();
        if (isset($header['Authorization']) && !empty($header['Authorization'])) {
            $val = explode(" ", $header['Authorization']);
            return $val[1];
        }
        return NULL;
    }


    private function verAddEvents($data_file)
    {
        return isset($data_file->title) && isset($data_file->organizer) && isset(
                $data_file->type) && isset($data_file->location) && isset($data_file->price) && isset($data_file->difficulty) && isset(
                $data_file->begin_date) && isset(
                $data_file->end_date) && isset($data_file->begin_time, $data_file->end_time) && isset(
                $data_file->description) && isset(
                $data_file->tags);
    }

    private function getTrainings()
    {
        if ($this->getAuth() != NULL) {
            $token = $this->getAuth();
            if ($token) {
                try {
                    $decoded = JWT::decode($token, Config::get("KEY"), array('HS256'));
                    $data = $decoded->data;
                    $user = new UserDAO($data->username, $data->pass);
                    if ($user->valid()) {
                        $data_file = json_decode(file_get_contents("php://input"));
                        $model = new TrainingModel($this->database);
                        $number_of_pages = ceil($model->getCountTrainingsByUsername($data->username) / RESULT_PER_PAGE);

                        $page = (!isset($data_file->page) || !is_numeric($data_file->page)) ? 1 : $data_file->page;
                        $page = min(max($page, 1), $number_of_pages);

                        $this_page_first_result = ($page - 1) * RESULT_PER_PAGE;

                        $trainings = $model->getTrainingsByUsernameOrderByDateASC($data->username,
                            RESULT_PER_PAGE,
                            $this_page_first_result
                        );
//                        var_dump($trainings);
                        header('Content-Type: application/json');
                        http_response_code(200);
                        echo json_encode(
                            array(
                                "title" => "Technical Skill Enhancer",
                                "message" => "Updated successfully",
                                "response" => 200,
                                "data" => Transform::toArrayTraings($trainings)
                            )
                        );

                    }
                } catch (Exception $e) {
                    http_response_code(401);
                    echo json_encode(array(
                        "message" => "Access denied.",
                        "error" => $e->getMessage()
                    ));
                }
            } else {
                Headers::unauthorized();
            }
        }
    }


}

