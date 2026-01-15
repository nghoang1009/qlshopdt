<?php
require_once('../database.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$db = new DB();
$conn = $db->getConnection() or die("Không thể kết nối database");

$sql_tk = "SELECT 
            kh.makh, kh.tenkh, kh.sdt,
            COUNT(dh.madh) as tongsodh,
            SUM(dh.trigia) as tongchitieu,
            MAX(dh.ngaydat) as lanmuagannhat
           FROM khachhang kh
           LEFT JOIN donhang dh ON kh.makh = dh.makh
           GROUP BY kh.makh, kh.tenkh, kh.sdt
           HAVING tongsodh > 0
           ORDER BY tongchitieu DESC";
$result_tk = mysqli_query($conn, $sql_tk);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê khách hàng</title>
    <link rel="stylesheet" href="../css/nv.css">
</head>
<body>
    <h1 align="center">THỐNG KÊ KHÁCH HÀNG</h1>
    <h2 align="center"><a href="../trangchu.php">TRANG CHỦ</a></h2>

    <table width="1200" align="center" border="1">
        <tr>
            <th>STT</th>
            <th>Tên khách hàng</th>
            <th>SĐT</th>
            <th>Tổng đơn hàng</th>
            <th>Tổng chi tiêu</th>
            <th>Lần mua gần nhất</th>
        </tr>

        <?php 
        $stt = 0;
        while($row = mysqli_fetch_assoc($result_tk)): 
            $stt++;
        ?>
        <tr align="center">
            <td><?php echo $stt; ?></td>
            <td><?php echo $row['tenkh']; ?></td>
            <td><?php echo $row['sdt']; ?></td>
            <td><?php echo $row['tongsodh']; ?></td>
            <td><?php echo number_format($row['tongchitieu'], 0, ',', '.'); ?> đ</td>
            <td><?php echo date('d/m/Y', strtotime($row['lanmuagannhat'])); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>