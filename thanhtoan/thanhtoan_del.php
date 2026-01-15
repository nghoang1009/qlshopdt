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

    $db = new DB();
    $conn = $db->getConnection() or die("Không thể kết nối database");
    $username = $_SESSION['username'];
    $sql_role = "SELECT role FROM taikhoan WHERE tentk = '$username'";
    $result_role = mysqli_query($conn, $sql_role);
    $row_role = mysqli_fetch_assoc($result_role);
    $role = $row_role['role'];

    if ($role != 1 && $role != 2) {
        echo "<script>alert('Bạn không có quyền!'); window.location.href='thanhtoan.php';</script>";
        exit();
    }

    $matt = $_REQUEST["matt"];
    $sql_del = "DELETE FROM thanhtoan WHERE matt = $matt";
    mysqli_query($conn, $sql_del);
    header("Location: thanhtoan.php");
    ?>
</body>
</html>