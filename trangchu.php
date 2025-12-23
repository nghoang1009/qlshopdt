<?php
session_start();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <form method="GET" action="trangchu.php" style="display: flex; width: 100%;">
          <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." 
                 value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
          <button type="submit"><i class="fa fa-search"></i></button>
        </form>
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
              <a href="donhang/donhang.php">Đơn hàng của tôi</a>
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
        <li><a href="sanpham/sanpham.php"><i class="fa fa-mobile" aria-hidden="true"></i> Điện thoại</a></li>
        <li><a href="danhmuc/danhmuc.php"><i class="fa fa-tablet-screen-button"></i> Danh mục</a></li>
        <li><a href="nhanvien/nhanvien.php"><i class="fa fa-laptop"></i> Nhân viên</a></li>
        <li><a href="khachhang/khachhang.php"><i class="fa fa-headphones"></i> Khách hàng</a></li>
        <li><a href="donhang/donhang.php"><i class="fa fa-headphones"></i> Đơn hàng</a></li>
        <li><a href="vanchuyen/vanchuyen.php"><i class="fa fa-truck"></i> Giao hàng</a></li>
        <li><a href="giohang/giohang.php"><i class="fa fa-wrench"></i> Giỏ hàng</a></li>
      </ul>
    </nav>

  </div>
</header>

<!-- Nút giỏ hàng float -->
<div class="cart-float">
  <a href="./giohang/giohang.php">
    <i class="fa fa-shopping-cart"></i>
  </a>
</div>

<div class="product-section">
  <div class="container">
      <h2 class="section-title">
        <?php 
          if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
              echo 'KẾT QUẢ TÌM KIẾM: "' . htmlspecialchars($_GET['search']) . '"';
          } else {
              echo 'SẢN PHẨM NỔI BẬT';
          }
        ?>
      </h2>
      
      <div class="product-grid">
          <?php
          $conn = mysqli_connect("localhost", "root", "", "qlshopdienthoai");
          
          // Xử lý tìm kiếm
          if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
              $search = mysqli_real_escape_string($conn, trim($_GET['search']));
              $sql = "SELECT * FROM sanpham 
                      WHERE tensp LIKE '%$search%' 
                         OR hang LIKE '%$search%' 
                         OR ghichu LIKE '%$search%'
                      ORDER BY masp DESC";
          } else {
              $sql = "SELECT * FROM sanpham ORDER BY masp DESC LIMIT 12";
          }
          
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
              echo '<p style="text-align:center; width:100%; padding:20px;">Không tìm thấy sản phẩm nào!</p>';
          }
          mysqli_close($conn);
          ?>
      </div>
  </div>
</div>

<link rel="stylesheet" href="css/footer.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<footer>
    <div class="footer-container">
        <div class="footer-content">
            <!-- Cột 1: Liên hệ -->
            <div class="footer-column">
                <h3 class="footer-title">Liên hệ</h3>
                <div class="footer-contact">
                    <div class="contact-item">
                        <span class="contact-label">Gọi mua:</span>
                        <a href="tel:0111111111" class="contact-link">0111 111 111</a>
                        <span class="contact-time">(8:00 - 21:30)</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-label">Khiếu nại:</span>
                        <a href="tel:0111111111" class="contact-link">0111 111 111</a>
                        <span class="contact-time">(8:00 - 21:30)</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-label">Bảo hành:</span>
                        <a href="tel:0111111111" class="contact-link">0111 111 111</a>
                        <span class="contact-time">(8:00 - 21:00)</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-label">Email:</span>
                        <a href="mailto:shoptet@gmail.com" class="contact-link">dienthoai24h@gmail.com</a>
                    </div>
                </div>
            </div>

            <!-- Cột 2: Giới thiệu -->
            <div class="footer-column">
                <h3 class="footer-title">Giới thiệu</h3>
                <ul class="footer-links">
                    <li><a href="index.php?page=about">Về công ty</a></li>
                    <li><a href="index.php?page=recruitment">Tuyển dụng</a></li>
                    <li><a href="index.php?page=news">Tin tức</a></li>
                    <li><a href="index.php?page=stores">Hệ thống cửa hàng</a></li>
                    <li><a href="index.php?page=contact">Liên hệ hợp tác</a></li>
                </ul>
            </div>

            <!-- Cột 3: Theo dõi chúng tôi -->
            <div class="footer-column">
                <h3 class="footer-title">Theo dõi chúng tôi</h3>
                <div class="social-links">
                    <a href="https://www.facebook.com/nguyen.hoang.178480" class="social-item facebook" style="color: #ecf0f1 !important; text-decoration: none !important;">
                        <span style="color: inherit; text-decoration: none;"><i class="fa-brands fa-facebook"></i> Facebook</span>
                    </a>
                    <a href="#" class="social-item youtube" style="color: #ecf0f1 !important; text-decoration: none !important;">
                        <span style="color: inherit; text-decoration: none;"><i class="fab fa-youtube"></i> Youtube</span>
                    </a>
                </div>
            </div>

            <!-- Cột 4: Đối tác thanh toán -->
            <div class="footer-column">
                <h3 class="footer-title">Đối tác thanh toán</h3>
                <div class="payment-partners">
                    <div class="partner-logo">
                        <img src="./Picture/Logo/visa-logo.png" alt="Visa">
                    </div>
                    <div class="partner-logo">
                        <img src="./Picture/Logo/mastercard-logo.png" alt="Mastercard">
                    </div>
                    <div class="partner-logo">
                        <img src="./Picture/Logo/jcb-logo.png" alt="JCB">
                    </div>
                    <div class="partner-logo">
                        <img src="./Picture/Logo/momo-logo.png" alt="Momo">
                    </div>
                    <div class="partner-logo">
                        <img src="./Picture/Logo/zalopay-logo.png" alt="ZaloPay">
                    </div>
                    <div class="partner-logo">
                        <img src="./Picture/Logo/vnpay-logo.png" alt="VNPay">
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <p>Điện thoại 24H</p>
            <p>Địa chỉ: 69 TRIỀU KHÚC</p>
        </div>
    </div>
</footer>

</body>
</html>

</body>
</html>