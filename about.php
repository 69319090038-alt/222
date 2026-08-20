<?php
require_once __DIR__ . "/config/db.php";
$pageTitle = "ข้อมูลประเทศจีน";
$activePage = "about";
require_once __DIR__ . "/includes/header.php";
?>

<section class="hero" style="padding:60px 0;">
  <div class="container">
    <span class="eyebrow">รู้จักก่อนเดินทาง</span>
    <h1 style="font-size:clamp(1.8rem,3.5vw,2.6rem);">ข้อมูลทั่วไป<span class="brush">ประเทศจีน</span></h1>
    <p class="lead">พื้นฐานที่ควรรู้ก่อนออกเดินทาง ตั้งแต่ภูมิศาสตร์ วัฒนธรรม ไปจนถึงภาษาจีนเบื้องต้นสำหรับใช้สื่อสารระหว่างทริป</p>
  </div>
</section>

<section class="container about-grid">
  <div>
    <h2>ข้อเท็จจริงสำคัญ</h2>
    <ul class="fact-list">
      <li><span class="k">ชื่อทางการ</span><span class="v">สาธารณรัฐประชาชนจีน (People's Republic of China)</span></li>
      <li><span class="k">เมืองหลวง</span><span class="v">ปักกิ่ง (Beijing)</span></li>
      <li><span class="k">ประชากร</span><span class="v">มากกว่า 1,400 ล้านคน มากที่สุดเป็นอันดับต้นของโลก</span></li>
      <li><span class="k">สกุลเงิน</span><span class="v">หยวน (Renminbi, ¥ / RMB)</span></li>
      <li><span class="k">เขตเวลา</span><span class="v">UTC+8 ใช้เวลาเดียวกันทั้งประเทศ</span></li>
      <li><span class="k">ภูมิประเทศ</span><span class="v">หลากหลายที่สุดในโลก ตั้งแต่ทะเลทรายโกบี ที่ราบสูงทิเบต จนถึงป่าฝนกึ่งเขตร้อนทางใต้</span></li>
    </ul>
  </div>

  <div class="info-panel">
    <span class="seal">语</span>
    <h3 style="margin-top:16px;">ภาษาจีน (Chinese Language)</h3>
    <p>ภาษาจีนกลาง (Mandarin / 普通话) เป็นภาษาราชการและใช้พูดกันมากที่สุดในประเทศจีน มีผู้ใช้เป็นภาษาแม่มากที่สุดในโลก เขียนด้วยอักษรจีน (汉字) ซึ่งเป็นอักษรภาพที่มีประวัติยาวนานกว่า 3,000 ปี และมีเสียงวรรณยุกต์ 4 เสียงหลักที่ทำให้ความหมายของคำเปลี่ยนไปตามระดับเสียง</p>
    <p>นอกจากภาษาจีนกลางแล้ว ยังมีภาษาถิ่นอีกมากมาย เช่น กวางตุ้ง (广东话) ในมณฑลกวางตุ้งและฮ่องกง, ภาษาเซี่ยงไฮ้ (上海话), และภาษาหมิ่นหนาน (闽南语) ทางตอนใต้ของจีนและไต้หวัน</p>
    <p style="margin-bottom:0;">คำทักทายพื้นฐานที่นักท่องเที่ยวควรรู้: <strong>你好 (Nǐ hǎo)</strong> แปลว่า สวัสดี และ <strong>谢谢 (Xièxiè)</strong> แปลว่า ขอบคุณ</p>
  </div>
</section>

<section class="container" style="padding-top:0;">
  <div class="section-head">
    <div>
      <h2>วัฒนธรรมและเทศกาล</h2>
      <p class="sub">มรดกทางวัฒนธรรมที่หล่อหลอมวิถีชีวิตชาวจีนมาหลายพันปี</p>
    </div>
  </div>
  <div class="grid-cards">
    <article class="card"><div class="card-body">
      <h3>ตรุษจีน (春节)</h3>
      <p style="color:var(--ink-soft); font-size:.92rem;">เทศกาลที่สำคัญที่สุดของชาวจีน เฉลิมฉลองการเริ่มต้นปีใหม่ตามปฏิทินจันทรคติ เต็มไปด้วยการจุดประทัด สิงโตคู่ และอั่งเปา</p>
    </div></article>
    <article class="card"><div class="card-body">
      <h3>ชา (茶文化)</h3>
      <p style="color:var(--ink-soft); font-size:.92rem;">วัฒนธรรมการดื่มชามีรากฐานลึกซึ้ง ตั้งแต่พิธีชงชาแบบกงฝูฉา ไปจนถึงร้านน้ำชาริมถนนที่พบเห็นได้ทั่วไป</p>
    </div></article>
    <article class="card"><div class="card-body">
      <h3>ศิลปะการเขียนพู่กัน (书法)</h3>
      <p style="color:var(--ink-soft); font-size:.92rem;">การเขียนอักษรจีนด้วยพู่กันถือเป็นศิลปะชั้นสูง สะท้อนจิตวิญญาณและความประณีตของผู้เขียนในทุกเส้นสาย</p>
    </div></article>
  </div>
</section>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
