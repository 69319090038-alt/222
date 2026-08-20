<?php
require_once __DIR__ . "/config/db.php";
$pageTitle = "บัญชีของฉัน";
$activePage = "dashboard";

// ----- ป้องกันหน้านี้: ต้องล็อกอินก่อนเท่านั้น -----
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("SELECT full_name, username, email, created_at FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

require_once __DIR__ . "/includes/header.php";
?>

<section class="container" style="padding-top:50px;">
  <div class="welcome-banner">
    <div>
      <h2>ยินดีต้อนรับ, <?= htmlspecialchars($user['full_name']) ?> 👋</h2>
      <p>วางแผนทริปจีนครั้งต่อไปของคุณได้เลย</p>
    </div>
    <a href="/china-travel/destinations.php" class="btn btn-primary">สำรวจสถานที่ท่องเที่ยว</a>
  </div>
</section>

<section class="container">
  <div class="section-head">
    <div><h2>ข้อมูลบัญชี</h2></div>
  </div>
  <ul class="fact-list" style="max-width:600px;">
    <li><span class="k">ชื่อ-นามสกุล</span><span class="v"><?= htmlspecialchars($user['full_name']) ?></span></li>
    <li><span class="k">ชื่อผู้ใช้</span><span class="v"><?= htmlspecialchars($user['username']) ?></span></li>
    <li><span class="k">อีเมล</span><span class="v"><?= htmlspecialchars($user['email']) ?></span></li>
    <li><span class="k">สมัครเมื่อ</span><span class="v"><?= date("d/m/Y H:i", strtotime($user['created_at'])) ?> น.</span></li>
  </ul>
</section>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
