<?php

if (!filter_var($_POST["e_mail"], FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format"; 
    
} else {

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ordering_system";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO user (e_mail, name, password, phone)
        VALUES (?,?,?,?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $e_mail,$name, $password,$phone);
$e_mail = $_POST["e_mail"];
$name = $_POST["name"];
$password = $_POST["password"];
$phone = $_POST["phone"];
$stmt->execute();

if ($stmt) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$stmt->close();
$conn->close();
}
?>
