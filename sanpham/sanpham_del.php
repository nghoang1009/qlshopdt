<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once('../database.php');
	$masp = $_REQUEST["masp"];
	$db = new DB();
    $conn = $db->getConnection() or die("Không thể kết nối database");
    //Tạo câu truy vấn
    $sql_del_hangxs="DELETE FROM sanpham WHERE `sanpham`.`masp` = $masp";
	mysqli_query($conn,$sql_del_hangxs);
	header("Location: sanpham.php");
	?>
</body>
</html>