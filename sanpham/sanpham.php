<?php 
session_start(); // THÊM DÒNG NÀY ĐỂ GIỎ HÀNG HOẠT ĐỘNG
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nv.css">
    <title>Sản phẩm</title>
</head>
<body>
    <h1 align = "center">QUẢN LÝ SẢN PHẨM</h1>
    <h2 align = "center"><a href="../trangchu.php">Trang chủ</a></h2>
    <?php  
        $conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai");
        $sql_select = "Select sp.masp, sp.tensp, sp.gia, sp.sl, sp.hang, sp.baohanh, sp.ghichu, sp.hinhanh, sp.madm, dm.tendm from sanpham sp
                        Join danhmuc dm
                        On sp.madm = dm.madm";
        $result = mysqli_query($conn,$sql_select);
        $tong_bg=mysqli_num_rows($result);

        $stt = 0;
        while($row = mysqli_fetch_object($result))
        {
            $stt++;
            $masp[$stt] = $row->masp;
            $tensp[$stt] = $row->tensp;
            $gia[$stt] = $row->gia;
            $sl[$stt] = $row->sl;
            $hang[$stt] = $row->hang;
            $baohanh[$stt] = $row->baohanh;
            $ghichu[$stt] = $row->ghichu;
            $hinhanh[$stt] = $row->hinhanh;
            $madm[$stt] = $row->madm;
            $tendm[$stt] = $row->tendm;
        }
    ?>

    <table width = 1300 align="center" border="1">
        <tr>
            <th>STT</th>
            <th width = 250>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Hãng</th>
            <th>Bảo hành</th>
            <th>Hình ảnh</th>
            <th>Ghi chú</th>
            <th>Danh mục</th>
            <th width = "180"><a href="sanpham_add.php">Thêm sản phẩm</a></th>
            <th>Thông số sản phẩm</th>
            <th>Thêm vào giỏ hàng</th>
        </tr>

        <?php
        for ($i=1; $i<=$tong_bg; $i++)
        {
        ?>
            <tr align="center">
                <td><?php echo $i; ?></td>
                <td><?php echo $tensp[$i] ?></td>
                <td><?php echo $gia[$i] ?></td>
                <td><?php echo $sl[$i] ?></td>
                <td><?php echo $hang[$i] ?></td>
                <td><?php echo $baohanh[$i] ?></td>
                <td> <img src="../img/<?php echo $hinhanh[$i]?>" width="50"> </td>
                <td><?php echo $ghichu[$i] ?></td>
                <td><?php echo $tendm[$i] ?></td>
                <td> 
                    <a href="sanpham_edit.php?masp=<?php echo $masp[$i] ?>">Sửa</a> |
                    <a href="sanpham_del.php?masp=<?php echo $masp[$i]; ?>" 
                       onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">Xóa</a>
                </td>
                <td>
                    <a href="../thongso/thongso.php?masp=<?php echo $masp[$i] ?>">Xem thông số</a>
                </td>
                <td>
                    <a href="../giohang/giohang_add.php?masp=<?php echo $masp[$i] ?>">Thêm vào giỏ hàng</a>
                </td>
            </tr>
        <?php
        }
	  ?>
      <tr>
      <td colspan="12" align="right">Bảng có <?php echo $tong_bg?> sản phẩm</td>
      </tr>
    </table>
</body>
</html>