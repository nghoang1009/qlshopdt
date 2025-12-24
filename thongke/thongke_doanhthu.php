<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai");
$username = $_SESSION['username'];
$sql_role = "SELECT role FROM taikhoan WHERE tentk = '$username'";
$result_role = mysqli_query($conn, $sql_role);
$row_role = mysqli_fetch_assoc($result_role);
$role = $row_role['role'];

$isAdmin = ($role == 1);

// Xử lý lọc theo tháng/năm
$thang = isset($_GET['thang']) ? $_GET['thang'] : date('m');
$nam = isset($_GET['nam']) ? $_GET['nam'] : date('Y');

// Thống kê từ bảng donhang
$sql_tk = "SELECT 
            DATE(dh.ngaydat) as ngay,
            COUNT(DISTINCT dh.madh) as tongsodh,
            SUM(dh.trigia) as tongdoanhthu,
            COUNT(DISTINCT dh.makh) as tongkhachhang
           FROM donhang dh
           WHERE MONTH(dh.ngaydat) = $thang AND YEAR(dh.ngaydat) = $nam
           GROUP BY DATE(dh.ngaydat)
           ORDER BY ngay DESC";
$result_tk = mysqli_query($conn, $sql_tk);

// Tổng tháng
$sql_tong = "SELECT 
              COUNT(DISTINCT madh) as tong_dh,
              SUM(trigia) as tong_dt,
              COUNT(DISTINCT makh) as tong_kh
             FROM donhang
             WHERE MONTH(ngaydat) = $thang AND YEAR(ngaydat) = $nam";
$result_tong = mysqli_query($conn, $sql_tong);
$row_tong = mysqli_fetch_assoc($result_tong);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê doanh thu</title>
    <link rel="stylesheet" href="../css/nv.css">
</head>
<body>
    <h1 align="center">THỐNG KÊ DOANH THU</h1>
    <h2 align="center"><a href="../trangchu.php">TRANG CHỦ</a></h2>

    <form method="GET" align="center">
        <label>Tháng:</label>
        <select name="thang" style="width: 10cm">
            <?php for($i=1; $i<=12; $i++): ?>
                <option value="<?php echo $i; ?>" <?php if($i==$thang) echo 'selected'; ?>>
                    Tháng <?php echo $i; ?>
                </option>
            <?php endfor; ?>
        </select>
        
        <label>Năm:</label>
        <select name="nam" style="width: 10cm">
            <?php for($y=2020; $y<=date('Y'); $y++): ?>
                <option value="<?php echo $y; ?>" <?php if($y==$nam) echo 'selected'; ?>>
                    <?php echo $y; ?>
                </option>
            <?php endfor; ?>
        </select>
        
        <input type="submit" value="Lọc">
    </form>

    <br>
    <table width="1200" align="center" border="1">
        <tr style="background-color: #f0f0f0;">
            <th colspan="4">
                Tổng tháng <?php echo $thang; ?>/<?php echo $nam; ?>: 
                <?php echo $row_tong['tong_dh']; ?> đơn - 
                <?php echo number_format($row_tong['tong_dt'], 0, ',', '.'); ?> đ - 
                <?php echo $row_tong['tong_kh']; ?> khách hàng
            </th>
        </tr>
        <tr>
            <th>Ngày</th>
            <th>Số đơn hàng</th>
            <th>Doanh thu</th>
            <th>Số khách hàng</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result_tk)): ?>
        <tr align="center">
            <td><?php echo date('d/m/Y', strtotime($row['ngay'])); ?></td>
            <td><?php echo $row['tongsodh']; ?></td>
            <td><?php echo number_format($row['tongdoanhthu'], 0, ',', '.'); ?> đ</td>
            <td><?php echo $row['tongkhachhang']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>