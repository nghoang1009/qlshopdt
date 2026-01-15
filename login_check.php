<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();

    require_once('database.php');
    $username = $_POST["txt_username"];
    $password = $_POST["txt_password"];

    $db = new DB();
    $conn = $db->getConnection() or die("Không thể kết nối database");
    mysqli_set_charset($conn, "utf8");

    // Dùng Prepared Statement chống SQL Injection
    $sql = "SELECT * FROM taikhoan WHERE tentk = ? AND mk = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Lưu username vào session
        $_SESSION['username'] = $username;
        
        header("Location: trangchu.php");
        exit();
    } else {
        echo "<h3 align='center' style='color:red;'>Sai tên đăng nhập hoặc mật khẩu!</h3>";
        echo "<p align='center'><a href='login.php'>Thử lại</a></p>";
    }

    mysqli_close($conn);
    ?>
</body>
</html>