<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once('../database.php');
    $masp = $_REQUEST["masp"];
    $tensp = $_REQUEST["txt_tensp"];
    $gia = $_REQUEST["num_gia"];
    $sl = $_REQUEST["num_sl"];
    $hang = $_REQUEST["txt_hang"];
    $baohanh = $_REQUEST["txt_baohanh"];
    $ghichu = $_REQUEST["txt_ghichu"];
    $madm = $_REQUEST["txt_madm"];

    $db = new DB();
    $conn = $db->getConnection() or die("Không thể kết nối database");

    $sql_edit= "UPDATE `sanpham` SET `tensp` = '$tensp', `gia` = '$gia', `sl` = '$sl', `hang` = '$hang', `baohanh` = '$baohanh', `ghichu` = '$ghichu', `madm` = '$madm' WHERE `sanpham`.`masp` = $masp;";

    mysqli_query($conn, $sql_edit) or die("Query unsucessful");
    header("Location: sanpham.php");
    ?>
</body>
</html>