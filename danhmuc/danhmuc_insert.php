<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $madm = $_REQUEST["madm"];
        $tendm = $_REQUEST["txt_tendm"];

        $conn = mysqli_connect("localhost", "root", "") or die ("Khong the ket noi CSDL");
        mysqli_select_db($conn, "qlshopdienthoai");

        $sql_insert = "INSERT INTO `danhmuc` (`madm`, `tendm`) VALUES (NULL, '$tendm');";

        mysqli_query($conn, $sql_insert);
        header("Location: danhmuc.php");
    ?>
</body>
</html>