<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nv.css">
    <title>Document</title>
</head>
<body>
    <h1 align = "center">THÔNG SỐ SẢN PHẨM</h1>
    <?php  
        $masp = $_REQUEST["masp"];
        $conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai");
        $sql_select = "Select * from `thongso` where masp='$masp'";
        $result = mysqli_query($conn,$sql_select);
        $tong_bg_ts=mysqli_num_rows($result);

        $row = mysqli_fetch_object($result);
        $mats = $row->mats;
        $tents = $row->tents;
        $giatri = $row->giatri;

        $sql_get_SP = "Select masp, tensp from sanpham";
        $result = mysqli_query($conn, $sql_get_SP);
        $tong_bg = mysqli_num_rows($result);

        $stt = 0;
        while ($row = mysqli_fetch_object($result)) {
            $stt++;
            $idsp[$stt] = $row->masp;
            $tensp[$stt] = $row->tensp;
        }
    ?>

    <form method="post" action="thongso_edit_save.php" enctype="multipart/form-data">        
        <table align="center" border="1">
            <tr>
                <td colspan="2" align="center">Thêm danh mục</td>
            </tr>
            <tr>
                <td>Tên thông số</td>
                <td>
                    <input type="text" name="txt_tents"
                    value="<?php echo $tents ?>">
                </td>
            </tr>

            <tr>
                <td>Tên sản phẩm</td>
                <td>
                <select name="masp">
                    <option value="0">--Chọn sản phẩm--</option>
                    <?php
                    for ($i=1; $i<=$tong_bg; $i++)
                    {
                    ?>
                        <option value="<?php echo $idsp[$i] ?>">
                            <?php echo $tensp[$i]?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </td>

            <tr>
                <td>Giá trị</td>
                <td>
                    <input type="text" name="txt_giatri"
                    value="<?php echo $giatri ?>">
                </td>
            </tr>
            
            <tr>
                <td colspan="2" align="center">
                <input type="submit" value="OK">
                <input type="reset" value="Reset">
                <input type="button" value="Quay lại" onclick="window.location.href='thongso.php'">
            </td>
            </tr>
        </table>
    </form>
</body>
</html>