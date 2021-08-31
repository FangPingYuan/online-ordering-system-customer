<?php
session_start();
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

$sql = "SELECT * 
        FROM user
        WHERE e_mail = ? AND password = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $e_mail, $password);
$e_mail = $_POST["e_mail"];
$password = $_POST["password"];
$stmt->execute();
$result = $stmt->get_result();

$arr = array();
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $stmt->close();
    $conn->close();
    echo 1;
    $_SESSION['e_mail']=$_POST["e_mail"];
} else {
    $stmt->close();
    $conn->close();
    echo 0;
}

?>
