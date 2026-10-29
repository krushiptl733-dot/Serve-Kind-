<?php
session_start();

// Require login
if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash_error'] = 'Please sign in to apply as a volunteer.';
    header('Location: home.php');
    exit();
}

$servername = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "webdata";

$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    error_log("DB conn error: " . $conn->connect_error);
    $_SESSION['flash_error'] = 'Database connection failed.';
    header('Location: home.php#volunteer');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: home.php#volunteer');
    exit();
}

function clean($v, $conn) { return trim($conn->real_escape_string($v)); }

$uid = intval($_SESSION['user_id']);

$first_name = isset($_POST['first_name']) ? clean($_POST['first_name'], $conn) : '';
$last_name  = isset($_POST['last_name'])  ? clean($_POST['last_name'], $conn) : '';
$email      = isset($_POST['email'])      ? clean($_POST['email'], $conn) : '';
$phone      = isset($_POST['phone'])      ? clean($_POST['phone'], $conn) : '';
$location   = isset($_POST['vol-location']) ? clean($_POST['vol-location'], $conn) : (isset($_POST['location']) ? clean($_POST['location'], $conn) : '');
$interests  = isset($_POST['interests']) ? $_POST['interests'] : (isset($_POST['interests[]']) ? $_POST['interests[]'] : []); // support both names
$availability = isset($_POST['availability']) ? $_POST['availability'] : [];
$message    = isset($_POST['message']) ? clean($_POST['message'], $conn) : '';
$agreed_terms = isset($_POST['terms']) ? 1 : 0;

// Validate
$errors = [];
if ($first_name === '') $errors[] = "First name is required.";
if ($last_name === '') $errors[] = "Last name is required.";
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
if ($phone === '') $errors[] = "Phone number is required.";
if ($location === '') $errors[] = "Location is required.";
if (empty($interests)) $errors[] = "Please select at least one area of interest.";
if (empty($availability)) $errors[] = "Please select at least one availability option.";
if (!$agreed_terms) $errors[] = "You must agree to the terms and conditions.";

if (!empty($errors)) {
    $_SESSION['vol_errors'] = $errors;
    header('Location: home.php#volunteer');
    exit();
}

// Convert arrays to CSV strings for storage
$areas_csv = is_array($interests) ? implode(',', array_map(function($v) use($conn){ return $conn->real_escape_string($v); }, $interests)) : clean($interests, $conn);
$avail_csv = is_array($availability) ? implode(',', array_map(function($v) use($conn){ return $conn->real_escape_string($v); }, $availability)) : clean($availability, $conn);

$stmt = $conn->prepare("INSERT INTO volunteer_registrations 
    (user_id, first_name, last_name, email, phone, location, areas_of_interest, availability, message, agreed_terms)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    $_SESSION['vol_errors'] = ['Database error.'];
    header('Location: home.php#volunteer');
    exit();
}

$stmt->bind_param(
    "issssssssi",
    $uid,
    $first_name,
    $last_name,
    $email,
    $phone,
    $location,
    $areas_csv,
    $avail_csv,
    $message,
    $agreed_terms
);

if ($stmt->execute()) {
    $_SESSION['vol_success'] = "Thanks! Your volunteer application has been submitted.";
    $_SESSION['last_volunteer_id'] = $stmt->insert_id;
    header('Location: home.php#volunteer');
    exit();
} else {
    error_log("Insert failed: " . $stmt->error);
    $_SESSION['vol_errors'] = ['Error saving application.'];
    header('Location: home.php#volunteer');
    exit();
}

$stmt->close();
$conn->close();
