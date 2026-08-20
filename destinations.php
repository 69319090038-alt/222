<?php
require_once __DIR__ . "/config/db.php";
$pageTitle = "สถานที่ท่องเที่ยว";
$activePage = "destinations";

$result = $conn->query("SELECT * FROM destinations ORDER BY name_th ASC");
$categories = $conn->query("SELECT DISTINCT category FROM destinations");

require_once __DIR__ . "/includes/header.php";
?>

<section class="hero" style="padding:60px 0;">
  <div class="container">
    <span class="eyebrow">รวมทุกจุดหมาย</span>
    <h1 style="font-size:clamp(1.8rem,3.5vw,2.6rem);">สถานที่ท่องเที่ยว<span class="brush">ทั่วจีน</span></h1>
    <p class="lead">กรองตามประเภทสถานที่ที่คุณสนใจ ตั้งแต่มรดกโลกทางประวัติศาสตร์ ไปจนถึงทัศนียภาพธรรมชาติสุดตระการตา</p>
  </div>
</section>

<section class="container">
  <div style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:40px;">
    <button class="btn btn-primary" data-filter="all">ทั้งหมด</button>
    <?php while ($cat = $categories->fetch_assoc()): ?>
      <button class="btn btn-ghost" data-filter="<?= htmlspecialchars($cat['category']) ?>"><?= htmlspecialchars($cat['category']) ?></button>
    <?php endwhile; ?>
  </div>

  <div class="grid-cards">
    <?php while ($row = $result->fetch_assoc()): ?>
      <article class="card" data-category="<?= htmlspecialchars($row['category']) ?>">
        <div class="card-media">
          <span class="card-tag"><?= htmlspecialchars($row['category']) ?></span>
          <span class="card-rating"><?= htmlspecialchars($row['rating']) ?></span>
          <img src="https://source.unsplash.com/500x400/?china,<?= urlencode($row['city']) ?>" alt="<?= htmlspecialchars($row['name_th']) ?>" loading="lazy">
        </div>
        <div class="card-body">
          <h3><?= htmlspecialchars($row['name_th']) ?></h3>
          <div class="card-cn"><?= htmlspecialchars($row['name_cn']) ?></div>
          <p><?= htmlspecialchars($row['description']) ?></p>
          <div class="card-meta">
            <span>📍 <?= htmlspecialchars($row['city']) ?></span>
            <span>ช่วงเวลาแนะนำ: <?= htmlspecialchars($row['best_season']) ?></span>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</section>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
