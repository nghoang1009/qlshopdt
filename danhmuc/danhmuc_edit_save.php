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

    $conn=mysqli_connect("localhost","root","", "qlshopdienthoai") or die ("Không connect đc với máy chủ");

    $sql_edit= "UPDATE `danhmuc` SET `tendm` = '$tendm' WHERE `danhmuc`.`madm` = $madm;";

    mysqli_query($conn,$sql_edit) or die("Query unsucessful");
    header("Location: danhmuc.php");
    ?>
</body>
</html>