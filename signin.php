<?php
session_start();
header('Content-Type: application/json');

// Include your database connection
require_once 'connectionfile.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get data
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

// Validate
if (empty($data['email']) || empty($data['password'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Email and password are required']);
    exit;
}

$email = trim($data['email']);
$password = $data['password'];

// Look up user by email
$stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error']);
    exit;
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // Verify the password hash
    if (password_verify($password, $row['password'])) {
        // Password correct - Start Session
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        $_SESSION['user_email'] = $row['email'];

        echo json_encode([
            'success' => true, 
            'message' => 'Login successful!',
            'user' => [
                'name' => $row['name'],
                'email' => $row['email']
            ]
        ]);
    } else {
        // Password incorrect
        http_response_code(401); // Unauthorized
        echo json_encode(['success' => false, 'message' => 'Invalid password']);
    }
} else {
    // User not found
    http_response_code(404); // Not found
    echo json_encode(['success' => false, 'message' => 'No account found with this email']);
}

$stmt->close();
$conn->close();
?>