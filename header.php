<?php
// includes/header.php
// ตัวแปร $activePage ถูกกำหนดในแต่ละหน้าเพื่อไฮไลต์เมนูที่กำลังเปิดอยู่
if (!isset($activePage)) { $activePage = ""; }
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . " | " : "" ?>เที่ยวจีน 中国游</title>
<link rel="stylesheet" href="/china-travel/css/style.css">
</head>
<body>

<header class="site-header">
  <div class="container nav">
    <a href="/china-travel/index.php" class="brand">
      <span class="seal">中</span>
      <span>เที่ยวจีน
        <small>CHINA TRAVEL GUIDE 中国旅游</small>
      </span>
    </a>

    <nav>
      <ul class="nav-links">
        <li><a href="/china-travel/index.php" class="<?= $activePage === 'home' ? 'active' : '' ?>">หน้าแรก</a></li>
        <li><a href="/china-travel/destinations.php" class="<?= $activePage === 'destinations' ? 'active' : '' ?>">สถานที่ท่องเที่ยว</a></li>
        <li><a href="/china-travel/about.php" class="<?= $activePage === 'about' ? 'active' : '' ?>">ข้อมูลประเทศจีน</a></li>
        <?php if ($isLoggedIn): ?>
        <li><a href="/china-travel/dashboard.php" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>">บัญชีของฉัน</a></li>
        <?php endif; ?>
      </ul>
    </nav>

    <div class="nav-auth">
      <?php if ($isLoggedIn): ?>
        <span style="font-size:.88rem; color:var(--ink-soft);">สวัสดี, <?= htmlspecialchars($_SESSION['full_name']) ?></span>
        <a href="/china-travel/logout.php" class="btn btn-ghost">ออกจากระบบ</a>
      <?php else: ?>
        <a href="/china-travel/login.php" class="btn btn-ghost">เข้าสู่ระบบ</a>
        <a href="/china-travel/register.php" class="btn btn-primary">สมัครสมาชิก</a>
      <?php endif; ?>
    </div>
  </div>
</header>
