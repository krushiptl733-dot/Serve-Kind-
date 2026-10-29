<?php
session_start();
header('Content-Type: application/json');

// Include your database connection
require_once 'connectionfile.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get the raw POST data (handles both JSON and Form data)
$input = file_get_contents('php://input');
$data = [];

if (!empty($input)) {
    $json_data = json_decode($input, true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $data = $json_data;
    }
}

if (empty($data)) {
    $data = $_POST;
}

// Validate required fields
if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Name, Email, and Password are required']);
    exit;
}

$name = trim($data['name']);
$email = trim($data['email']);
$password = $data['password'];

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit;
}

// Password strength check
if (strlen($password) < 6) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters']);
    exit;
}

// Check if email already exists
$check_stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check_stmt->bind_param("s", $email);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email is already registered']);
    $check_stmt->close();
    exit;
}
$check_stmt->close();

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert new user
$stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
    exit;
}

$stmt->bind_param("sss", $name, $email, $hashed_password);

if ($stmt->execute()) {
    // Auto-login the user after signup
    $_SESSION['user_id'] = $stmt->insert_id;
    $_SESSION['user_name'] = $name;
    $_SESSION['user_email'] = $email;

    echo json_encode([
        'success' => true, 
        'message' => 'Account created successfully!',
        'user' => [
            'name' => $name,
            'email' => $email
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error creating account']);
}

$stmt->close();
$conn->close();
?>