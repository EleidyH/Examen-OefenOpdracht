<?php
include("dbcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $adress = $_POST['adress'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // HASH THE PASSWORD HERE (before saving to database)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, adress, email, password) VALUES (? ,? ,? ,? ,?)");
    $stmt->bind_param("sssss", $first_name, $last_name, $adress, $email, $hashed_password);

    if ($stmt->execute()) {
        //echo "Registration Succesfull"
        //If register is succesfull will send them to homepage.
        include ("homepage.html");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>