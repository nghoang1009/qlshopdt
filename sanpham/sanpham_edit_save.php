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
    $masp = $_REQUEST['masp'];
    $tensp = $_REQUEST['txt_tensp'];
    $gia = $_REQUEST['num_gia'];
    $sl = $_REQUEST['num_sl'];
    $hang = $_REQUEST['txt_hang'];
    $baohanh = $_REQUEST['txt_baohanh'];
    $ghichu = $_REQUEST['txt_ghichu'];
    $madm = $_REQUEST['txt_madm'];

    $file_tmp = $_FILES['img_hinhanh']['tmp_name'];
    $file_name = $_FILES['img_hinhanh']['name'];

    $db = new DB();
    $conn = $db->getConnection() or die("Không thể kết nối database");

    if ($file_tmp == null)
        $sql_edit= "UPDATE `sanpham` SET `tensp` = '$tensp', `gia` = '$gia', `sl` = '$sl', `hang` = '$hang', `baohanh` = '$baohanh', `ghichu` = '$ghichu', `madm` = '$madm' WHERE `sanpham`.`masp` = $masp;";
    else {
        // Tìm và xóa ảnh
        $getImageSQL = "Select hinhanh from sanpham where masp = $masp";
        $result = mysqli_query($conn, $getImageSQL) or die("Lỗi khi tìm ảnh");
        $row = mysqli_fetch_assoc($result);
        $image = $row["hinhanh"];

        unlink("../img/" . $image) or die("Xóa ảnh $image không thành công");

        // Copy ảnh trong thư mục temp sang img
        $datetime = date("Y-m-d_H:i:s_");
        $file__name = $datetime . $file_name;
        copy($file_tmp, "../img/". $file__name);

        $sql_edit= "UPDATE `sanpham` SET `tensp` = '$tensp', `gia` = '$gia', `sl` = '$sl', `hang` = '$hang', `baohanh` = '$baohanh', `ghichu` = '$ghichu', `madm` = '$madm', `hinhanh` = '$file__name' WHERE `sanpham`.`masp` = $masp;";
    }

    mysqli_query($conn, $sql_edit) or die("Lỗi khi sửa sản phẩm $tensp");
    //header("Location: sanpham.php");
    ?>
</body>
</html>