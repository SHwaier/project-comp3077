<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once '../util.php';

$db_host = getenv('DATABASE_HOST');
$db_user = getenv('DATABASE_USER');
$db_pass = getenv('DATABASE_PASS');
$db_name = getenv('DATABASE_NAME');

try {
    // Establish a connection using PDO (PHP Data Objects)
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    // Set error reporting to Exception for easier debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection fails, output the error message and exit
    die("Connection failed: " . $e->getMessage());
}


$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Handle GET Request - Retrieve All User Profiles
    $userId = $_GET['id'] ?? null;
    if ($userId === null) {
        http_response_code(400);
        echo json_encode(["error" => "Missing user ID"]);
        exit;
    }
    try {
        $stmt = $pdo->prepare("SELECT username,first_name,last_name FROM user_profiles WHERE user_id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);



        if (empty($results)) {
            echo json_encode([]);
            exit;
        }
        echo json_encode($results, JSON_PRETTY_PRINT);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }

    if (empty($results)) {
        http_response_code(404);
        echo json_encode(["error" => "User profile not found"]);
        exit;
    }

} else if ($method === 'POST') {
    // Handle POST Request - Add New User Profile
    $data = json_decode(file_get_contents("php://input"), true);
    $data = sanitizeInput($data);
    // Check if the request body is empty
    if (empty($data)) {
        http_response_code(400);
        echo json_encode(["error" => "Request body is empty"]);
        exit;
    }

    // Validate Input
    if (!isset($data['username'], $data['email'], $data['password'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing required fields: username, email, password"]);
        exit;
    }

    // Insert New User into the Database
    try {
        $stmt = $pdo->prepare("INSERT INTO user_profiles (username, email, password) 
                            VALUES (:username, :email, :password)");
        // Bind parameters to prevent SQL injection
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT));

        $stmt->execute();

        http_response_code(201);
        echo json_encode(["message" => "User profile created successfully"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Method Not Allowed. Use GET or POST."]);
}

?>