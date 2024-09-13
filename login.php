<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'Database.php';
require_once 'UserAuthentication.php';

$host = "localhost";
$dbname = "login_database";
$username = "Paul";
$password = "65623@bsix.ac.uk";

// Create an instance of the Database class
$database = new Database($host, $username, $password, $dbname);

// Use the Database instance to create an instance of the UserAuthentication class
$auth = new UserAuthentication($database);

// Call the login method of the UserAuthentication class
$auth->login("Paul", "65623@bsix.ac.uk");

// Close the database connection after use
$database->close();

?>

<!DOCTYPE html>
<html>
<head>
  <title>Staff login-Inventory Management System</title>
  <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body id="LoginBody">
    <div class="loginhead">
        <a href=index.html>Back to Homepage</a>
    </div>
    <div class="container">
        <div class="loginheader">
            <h1>INVIGO</h1>
            <h3>Inventory Management System</h3>
        </div>

        <?php if ($is_invalid): ?>
            <em>Invalid Login</em>
        <?php endif; ?>

        <div class="loginbody">
            <form method="POST">
                 <div class="logininputContainer">
                      <label for ="">Username</label>
                      <input placeholder="Username" name="Username" type="text" />
                 </div>
                 <div class="logininputContainer">
                      <label for ="">Password</label>
                      <input placeholder="Password" name="Password" type="password" />
                 </div>
                 <div class="loginbuttonContainer">
                   <button><b>login</b></button>                  
                 </div>
                 <div class="loginnewaccount">
                     <p>Do not have an account? <a href="Register.html">Register</a></p>
                 </div>
            </form>

        </div>
    </div>
</body>
</html>
