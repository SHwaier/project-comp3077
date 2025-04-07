<?php
require_once 'validate_jwt.php';

/**
 * Verifies whether the user has a valid (non-expired) JWT token.
 * Intended for use in frontend fetch requests.
 */
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization");

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
        echo json_encode(['error' => 'Invalid or expired token']);
        exit;
    }

    // return user info or status
    http_response_code(200);
    echo json_encode([
        'status' => 'verified',
        'role' => $payload['role'] ?? null,
        'username' => $payload['username'] ?? null,
        'exp' => $payload['exp']
    ]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Invalid authorization header']);
