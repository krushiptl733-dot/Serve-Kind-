<?php
session_start();
require_once 'connectionfile.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: home.php');
    exit();
}

// Clean input
function clean_input($data, $conn) {
    return htmlspecialchars(trim(mysqli_real_escape_string($conn, $data)));
}

// User ID if logged in, otherwise 0
$uid = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0;

// Collect all fields directly from form (FOR BOTH USERS)
$first_name = clean_input($_POST['first_name'] ?? '', $conn);
$last_name  = clean_input($_POST['last_name'] ?? '', $conn);
$email      = clean_input($_POST['email'] ?? '', $conn);
$phone      = clean_input($_POST['phone'] ?? '', $conn);

$payment_method = clean_input($_POST['payment_method'] ?? 'card', $conn);
$tax_receipt    = isset($_POST['tax_receipt']) ? 1 : 0;

// Amount cleanup
$raw_amount   = $_POST['amount'] ?? '';
$clean_amount = preg_replace('/[^\d.]/', '', $raw_amount);
$amount       = floatval($clean_amount);

// Basic validation
if ($amount <= 0) die("Error: Invalid amount.");
if (empty($first_name) || empty($email)) die("Error: Name and Email required.");

$transaction_id = 'SK' . date('YmdHis') . rand(1000, 9999);

// Insert into database
$sql = "INSERT INTO monetary_donations 
        (user_id, amount, payment_method, tax_receipt, first_name, last_name, email, phone, transaction_id)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "idsisssss",
    $uid,
    $amount,
    $payment_method,
    $tax_receipt,
    $first_name,
    $last_name,
    $email,
    $phone,
    $transaction_id
);

if ($stmt->execute()) {
    header("Location: donate.php?success=1#donate");
    exit();
} else {
    die("Database Error: " . $stmt->error);
}

$stmt->close();
$conn->close();
?>