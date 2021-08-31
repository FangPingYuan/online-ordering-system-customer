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

$sql = "SELECT * FROM shops_list
        WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $shop_id);
$shop_id = $_SESSION['shop']; //session取得哪個店家
$stmt->execute();
$result = $stmt->get_result();
$arr = array();
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($arr, array('name' => $row["name"],'introduction' => $row["introduction"], 'img2' =>$row["img2"]));
    }
} else {
}
echo json_encode($arr);

$stmt->close();
$conn->close();
?>
