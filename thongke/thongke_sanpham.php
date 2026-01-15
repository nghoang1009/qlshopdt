<?php
require_once('../database.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

$db = new DB();
$conn = $db->getConnection() or die("Không thể kết nối database");

$thang = isset($_GET['thang']) ? $_GET['thang'] : date('m');
$nam = isset($_GET['nam']) ? $_GET['nam'] : date('Y');

$sql_tk = "SELECT 
            sp.masp, sp.tensp, sp.hang,
            SUM(ct.sl) as soluongban,
            SUM(ct.sl * sp.gia) as doanhthu
           FROM chitietdonhang ct
           JOIN sanpham sp ON ct.masp = sp.masp
           JOIN donhang dh ON ct.madh = dh.madh
           WHERE MONTH(dh.ngaydat) = $thang AND YEAR(dh.ngaydat) = $nam
           GROUP BY sp.masp, sp.tensp, sp.hang
           ORDER BY soluongban DESC";
$result_tk = mysqli_query($conn, $sql_tk);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thống kê sản phẩm bán chạy</title>
    <link rel="stylesheet" href="../css/nv.css">
</head>
<body>
    <h1 align="center">THỐNG KÊ SẢN PHẨM BÁN CHẠY</h1>
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
    <table width="1000" align="center" border="1">
        <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Hãng</th>
            <th>Số lượng bán</th>
            <th>Doanh thu</th>
        </tr>

        <?php 
        $stt = 0;
        $tongDoanhThu = 0;
        while($row = mysqli_fetch_assoc($result_tk)): 
            $stt++;
            $tongDoanhThu += $row['doanhthu'];
        ?>
        <tr align="center">
            <td><?php echo $stt; ?></td>
            <td><?php echo $row['tensp']; ?></td>
            <td><?php echo $row['hang']; ?></td>
            <td><?php echo $row['soluongban']; ?></td>
            <td><?php echo number_format($row['doanhthu'], 0, ',', '.'); ?> đ</td>
        </tr>
        <?php endwhile; ?>
        <tr>
            <th colspan="4" style="text-align:right;">Tổng doanh thu</th>
            <th>
                <?php echo number_format($tongDoanhThu, 0, ',', '.'); ?> đ
            </th>
        </tr>
    </table>
</body>
</html>