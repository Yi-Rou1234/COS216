<?php
// Retrieve user input
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate user input
if (empty($name) || empty($surname) || empty($email) || empty($password)) {
    die("Please fill in all fields");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format");
}

if (strlen($password) < 8) {
    die("Password must be at least 8 characters long");
}

if (!preg_match("#[0-9]+#", $password)) {
    die("Password must contain at least one number");
}

if (!preg_match("#[a-z]+#", $password)) {
    die("Password must contain at least one lowercase letter");
}

if (!preg_match("#[A-Z]+#", $password)) {
    die("Password must contain at least one uppercase letter");
}

if (!preg_match("#[\W]+#", $password)) {
    die("Password must contain at least one symbol");
}

//connect to database call 
include(dirname('connect.php').DIRECTORY_SEPARATOR."connect.php");

// Check if email already exists in database
$sql = "SELECT * FROM userdb WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    die("Email already exists");
}

// Hash password with salt
$salt = bin2hex(random_bytes(16));
$hashed_password = hash('sha256', $password . $salt);

// Generate API key
$api_key = bin2hex(random_bytes(8));

// Insert user into database
$sql = "INSERT INTO userdb (name, surname, email, password, salt, APIkey)
        VALUES ('$name', '$surname', '$email', '$hashed_password', '$salt' , '$api_key')";

if (mysqli_query($conn, $sql)) {
    echo "SIGN-UP SUCCESSFUL!!!!!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header("Location: ../index.php");
die();
?>