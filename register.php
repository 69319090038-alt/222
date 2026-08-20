<?php
require_once __DIR__ . "/config/db.php";
$pageTitle = "สมัครสมาชิก";
$activePage = "register";

// ถ้าล็อกอินอยู่แล้ว ให้เด้งไป dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $username  = trim($_POST['username'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $confirm   = $_POST['confirm_password'] ?? '';

    // ----- ตรวจสอบข้อมูลฝั่ง server -----
    if ($full_name === '' || $username === '' || $email === '' || $password === '') {
        $errors[] = "กรุณากรอกข้อมูลให้ครบทุกช่อง";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "รูปแบบอีเมลไม่ถูกต้อง";
    }
    if (strlen($password) < 6) {
        $errors[] = "รหัสผ่านต้องมีความยาวอย่างน้อย 6 ตัวอักษร";
    }
    if ($password !== $confirm) {
        $errors[] = "รหัสผ่านและการยืนยันรหัสผ่านไม่ตรงกัน";
    }
    if (!preg_match('/^[a-zA-Z0-9_]{3,50}$/', $username)) {
        $errors[] = "ชื่อผู้ใช้ต้องเป็นตัวอักษรภาษาอังกฤษ ตัวเลข หรือ _ เท่านั้น (3-50 ตัวอักษร)";
    }

    // ----- ตรวจสอบว่า username / email ซ้ำหรือไม่ -----
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "ชื่อผู้ใช้หรืออีเมลนี้ถูกใช้งานแล้ว";
        }
        $stmt->close();
    }

    // ----- บันทึกสมาชิกใหม่ -----
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (full_name, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $full_name, $username, $email, $hashedPassword);
        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = "เกิดข้อผิดพลาดในการสมัครสมาชิก กรุณาลองใหม่อีกครั้ง";
        }
        $stmt->close();
    }
}

require_once __DIR__ . "/includes/header.php";
?>

<div class="auth-wrap">
  <div class="auth-card">
    <span class="seal" style="display:flex;">用</span>
    <h1>สมัครสมาชิก</h1>
    <p class="sub-text">สร้างบัญชีเพื่อบันทึกสถานที่ท่องเที่ยวที่คุณสนใจ</p>

    <div id="clientError" class="alert alert-error" style="display:none;"></div>

    <?php if ($success): ?>
      <div class="alert alert-success">
        สมัครสมาชิกสำเร็จ! กรุณา <a href="login.php" style="color:var(--jade); font-weight:700;">เข้าสู่ระบบ</a>
      </div>
    <?php else: ?>
      <?php foreach ($errors as $err): ?>
        <div class="alert alert-error"><?= htmlspecialchars($err) ?></div>
      <?php endforeach; ?>

      <form id="registerForm" method="POST" action="register.php" novalidate>
        <div class="field">
          <label for="full_name">ชื่อ-นามสกุล</label>
          <input type="text" id="full_name" name="full_name" value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>" required>
        </div>
        <div class="field">
          <label for="username">ชื่อผู้ใช้ (username)</label>
          <input type="text" id="username" name="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
          <div class="hint">ภาษาอังกฤษ ตัวเลข หรือ _ เท่านั้น 3-50 ตัวอักษร</div>
        </div>
        <div class="field">
          <label for="email">อีเมล</label>
          <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
        </div>
        <div class="field">
          <label for="password">รหัสผ่าน</label>
          <input type="password" id="password" name="password" required>
          <div class="hint">อย่างน้อย 6 ตัวอักษร</div>
        </div>
        <div class="field">
          <label for="confirm_password">ยืนยันรหัสผ่าน</label>
          <input type="password" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">สมัครสมาชิก</button>
      </form>
    <?php endif; ?>

    <div class="form-foot">มีบัญชีอยู่แล้ว? <a href="login.php">เข้าสู่ระบบ</a></div>
  </div>
</div>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
