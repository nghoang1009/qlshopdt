<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/avt.css">
    <link rel="stylesheet" href="css/giohang.css">
    <link rel="stylesheet" href="css/sp.css">
</head>
<body>

<?php
  if (isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $sql = "Select * from taikhoan Where tentk = '$username'";
    $conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai") or die ("Khong the ket noi CSDL");
    $result = mysqli_query($conn, $sql);

    $role = -1;
    if ($result)
        while ($row = mysqli_fetch_assoc($result)) {
            $role = $row['role'];
    }

    $chucvu = '';
    // if ($role == -1) die("Ko lay dc role");
    switch ($role){
      case '1':
        $chucvu = 'Admin';
        break;
      case '2':
        $chucvu = 'Nhân viên';
        break;
      case '0':
        $chucvu = 'Khách hàng';
        break;
    }
  }
?>

<header class="main-header">
  <div class="container">
    
    <div class="header-top">
      <div class="logo">
        <strong style="font-size: 24px; color:white">TRANG CHỦ</strong>
      </div>

      <div class="search-box">
        <input type="text" placeholder="Tìm kiếm sản phẩm...">
        <button><i class="fa fa-search"></i></button>
      </div>

      <div class="user-actions">
        <?php if(isset($_SESSION['username'])): ?>
          <div class="user-avatar">
            <div class="avatar-circle">
              <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
            </div>
            <div class="user-dropdown">
              <div class="user-info">
                <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                <span><?php echo $chucvu ?></span>
              </div>
              <a href="profile.php">Thông tin cá nhân</a>
              <a href="orders.php">Đơn hàng của tôi</a>
              <a href="settings.php">Cài đặt</a>
              <a href="logout.php" class="logout">Đăng xuất</a>
            </div>
          </div>
        <?php else: ?>
          <a href="login.php" class="btn-user">
            <i class="fa fa-user"></i>
            <span>Đăng nhập</span>
          </a>
          <a href="register.php" class="btn-user">
            <i class="fa fa-key"></i>
            <span>Đăng ký</span>
          </a>
        <?php endif; ?>
      </div>
    </div>

    <nav class="header-bottom">
      <ul class="nav-menu">
        <li><a href="sanpham/sanpham.php"><i class="fa fa-mobile-screen"></i> Điện thoại</a></li>
        <li><a href="danhmuc/danhmuc.php"><i class="fa fa-tablet-screen-button"></i> Danh mục</a></li>
        <li><a href="nhanvien/nhanvien.php"><i class="fa fa-laptop"></i> Nhân viên</a></li>
        <li><a href="#"><i class="fa fa-tv"></i> Giao hàng</a></li>
        <li><a href="khachhang/khachhang.php"><i class="fa fa-headphones"></i> Khách hàng</a></li>
        <li><a href="#"><i class="fa fa-clock"></i> Đồng hồ</a></li>
        <li><a href="#"><i class="fa fa-wrench"></i> Giỏ hàng</a></li>
      </ul>
    </nav>

  </div>
</header>

<!-- Nút giỏ hàng float -->
<div class="cart-float">
  <a href="./giohang/giohang.php">
    <i class="fa fa-shopping-cart"></i>
    <span class="cart-count">0</span>
  </a>
</div>

<div class="product-section">
  <div class="container">
      <h2 class="section-title">SẢN PHẨM NỔI BẬT</h2>
      
      <div class="product-grid">
          <?php
          $conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai");
          $sql = "SELECT * FROM sanpham ORDER BY masp DESC LIMIT 12";
          $result = mysqli_query($conn, $sql);
          
          if ($result && mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)) {
                  $masp = $row['masp'];
                  $tensp = $row['tensp'];
                  $gia = number_format($row['gia'], 0, ',', '.');
                  $hinhanh = isset($row['hinhanh']) && !empty($row['hinhanh']) 
                            ? 'img/' . $row['hinhanh'] 
                            : 'img/default.jpg';
          ?>
              <div class="product-card">
                  <div class="product-badge">Hot</div>
                  <div class="product-image-wrapper">
                      <img src="<?php echo $hinhanh; ?>" alt="<?php echo $tensp; ?>" class="product-image">
                  </div>
                  <div class="product-info">
                      <div class="product-name"><?php echo $tensp; ?></div>
                      <div class="product-price"><?php echo $gia; ?>đ</div>
                      <a href="thongso/thongso.php?masp=<?php echo $masp; ?>" class="product-btn">Xem chi tiết</a>
                  </div>
              </div>
          <?php
              }
          } else {
              echo '<p style="text-align:center; width:100%; padding:20px;">Chưa có sản phẩm nào!</p>';
          }
          mysqli_close($conn);
          ?>
      </div>
  </div>
</div>
</body>
</html>