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
        FROM menu
        WHERE shop_id = ?
        ORDER BY item_name, size DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $shop_id);
$shop_id = $_SESSION['shop']; //session取得哪個店家
$stmt->execute();
$result = $stmt->get_result();
$arr = array();
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        array_push($arr, array('item_name' => $row["item_name"], 'item_name_en' =>$row["item_name_en"], 'id' =>$row["id"], 'size' =>$row["size"], 'price' => $row["price"]));
    }
} else {
}
echo json_encode($arr);

$stmt->close();
$conn->close();
?>
