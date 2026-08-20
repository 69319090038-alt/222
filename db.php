<?php
/**
 * config/db.php
 * การเชื่อมต่อฐานข้อมูลด้วย MySQLi สำหรับ XAMPP
 * ค่าเริ่มต้นของ XAMPP: host=localhost, user=root, password="" (ว่าง)
 */

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "china_travel";

// เปิดโหมดรายงาน error ของ mysqli เพื่อดักจับข้อผิดพลาดด้วย try/catch
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: กรุณาตรวจสอบว่าเปิด XAMPP (Apache + MySQL) แล้ว และได้ import ไฟล์ sql/database.sql เข้าไปแล้ว<br>รายละเอียด: " . $e->getMessage());
}

// เริ่ม session ทุกหน้าที่เรียกไฟล์นี้ (ถ้ายังไม่เริ่ม)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
