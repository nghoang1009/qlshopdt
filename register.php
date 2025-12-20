<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
</head>
<body>
    <form action="register_check.php" method="POST">
        <table border="1" align="center">
            <tr>
                <td colspan="2" align="center"><h2>Đăng ký tài khoản</h2></td>
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
                <td>Nhập lại mật khẩu:</td>
                <td><input type="password" name="txt_repassword" required></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Đăng ký">
                </td>
            </tr>
        </table>
        <p align="center"><a href="login.php">Đã có tài khoản? Đăng nhập</a></p>
    </form>
</body>
</html>