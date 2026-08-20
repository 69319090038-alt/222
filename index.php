<?php
require_once __DIR__ . "/config/db.php";
$pageTitle = "หน้าแรก";
$activePage = "home";

// ดึงสถานที่ท่องเที่ยวแนะนำ 4 อันดับแรก (เรียงตามคะแนน)
$result = $conn->query("SELECT * FROM destinations ORDER BY rating DESC LIMIT 4");

require_once __DIR__ . "/includes/header.php";
?>

<section class="hero">
  <div class="container hero-grid">
    <div>
      <span class="eyebrow">คู่มือนักเดินทาง</span>
      <h1>สัมผัส<span class="brush">แผ่นดินมังกร</span><br>ในทุกย่างก้าว</h1>
      <p class="lead">ตั้งแต่กำแพงเมืองจีนอันยิ่งใหญ่ ไปจนถึงตรอกซอกซอยเมืองโบราณริมคลอง รวมข้อมูลสถานที่ท่องเที่ยว วัฒนธรรม และเคล็ดลับการเดินทางทั่วประเทศจีนไว้ในที่เดียว</p>
      <div class="hero-actions">
        <a href="/china-travel/destinations.php" class="btn btn-primary">เริ่มสำรวจสถานที่</a>
        <a href="/china-travel/about.php" class="btn btn-ghost">รู้จักประเทศจีน</a>
      </div>
    </div>
    <div class="hero-collage">
      <img class="tall" src="https://images.unsplash.com/photo-1508804185872-d7badad00f7d?w=700&q=80" alt="กำแพงเมืองจีน">
      <img src="https://images.unsplash.com/photo-1548013146-72479768bada?w=500&q=80" alt="พระราชวังต้องห้าม">
      <img src="https://images.unsplash.com/photo-1537531383496-f4749b8032cf?w=500&q=80" alt="เขาจางเจียเจี้ย">
      <div class="hero-stamp"><span class="seal">游</span></div>
    </div>
  </div>
</section>

<section class="container">
  <div class="section-head">
    <div>
      <h2>สถานที่ท่องเที่ยวยอดนิยม</h2>
      <p class="sub">คัดสรรจุดหมายที่นักเดินทางให้คะแนนสูงสุดจากทั่วประเทศจีน</p>
    </div>
    <a href="/china-travel/destinations.php" class="btn btn-ghost">ดูทั้งหมด →</a>
  </div>

  <div class="grid-cards">
    <?php while ($row = $result->fetch_assoc()): ?>
      <article class="card">
        <div class="card-media">
          <span class="card-tag"><?= htmlspecialchars($row['category']) ?></span>
          <span class="card-rating"><?= htmlspecialchars($row['rating']) ?></span>
          <img src="https://source.unsplash.com/500x400/?china,<?= urlencode($row['city']) ?>" alt="<?= htmlspecialchars($row['name_th']) ?>" loading="lazy">
        </div>
        <div class="card-body">
          <h3><?= htmlspecialchars($row['name_th']) ?></h3>
          <div class="card-cn"><?= htmlspecialchars($row['name_cn']) ?></div>
          <p><?= htmlspecialchars(mb_substr($row['description'], 0, 90)) ?>…</p>
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
