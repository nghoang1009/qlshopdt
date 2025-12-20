<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nv.css">
    <title>Sản phẩm</title>
</head>
<body>
    <h1 align = "center">THÔNG SỐ SẢN PHẨM</h1>
    <h2 align = "center"><a href="../trangchu.php">Trang chủ</a></h2>
    <?php  
        $masp = $_REQUEST["masp"];
        $conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai");
        $sql_select = "Select * from `thongso` where masp='$masp'";
        $result = mysqli_query($conn,$sql_select);
        $tong_bg_ts=mysqli_num_rows($result);

        $stt = 0;
        while($row = mysqli_fetch_object($result))
        {
            $stt++;
            $mats[$stt] = $row->mats;
            $tents[$stt] = $row->tents;
            $giatri[$stt] = $row->giatri;
        }
    ?>

    <table width = 1300 align="center" border="1">
        <tr>
            <th>STT</th>
            <th width = 250>Tên thông số</th>
            <th>Mã sản phẩm</th>
            <th>Giá trị</th>
            <th width = 180><a href="thongso_add.php" width = 100>Thêm thông số</a></th>
        </tr>

        <?php
        for ($i=1; $i<=$tong_bg_ts; $i++)
        {
        ?>
            <tr align="center">
                <td><?php echo $i; ?></td>
                <td><?php echo $tents[$i] ?></td>
                <td><?php echo $masp ?></td>
                <td><?php echo $giatri[$i] ?></td>
                <td> 
                    <a href="thongso_edit.php?mats=<?php echo $mats[$i] ?>&masp=<?php echo $masp ?>">Sửa</a> |
                    <a href="thongso_del.php?mats=<?php echo $mats[$i] ?>&masp=<?php echo $masp ?>">Xóa</a>
                </td>
            </tr>
        <?php
        }
	  ?>
      <tr>
      <td colspan="10" align="right">Bảng có <?php echo $tong_bg_ts?> thông số</td>
      </tr>
    </table>
</body>
</html>