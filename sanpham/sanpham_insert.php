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
        $tensp = $_REQUEST["txt_tensp"];
        $gia = $_REQUEST["num_gia"];
        $sl = $_REQUEST["num_sl"];
        $hang = $_REQUEST["txt_hang"];
        $baohanh = $_REQUEST["txt_baohanh"];
        $ghichu = $_REQUEST["txt_ghichu"];
        $madm = $_REQUEST["txt_madm"];

        $uploadDir_img_hinhanh = "../img/";
        $file_tmp = isset($_FILES['img_hinhanh']['tmp_name']) ? $_FILES['img_hinhanh']['tmp_name'] : ""; 
        $file_name = isset($_FILES['img_hinhanh']['name']) ? $_FILES['img_hinhanh']['name'] : ""; 

        $datetime = date("Y-m-d_H:i:s_");
        $file__name = $datetime . $file_name;
        copy($file_tmp, $uploadDir_img_hinhanh.$file__name);

        $db = new DB();
        $conn = $db->getConnection() or die("Không thể kết nối database");

        $sql_insert = "INSERT INTO `sanpham` (`masp`, `tensp`, `gia`, `sl`, `hang`, `baohanh`, `ghichu`, `hinhanh`, `madm`) 
                       VALUES (NULL, '$tensp', '$gia', '$sl', '$hang', '$baohanh', '$ghichu', '$file__name__', '$madm');";

        mysqli_query($conn, $sql_insert);
        header("Location: sanpham.php");
    ?>
</body>
</html>