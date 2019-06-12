<?php

class Headers
{
    public static function setHeader($val,$method="POST")
    {
        header("Access-Control-Allow-Origin: http://localhost/rest/" . $val);
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: ".$method);
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }

    public static function badRequest($message)
    {
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(array("title" => "Technical Skill Enhancer", "message" => $message));
    }

    public static function success()
    {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode(array("title" => "Technical Skill Enhancer", "message" => "Success"));
    }

    public static function badFormat()
    {
        http_response_code(422);
        header('Content-Type: application/json');
        echo json_encode(array("title" => "Technical Skill Enhancer", "message" => "Failed to read json."));
    }

    public static function acceptedMethod($method)
    {
        http_response_code(422);
        header('Content-Type: application/json');
        echo json_encode(array(
            "title" => "Technical Skill Enhancer",
            "message" => "Failed to read json.",
            "Accepted Method :" . $method
        ));
    }

    public static function notFound($message)
    {
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(array("title" => "Technical Skill Enhancer", "message" => $message));

    }

    public static function unauthorized()
    {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode(array("title" => "Technical Skill Enhancer", "message" => "Login failed."));
    }

    public static function successWithToken($token)
    {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode(array("title" => "Technical Skill Enhancer", "message" => "Success", "token" => $token));
    }
}



