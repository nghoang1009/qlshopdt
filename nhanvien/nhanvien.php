<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nv.css">
    <title>Document</title>
</head>
<body>
    <h1 align = "center">QUẢN LÝ NHÂN VIÊN</h1>
    <h2 align = "center"><a href="../trangchu.php">Trang chủ</a></h2>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai");
        $sql_select = "Select * from `nhanvien`";
        $result = mysqli_query($conn,$sql_select);
        $tong_bg=mysqli_num_rows($result);

        $stt = 0;
        while($row = mysqli_fetch_object($result))
        {
            $stt++;
            $manv[$stt] = $row->manv;
            $tennv[$stt] = $row->tennv;
            $diachi[$stt] = $row->diachi;
            $sdt[$stt] = $row->sdt;
            $ns[$stt] = $row->ns;
        }
    ?>

    <table width = 1300 align="center" border="1">
        <tr>
            <th>STT</th>
            <th width = 250>Tên nhân viên</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Ngày sinh</th>
            <th><a href="nhanvien_add.php">Thêm nhân viên</a></th>
        </tr>

        <?php
        for ($i=1; $i<=$tong_bg; $i++)
        {
        ?>
            <tr align="center">
                <td><?php echo $i; ?></td>
                <td><?php echo $tennv[$i] ?></td>
                <td><?php echo $diachi[$i] ?></td>
                <td><?php echo $sdt[$i] ?></td>
                <td><?php echo $ns[$i] ?></td>
                <td> 
                    <a href="nhanvien_edit.php?manv=<?php echo $manv[$i] ?>">Sửa</a> |
                    <a href="nhanvien_del.php?manv=<?php echo $manv[$i] ?>">Xóa</a>
                </td>
            </tr>
        <?php
        }
	  ?>
      <tr>
      <td colspan="10" align="right">Bảng có <?php echo $tong_bg?> nhân viên</td>
      </tr>
    </table>
</body>
</html>