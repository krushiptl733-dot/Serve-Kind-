<?php
session_start();

// --- FIX: Allow guest users for food donations ---
// The login requirement is removed, and user_id is set based on session/POST input.

$servername = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "webdata";

$conn = new mysqli($servername, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    error_log("DB conn error: " . $conn->connect_error);
    $_SESSION['food_errors'] = ['Database connection failed.'];
    header('Location: home.php#donate');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: home.php#donate');
    exit();
}

function clean($v, $conn) { return trim($conn->real_escape_string($v)); }

// Get User ID: Prefer session ID if logged in, otherwise use the hidden input value (which is 0 for guests).
$uid = 0;
if (isset($_SESSION['user_id']) && intval($_SESSION['user_id']) > 0) {
    $uid = intval($_SESSION['user_id']);
}
// Note: If the form passed user_id=0, it will remain 0 here, which correctly identifies a guest donation.


$donation_type = isset($_POST['donation_type']) ? clean($_POST['donation_type'], $conn) : null;
$donation_details = isset($_POST['donation_details']) ? clean($_POST['donation_details'], $conn) : '';
$address_line1 = isset($_POST['address_line1']) ? clean($_POST['address_line1'], $conn) : '';
$address_line2 = isset($_POST['address_line2']) ? clean($_POST['address_line2'], $conn) : null;
$city = isset($_POST['city']) ? clean($_POST['city'], $conn) : '';
$pincode = isset($_POST['pincode']) ? clean($_POST['pincode'], $conn) : '';
$pickup_date = isset($_POST['pickup_date']) ? $_POST['pickup_date'] : '';
$pickup_time = isset($_POST['pickup_time']) ? $_POST['pickup_time'] : '';
$full_name = isset($_POST['full_name']) ? clean($_POST['full_name'], $conn) : '';
$email = isset($_POST['email']) ? clean($_POST['email'], $conn) : '';
$phone = isset($_POST['phone']) ? clean($_POST['phone'], $conn) : '';
$food_safety = isset($_POST['food_safety']) ? 1 : 0;

$errors = [];
// Added validation for donation_type, which is required
if ($donation_type === null || $donation_type === '') $errors[] = "Donation type is required.";
if ($donation_details === '') $errors[] = "Donation details are required.";
if ($address_line1 === '') $errors[] = "Address line 1 is required.";
if ($city === '') $errors[] = "City is required.";
if ($pincode === '' || !preg_match('/^[1-9][0-9]{5}$/', $pincode)) $errors[] = "Valid 6-digit pincode is required.";
if ($pickup_date === '') $errors[] = "Pickup date is required.";
if ($pickup_time === '') $errors[] = "Pickup time is required.";
if ($full_name === '') $errors[] = "Full name is required.";
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
if ($phone === '') $errors[] = "Phone number is required.";
if (!$food_safety) $errors[] = "Food safety confirmation is required.";

if (!empty($errors)) {
    $_SESSION['food_errors'] = $errors;
    header('Location: home.php#donate');
    exit();
}

// Validate pickup date not in past
$selDate = DateTime::createFromFormat('Y-m-d', $pickup_date);
$today = new DateTime('today');
if ($selDate < $today) {
    $_SESSION['food_errors'] = ['Pickup date cannot be in the past.'];
    header('Location: home.php#donate');
    exit();
}

$stmt = $conn->prepare("INSERT INTO food_donations
    (user_id, donation_type, donation_details, address_line1, address_line2, city, pincode, pickup_date, pickup_time, full_name, email, phone, food_safety)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    error_log("Prepare failed: " . $conn->error);
    $_SESSION['food_errors'] = ['Database error.'];
    header('Location: home.php#donate');
    exit();
}

$stmt->bind_param(
    "isssssssssssi",
    $uid, // Will be User ID or 0 for guest
    $donation_type,
    $donation_details,
    $address_line1,
    $address_line2,
    $city,
    $pincode,
    $pickup_date,
    $pickup_time,
    $full_name,
    $email,
    $phone,
    $food_safety
);

if ($stmt->execute()) {
    $_SESSION['food_success'] = "Pickup scheduled. We'll contact you shortly.";
    $_SESSION['last_food_id'] = $stmt->insert_id;
    header('Location: home.php#donate');
    exit();
} else {
    error_log("Insert failed: " . $stmt->error);
    $_SESSION['food_errors'] = ['Error saving pickup request.'];
    header('Location: home.php#donate');
    exit();
}

$stmt->close();
$conn->close();