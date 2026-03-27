<?php
include("dbcon.php");

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    // VERIFY THE PASSWORD HERE
    if (password_verify($password, $row['password'])) {
        //echo "Login successful!";
        //If login successfull will send them to the homepage.
        include ("Homepage.html");
    } else {
        echo "Invalid password!";
    }
}
?>