<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
	$masp = $_REQUEST["masp"];
	$conn=mysqli_connect("localhost","root","") or die ("Không connect đc với máy chủ");
    //Chọn CSDL để làm việc
    mysqli_select_db($conn,"qlshopdienthoai") or die ("Không tìm thấy CSDL");
    //Tạo câu truy vấn
    $sql_del_hangxs="DELETE FROM sanpham WHERE `sanpham`.`masp` = $masp";
	mysqli_query($conn,$sql_del_hangxs);
	header("Location: sanpham.php");
	?>
</body>
</html>