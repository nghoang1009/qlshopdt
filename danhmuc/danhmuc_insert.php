<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once('../database.php');
        $madm = $_REQUEST["madm"];
        $tendm = $_REQUEST["txt_tendm"];

        $db = new DB();
        $conn = $db->getConnection() or die("Không thể kết nối database");
        mysqli_select_db($conn, "qlshopdienthoai");

        $sql_insert = "INSERT INTO `danhmuc` (`madm`, `tendm`) VALUES (NULL, '$tendm');";

        mysqli_query($conn, $sql_insert);
        header("Location: danhmuc.php");
    ?>
</body>
</html>