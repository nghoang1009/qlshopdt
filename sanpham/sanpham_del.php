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

    $getImageSQL = "Select hinhanh from sanpham where masp = $masp";
    $result = mysqli_query($conn, $getImageSQL) or die("Lỗi khi tìm ảnh");
    $row = mysqli_fetch_assoc($result);
    $image = $row["hinhanh"];

    $sql_del_hangxs="DELETE FROM sanpham WHERE `sanpham`.`masp` = $masp";
	mysqli_query($conn,$sql_del_hangxs) or die ("Lỗi khi xóa sản phẩm");

    unlink("../img/" . $image) or die("Xóa ảnh $image không thành công");

	header("Location: sanpham.php");
	?>
</body>
</html>