<?php
require_once __DIR__ . "/config/db.php";
$pageTitle = "เข้าสู่ระบบ";
$activePage = "login";

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identity = trim($_POST['identity'] ?? '');   // username หรือ email
    $password = $_POST['password'] ?? '';

    if ($identity === '' || $password === '') {
        $errors[] = "กรุณากรอกชื่อผู้ใช้/อีเมล และรหัสผ่าน";
    } else {
        $stmt = $conn->prepare("SELECT id, full_name, username, password FROM users WHERE username = ? OR email = ? LIMIT 1");
        $stmt->bind_param("ss", $identity, $identity);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password'])) {
            // ล็อกอินสำเร็จ -> เก็บ session
            session_regenerate_id(true);
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['username']  = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $errors[] = "ชื่อผู้ใช้/อีเมล หรือรหัสผ่านไม่ถูกต้อง";
        }
    }
}

require_once __DIR__ . "/includes/header.php";
?>

<div class="auth-wrap">
  <div class="auth-card">
    <span class="seal" style="display:flex;">入</span>
    <h1>เข้าสู่ระบบ</h1>
    <p class="sub-text">ยินดีต้อนรับกลับมา เข้าสู่ระบบเพื่อดำเนินการต่อ</p>

    <?php foreach ($errors as $err): ?>
      <div class="alert alert-error"><?= htmlspecialchars($err) ?></div>
    <?php endforeach; ?>

    <form method="POST" action="login.php" novalidate>
      <div class="field">
        <label for="identity">ชื่อผู้ใช้ หรือ อีเมล</label>
        <input type="text" id="identity" name="identity" value="<?= htmlspecialchars($_POST['identity'] ?? '') ?>" required>
      </div>
      <div class="field">
        <label for="password">รหัสผ่าน</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
    </form>

    <div class="form-foot">ยังไม่มีบัญชี? <a href="register.php">สมัครสมาชิก</a></div>
  </div>
</div>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
