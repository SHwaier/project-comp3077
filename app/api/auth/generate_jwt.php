<?php
require_once 'jwt_helpers.php';


function generate_jwt($payload)
{
    $header = ['alg' => 'HS256', 'typ' => 'JWT'];
    $secret = getenv('JWT_SECRET');

    $header_encoded = base64url_encode(json_encode($header));
    $payload_encoded = base64url_encode(json_encode($payload));
    $signature = hash_hmac('sha256', "$header_encoded.$payload_encoded", $secret, true);
    $signature_encoded = base64url_encode($signature);

    return "$header_encoded.$payload_encoded.$signature_encoded";
}
