<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/nv.css">
    <title>Đăng nhập</title>
</head>
<body>
    <form action="login_check.php" method="POST">
        <table border="1" align="center">
            <tr>
                <td colspan="2" align="center"><h2>Đăng nhập</h2></td>
            </tr>
            <tr>
                <td>Tên đăng nhập:</td>
                <td><input type="text" name="txt_username" required></td>
            </tr>
            <tr>
                <td>Mật khẩu:</td>
                <td><input type="password" name="txt_password" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Đăng nhập">
                </td>
            </tr>
        </table>
        <p align="center"><a href="register.php">Đăng ký tài khoản</a></p>
    </form>
</body>
</html>