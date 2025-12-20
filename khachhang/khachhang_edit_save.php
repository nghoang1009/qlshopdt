<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $makh = $_REQUEST["makh"];
    $tenkh = $_REQUEST["txt_tenkh"];
    $diachi = $_REQUEST["txt_diachi"];
    $sdt = $_REQUEST["txt_sdt"];

    $conn=mysqli_connect("localhost","root","", "qlshopdienthoai") or die ("Không connect đc với máy chủ");

    $sql_edit= "UPDATE `khachhang` SET `tenkh` = '$tenkh', `diachi` = '$diachi', `sdt` = '$sdt' 
                                  WHERE `khachhang`.`makh` = $makh;";

    mysqli_query($conn,$sql_edit) or die("Query unsucessful");
    header("Location: khachhang.php");
    ?>    
</body>
</html>