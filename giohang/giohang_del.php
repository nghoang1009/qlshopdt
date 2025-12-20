<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa sản phẩm khỏi giỏ hàng</title>
</head>
<body>
    <?php
    session_start();
    
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }
    
    $maitem = isset($_REQUEST["maitem"]) ? $_REQUEST["maitem"] : "";
    
    if (empty($maitem)) {
        echo "Không tìm thấy sản phẩm trong giỏ hàng";
        echo "<br><a href='giohang.php'>Quay lại</a>";
        exit();
    }
    
    $conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai") or die("Không thể kết nối CSDL");

    $sql_delete = "DELETE FROM giohang_item WHERE maitem = '$maitem'";
    mysqli_query($conn, $sql_delete);
    
    header("Location: giohang.php");
    ?>
</body>
</html>