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

    $conn = mysqli_connect("localhost", "root", "") or die ("Khong the ket noi CSDL");
    mysqli_select_db($conn, "qlshopdienthoai");

    $sql_create_tk = "INSERT INTO taikhoan VALUES (null, '$tennv', '123456', '2')";
    mysqli_query($conn, $sql_create_tk);
    $result = mysqli_query($conn, "Select LAST_INSERT_ID()");

    $id = -1;
    if ($result)
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['LAST_INSERT_ID()'];
    }

    if ($id == -1) die ("KO co id");
    $sql_insert = "INSERT INTO `nhanvien` (`manv`, `tennv`, `diachi`, `sdt`, `ns`) 
                   VALUES ('$id', '$tennv', '$diachi', '$sdt', '$ns');";

    mysqli_query($conn, $sql_insert);
    header("Location: nhanvien.php");
    ?>
</body>
</html>