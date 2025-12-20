<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $manv = $_REQUEST["manv"];
        $conn=mysqli_connect("localhost","root","") or die ("Không connect đc với máy chủ");
        //Chọn CSDL để làm việc
        mysqli_select_db($conn,"qlshopdienthoai") or die ("Không tìm thấy CSDL");
        $sql_select = "Select * from `nhanvien` where `manv` = '$manv'";
        $result = mysqli_query($conn, $sql_select);
        $row = mysqli_fetch_object($result);

        $manv = $row->manv;
        $tennv = $row->tennv;
        $diachi = $row->diachi;
        $sdt = $row->sdt;
        $ns = $row->ns;
    ?>

    <form method="post" action="nhanvien_edit_save.php?manv= <?php echo $manv?>" enctype="multipart/form-data">        
        <form action="nhanvien_insert.php" method="post" enctype="multipart/form-data">
        <table border="1" align="center">
            <tr>
                <td colspan="2" align="center">Thêm nhân viên</td>
            </tr>
            <tr>
                <td>Tên nhân viên:</td>
                <td>
                    <input type="text" name="txt_tennv"
                    value="<?php echo $tennv ?>">
                </td>
            </tr>
            <tr>
                <td>Địa chỉ:</td>
                <td>
                    <input type="text" name="txt_diachi"
                    value="<?php echo $diachi ?>">
                </td>
            </tr>
            <tr>
                <td>Ngày sinh:</td>
                <td>
                    <input type="date" name="date_ns"
                    value="<?php echo $ns ?>">
                </td>
            </tr>
            <tr>
                <td>Số điện thoại:</td>
                <td>
                    <input type="text" name="txt_sdt"
                    value="<?php echo $sdt ?>">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                <input type="submit" value="OK">
                <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>