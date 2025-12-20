<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $mats = $_REQUEST["mats"];
        $tents = $_REQUEST["txt_tents"];
        $masp = $_REQUEST["masp"];
        $giatri = $_REQUEST["txt_giatri"];

        $conn = mysqli_connect("localhost", "root", "") or die ("Khong the ket noi CSDL");
        mysqli_select_db($conn, "qlshopdienthoai");

        $sql_insert = "INSERT INTO `thongso` (`mats`, `tents`, `masp`, `giatri`) 
                       VALUES (NULL, '$tents', '$masp', '$giatri');";

        mysqli_query($conn, $sql_insert);
        header("Location: thongso.php?masp=$masp");
    ?>
</body>
</html>