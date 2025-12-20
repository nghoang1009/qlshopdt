<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $manv = $_REQUEST["manv"];
    $tennv = $_REQUEST["txt_tennv"];
    $diachi = $_REQUEST["txt_diachi"];
    $sdt = $_REQUEST["txt_sdt"];
    $ns = $_REQUEST["date_ns"];

    $conn=mysqli_connect("localhost","root","", "qlshopdienthoai") or die ("Không connect đc với máy chủ");

    $sql_edit= "UPDATE `nhanvien` SET `tennv` = '$tennv', `diachi` = '$diachi', `sdt` = '$sdt', `ns` = '$ns' 
                                  WHERE `nhanvien`.`manv` = $manv;";

    mysqli_query($conn,$sql_edit) or die("Query unsucessful");
    header("Location: nhanvien.php");
    ?>    
</body>
</html>