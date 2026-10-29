<?php
require_once 'connectionfile.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {

    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $email = trim($_POST['emailaddress'] ?? '');
    $phone = trim($_POST['phonenumber'] ?? '');
    $subject = trim($_POST['subject'] ?? 'General Question');
    $message = trim($_POST['message'] ?? '');

    if (empty($firstname) || empty($email) || empty($message)) {
        // Redirect with error
        header("Location: contactus.php?status=error&msg=Please+fill+all+required+fields");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contactus.php?status=error&msg=Invalid+email+format");
        exit;
    }

    $sql = "INSERT INTO contact_messages (firstname, lastname, emailaddress, phonenumber, subject, message) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $email, $phone, $subject, $message);
        if (mysqli_stmt_execute($stmt)) {
            // Redirect back with success flag
            header("Location: contactus.php?status=success");
            exit;
        } else {
            header("Location: contactus.php?status=error&msg=Database+error");
            exit;
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: contactus.php?status=error&msg=System+error");
        exit;
    }

    mysqli_close($conn);
} else {
    header("Location: contactus.php");
    exit;
}
