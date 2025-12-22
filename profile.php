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

// Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai") or die("Không thể kết nối CSDL");

// Lấy thông tin tài khoản
$sql = "SELECT * FROM taikhoan WHERE tentk = '$username'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$matk = $user['matk'];
$role = $user['role'];

// Xác định chức vụ
$chucvu = '';
switch ($role) {
    case '1':
        $chucvu = 'Admin';
        break;
    case '2':
        $chucvu = 'Nhân viên';
        break;
    case '0':
        $chucvu = 'Khách hàng';
        break;
}

// Lấy thông tin chi tiết theo role
$thongtin = null;
if ($role == '0') {
    // Khách hàng
    $sql_kh = "SELECT * FROM khachhang WHERE makh = '$matk'";
    $result_kh = mysqli_query($conn, $sql_kh);
    $thongtin = mysqli_fetch_assoc($result_kh);
} elseif ($role == '2' || $role == '1') {
    // Nhân viên hoặc Admin
    $sql_nv = "SELECT * FROM nhanvien WHERE manv = '$matk'";
    $result_nv = mysqli_query($conn, $sql_nv);
    $thongtin = mysqli_fetch_assoc($result_nv);
}

// Xử lý cập nhật thông tin
$message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($role == '0') {
        // Cập nhật khách hàng
        $tenkh = $_POST['tenkh'];
        $diachi = $_POST['diachi'];
        $sdt = $_POST['sdt'];
        
        $sql_update = "UPDATE khachhang SET tenkh='$tenkh', diachi='$diachi', sdt='$sdt' WHERE makh='$matk'";
        mysqli_query($conn, $sql_update);
        
        // Cập nhật tên tài khoản
        $sql_update_tk = "UPDATE taikhoan SET tentk='$tenkh' WHERE matk='$matk'";
        mysqli_query($conn, $sql_update_tk);
        $_SESSION['username'] = $tenkh;
    } else {
        // Cập nhật nhân viên
        $tennv = $_POST['tennv'];
        $diachi = $_POST['diachi'];
        $sdt = $_POST['sdt'];
        $ns = $_POST['ns'];
        
        $sql_update = "UPDATE nhanvien SET tennv='$tennv', diachi='$diachi', sdt='$sdt', ns='$ns' WHERE manv='$matk'";
        mysqli_query($conn, $sql_update);
        
        // Cập nhật tên tài khoản
        $sql_update_tk = "UPDATE taikhoan SET tentk='$tennv' WHERE matk='$matk'";
        mysqli_query($conn, $sql_update_tk);
        $_SESSION['username'] = $tennv;
    }
    
    // Cập nhật mật khẩu nếu có
    if (!empty($new_password)) {
        if ($new_password === $confirm_password) {
            $sql_password = "UPDATE taikhoan SET mk='$new_password' WHERE matk='$matk'";
            mysqli_query($conn, $sql_password);
            $message = "Cập nhật thông tin và mật khẩu thành công!";
        } else {
            $message = "Mật khẩu xác nhận không khớp!";
        }
    } else {
        $message = "Cập nhật thông tin thành công!";
    }
    
    // Refresh thông tin
    header("Location: profile.php?msg=" . urlencode($message));
    exit();
}

if (isset($_GET['msg'])) {
    $message = $_GET['msg'];
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="stylesheet" href="css/nv.css">
</head>
<body>

<h1 align="center">THÔNG TIN CÁ NHÂN</h1>
<h2 align="center"><a href="trangchu.php">Trang chủ</a></h2>

<?php if (!empty($message)): ?>
    <div align="center" style="background: #d4edda; color: #155724; padding: 12px; margin: 20px auto; max-width: 600px; border-radius: 4px;">
        <?php echo ($message); ?>
    </div>
<?php endif; ?>

<form method="POST" action="profile.php">
    <table border="1" align="center">
        <tr>
            <td colspan="2" align="center">Thông tin tài khoản</td>
        </tr>
        <tr>
            <td>Tên tài khoản:</td>
            <td><strong><?php echo ($username); ?></strong></td>
        </tr>
        <tr>
            <td>Chức vụ:</td>
            <td><strong><?php echo $chucvu; ?></strong></td>
        </tr>
        
        <?php if ($role == '0'): // Khách hàng ?>
            <tr>
                <td colspan="2" align="center"><strong>Thông tin khách hàng</strong></td>
            </tr>
            <tr>
                <td>Tên khách hàng:</td>
                <td>
                    <input type="text" name="tenkh" value="<?php echo ($thongtin['tenkh'] ?? ''); ?>" required>
                </td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td>
                    <input type="text" name="diachi" value="<?php echo ($thongtin['diachi'] ?? ''); ?>">
                </td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td>
                    <input type="text" name="sdt" value="<?php echo ($thongtin['sdt'] ?? ''); ?>">
                </td>
            </tr>
        <?php else: // Nhân viên hoặc Admin ?>
            <tr>
                <td colspan="2" align="center"><strong>Thông tin cá nhân</strong></td>
            </tr>
            <tr>
                <td>Tên nhân viên:</td>
                <td>
                    <input type="text" name="tennv" value="<?php echo ($thongtin['tennv'] ?? ''); ?>" required>
                </td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td>
                    <input type="text" name="diachi" value="<?php echo ($thongtin['diachi'] ?? ''); ?>">
                </td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td>
                    <input type="text" name="sdt" value="<?php echo ($thongtin['sdt'] ?? ''); ?>">
                </td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td>
                    <input type="date" name="ns" value="<?php echo ($thongtin['ns'] ?? ''); ?>">
                </td>
            </tr>
        <?php endif; ?>
        
        <tr>
            <td colspan="2" align="center"><strong>Đổi mật khẩu</strong></td>
        </tr>
        <tr>
            <td>Mật khẩu mới:</td>
            <td>
                <input type="password" name="new_password" placeholder="Để trống nếu không đổi">
            </td>
        </tr>
        <tr>
            <td>Xác nhận mật khẩu:</td>
            <td>
                <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu mới">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="update_profile" value="Cập nhật">
                <input type="button" value="Quay lại" onclick="window.location.href='trangchu.php'">
            </td>
        </tr>
    </table>
</form>

</body>
</html>
</body>
</html>