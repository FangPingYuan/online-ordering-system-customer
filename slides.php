<?php
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
$sql = "SELECT * FROM slides_source";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$arr = array();
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        array_push($arr, array('id' => $row["id"], 'src' =>$row["src"]));
    }
} else {
}
echo json_encode($arr);

$stmt->close();
$conn->close();
?>
