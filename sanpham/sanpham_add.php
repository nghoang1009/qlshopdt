<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nv.css">
    <title>Thêm sản phẩm</title>
</head>
<body>
    <h1 align = "center">THÊM SẢN PHẨM</h1>
    <?php
        require_once('../database.php');
        $db = new DB();
        $conn = $db->getConnection() or die("Không thể kết nối database");

        $sql_select_dm = "Select * from `danhmuc`";
        $result_dm = mysqli_query($conn,$sql_select_dm);
        $tong_dm = mysqli_num_rows($result_dm);

        $stt_dm = 0;
        while($row = mysqli_fetch_object($result_dm))
        {
            $stt_dm++;
            $madm[$stt_dm] = $row->madm;
            $tendm[$stt_dm] = $row->tendm;
        }
    ?>

    <form action="sanpham_insert.php" method="post" enctype="multipart/form-data">
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
                    for ($i=1; $i<=$tong_dm; $i++)
                    {
                    ?>
                        <option value="<?php echo $madm[$i] ?>">
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
                    <input type="text" name="txt_tensp">
                </td>
            </tr>
            <tr>
                <td>Giá</td>
                <td>
                    <input type="number" name="num_gia">
                </td>
            </tr>
            <tr>
                <td>Số lượng</td>
                <td>
                    <input type="number" name="num_sl">
                </td>
            </tr>
            <tr>
                <td>Hãng</td>
                <td>
                    <input type="text" name="txt_hang">
                </td>
            </tr>
            <tr>
                <td>Bảo hành</td>
                <td>
                    <input type="text" name="txt_baohanh">
                </td>
            </tr>
            <tr>
                <td>Hình ảnh</td>
                <td>
                    <input type="file" name="img_hinhanh">
                </td>
            </tr>
            <tr>
                <td>Ghi chú</td>
                <td>
                    <input type="text" name="txt_ghichu">
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