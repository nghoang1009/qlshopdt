<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $username = $_POST["txt_username"];
    $password = $_POST["txt_password"];
    $repassword = $_POST["txt_repassword"];

    // Kiểm tra mật khẩu khớp nhau
    if ($password != $repassword) {
        echo "<h3 align='center' style='color:red;'>Mật khẩu không khớp!</h3>";
        echo "<p align='center'><a href='register.php'>Thử lại</a></p>";
        exit();
    }

    $conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai");
    mysqli_set_charset($conn, "utf8");

    // Kiểm tra tài khoản đã tồn tại chưa
    $sql_check = "SELECT * FROM taikhoan WHERE tentk = ?";
    $stmt = mysqli_prepare($conn, $sql_check);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "<h3 align='center' style='color:red;'>Tên đăng nhập đã tồn tại!</h3>";
        echo "<p align='center'><a href='register.php'>Thử lại</a></p>";
    } else {
        // Thêm tài khoản mới
        $sql_create_tk = "INSERT INTO taikhoan VALUES (null, '$username', '$password', '0')";
        mysqli_query($conn, $sql_create_tk);
        $result = mysqli_query($conn, "Select LAST_INSERT_ID()");

        $id = -1;
        if ($result)
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['LAST_INSERT_ID()'];
        }
        if ($id == -1) die ("KO co id");
        $sql_insert = "INSERT INTO `khachhang` (`makh`, `tenkh`, `diachi`, `sdt`) 
                    VALUES ('$id', '$username', null, null);";


    mysqli_query($conn, $sql_insert);
        
        if ($result) {
            echo "<h3 align='center' style='color:green;'>Đăng ký thành công!</h3>";
            echo "<p align='center'><a href='login.php'>Đăng nhập ngay</a></p>";
        } else {
            echo "<h3 align='center' style='color:red;'>Đăng ký thất bại!</h3>";
            echo "<p align='center'><a href='register.php'>Thử lại</a></p>";
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>