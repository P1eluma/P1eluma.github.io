<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (empty($_POST["name"])) {
    die("Name is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Invalid email is required");
}

if (strlen($_POST["password"]) <= 6) {
    die("Password must be at least 6 characters");
}

if (!preg_match("/[a-zA-Z]/", $_POST["password"])) {
    die("Password must contain at least one letter.");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

// Check if passwords match
if ($_POST["password"] !== $_POST["repeatPassword"]) {
    die("Passwords must match");
}

// Replace passwords with asterisks for security
$_POST['password'] = str_repeat('*', strlen($_POST["password"]));
$_POST['repeatPassword'] = str_repeat('*', strlen($_POST["repeatPassword"]));

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Include the database connection file
require_once __DIR__ . "/Database.php";

$sql = "INSERT INTO users (name, email, password_hash, position) VALUES (?,?,?,?)";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss", 
                  $_POST["name"], 
                  $_POST["email"], 
                  $password_hash, 
                  $_POST["position"]);

if ($stmt->execute()) {
    // Registration successful, show popup message
    echo "<script>alert('User registration successful. You can now log in.'); window.location.href = 'login.php';</script>";
    exit;
} else {
    if($mysqli->errno === 1062) {
        die("Email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

$stmt->close();
$mysqli->close();
?>
