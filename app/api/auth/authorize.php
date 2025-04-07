<?php
require_once 'validate_jwt.php';

/**
 * Authorizes a request by validating the JWT token provided in the Authorization header.
 */
function authorize_request()
{

    $headers = getallheaders();

    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Authorization header missing']);
        exit;
    }

    $auth_header = $headers['Authorization'];
    if (preg_match('/Bearer\s(\S+)/', $auth_header, $matches)) {
        $jwt = $matches[1];
        $payload = validate_jwt($jwt);
        if ($payload === false) {
            http_response_code(401);
            exit;
        }
        return $payload;
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid authorization header']);
        exit;
    }
}

function authorize_request_frontend()
{
    $headers = getallheaders();

    if (!isset($headers['Authorization'])) return null;

    if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
        $jwt = $matches[1];
        return validate_jwt($jwt); // returns payload or false
    }

    return null;
}
