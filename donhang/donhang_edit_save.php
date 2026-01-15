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
    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: ../login.php");
        exit();
    }

    $username = $_SESSION['username'];
    $db = new DB();
    $conn = $db->getConnection() or die("Không thể kết nối database");
    mysqli_set_charset($conn, "utf8");

    $sql_get_role = "SELECT role FROM taikhoan WHERE tentk = '$username'";
    $result_role = mysqli_query($conn, $sql_get_role);
    $row_role = mysqli_fetch_object($result_role);

    if ($row_role->role == '0') {
        echo "<p align='center'>Bạn không có quyền thực hiện thao tác này!</p>";
        echo "<p align='center'><a href='donhang.php'>Quay lại</a></p>";
        exit();
    }

    $madh = isset($_POST['madh']) ? $_POST['madh'] : "";
    $ngaydat = isset($_POST['ngaydat']) ? $_POST['ngaydat'] : "";
    $manv = isset($_POST['manv']) ? $_POST['manv'] : "";
    $trigia = isset($_POST['trigia']) ? $_POST['trigia'] : 0;

    if (empty($madh) || empty($ngaydat) || empty($manv)) {
        echo "<p align='center'>Vui lòng điền đầy đủ thông tin!</p>";
        echo "<p align='center'><a href='donhang_edit.php?madh=$madh'>Quay lại</a></p>";
        exit();
    }

    $sql_update = "UPDATE donhang 
                SET ngaydat = '$ngaydat', 
                    manv = '$manv', 
                    trigia = '$trigia' 
                WHERE madh = '$madh'";

    if (mysqli_query($conn, $sql_update)) {
        echo "<p align='center'>Cập nhật đơn hàng thành công!</p>";
        echo "<p align='center'><a href='donhang_chitiet.php?madh=$madh'>Xem chi tiết</a> | <a href='donhang.php'>Danh sách đơn hàng</a></p>";
    } else {
        echo "<p align='center'>Lỗi: " . mysqli_error($conn) . "</p>";
        echo "<p align='center'><a href='donhang_edit.php?madh=$madh'>Thử lại</a></p>";
    }

    mysqli_close($conn);
    ?>
</body>
</html>