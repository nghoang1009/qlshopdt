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
	$makh = $_REQUEST["makh"];
	$db = new DB();
    $conn = $db->getConnection() or die("Không thể kết nối database");
    //Tạo câu truy vấn
    $sql_del_tk="DELETE FROM taikhoan WHERE matk = $makh";
    mysqli_query($conn,$sql_del_tk);
	header("Location: khachhang.php");
	?>
</body>
</html>