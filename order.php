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
$sql = "INSERT INTO order_list (user_id, menu_id, ice, sugar, amount)
        VALUES ((SELECT id FROM user WHERE e_mail = ?),
                (SELECT id FROM menu WHERE shop_id = ? 
                AND item_name = ? AND size = ?),
                ?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sissssi", $name,$shop_id,$item_name,$size,$ice,$sugar,$amount);

foreach($_POST["data"] as $data){
    $name = $_SESSION['e_mail'];  //session取得使用者e-mail
    $shop_id = $_SESSION["shop"];  //session取得shop_id
    $item_name = $data['item_name'];
    $size = $data["size"];
    $ice = $data["ice"];
    $sugar = $data["sugar"];
    $amount = $data["amount"];
    $stmt->execute();
    if ($stmt) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
$stmt->close();
$conn->close();
?>
