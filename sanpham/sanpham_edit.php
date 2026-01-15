<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nv.css">
    <title>Document</title>
</head>
<body>
    <h1 align = "center">SỬA SẢN PHẨM</h1>
    <?php
        require_once('../database.php');
        $masp = $_REQUEST["masp"];
        $db = new DB();
        $conn = $db->getConnection() or die("Không thể kết nối database");
        $sql_select = "Select * from `sanpham` where `masp` = '$masp'";
        $result = mysqli_query($conn, $sql_select);
        $row = mysqli_fetch_object($result);

        $masp = $row->masp;
        $tensp = $row->tensp;
        $gia = $row->gia;
        $sl = $row->sl;
        $hang = $row->hang;
        $baohanh = $row->baohanh;
        $ghichu = $row->ghichu;
        $hinhanh = $row->hinhanh;
        $madm = $row->madm;

        $sql_get_dm = "Select madm, tendm from danhmuc";
        $result = mysqli_query($conn, $sql_get_dm);
        $tong_bg = mysqli_num_rows($result);

        $stt = 0;
        while ($row = mysqli_fetch_object($result)) {
            $stt++;
            $iddm[$stt] = $row->madm;
            $tendm[$stt] = $row->tendm;
        }
    ?>

    <form method="post" action="sanpham_edit_save.php?masp= <?php echo $masp ?>" enctype="multipart/form-data">        
        <table align="center" border="1">
            <tr>
                <td colspan="2" align="center">Thông tin sản phẩm</td>
            </tr>
            <tr>
                <td>Danh mục</td>
                <td>
                <select name="txt_madm">
                    <option value="0">--Chọn danh mục--</option>
                    <?php
                    for ($i=1; $i<=$tong_bg; $i++)
                    {
                    ?>
                        <option value="<?php echo $iddm[$i] ?>">
                            <?php echo $tendm[$i]?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </td>
            </tr>
            <tr>
                <td>Tên sản phẩm</td>
                <td>
                    <input type="text" name="txt_tensp"
                    value="<?php echo $tensp ?>">
                </td>
            </tr>
            <tr>
                <td>Giá</td>
                <td>
                    <input type="number" name="num_gia"
                    value="<?php echo $gia ?>">
                </td>
            </tr>
            <tr>
                <td>Số lượng</td>
                <td>
                    <input type="number" name="num_sl"
                    value="<?php echo $sl ?>">
                </td>
            </tr>
            <tr>
                <td>Hãng</td>
                <td>
                    <input type="text" name="txt_hang"
                    value="<?php echo $hang ?>">
                </td>
            </tr>
            <tr>
                <td>Bảo hành</td>
                <td>
                    <input type="text" name="txt_baohanh"
                    value="<?php echo $baohanh ?>">
                </td>
            </tr>
            <tr>
                <td>Hình ảnh</td>
                <td>
                    <input type="file" name="img_hinhanh">
                    <img src="../img/<?php echo $hinhanh ?>" width="100">
                </td>
            </tr>
            <tr>
                <td>Ghi chú</td>
                <td>
                    <input type="text" name="txt_ghichu"
                    value="<?php echo $ghichu ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                <input type="submit" value="OK">
                <input type="reset" value="Reset">
                <input type="button" value="Quay lại" onclick="window.location.href='sanpham.php'">
            </td>
            </tr>
        </table>
    </form>
</body>
</html>