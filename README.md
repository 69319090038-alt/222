# เที่ยวจีน — เว็บไซต์ท่องเที่ยวประเทศจีน

โปรเจกต์ตัวอย่าง: HTML5 + CSS3 + JavaScript (frontend) และ PHP + MySQLi (backend) รันบน XAMPP
มีระบบสมัครสมาชิก / เข้าสู่ระบบ / ออกจากระบบ, หน้าแสดงสถานที่ท่องเที่ยว (ดึงจากฐานข้อมูล), และหน้าข้อมูลทั่วไปเกี่ยวกับประเทศจีน (รวมข้อมูลภาษาจีน)

## โครงสร้างไฟล์
```
china-travel/
├── config/
│   └── db.php              # การเชื่อมต่อฐานข้อมูล MySQLi
├── includes/
│   ├── header.php          # ส่วนหัว/เมนู ใช้ร่วมกันทุกหน้า
│   └── footer.php          # ส่วนท้าย ใช้ร่วมกันทุกหน้า
├── css/style.css           # สไตล์ทั้งเว็บไซต์
├── js/script.js            # สคริปต์ฝั่ง client (filter, validate, animation)
├── sql/database.sql        # โครงสร้างฐานข้อมูล + ข้อมูลตัวอย่าง
├── index.php                หน้าแรก
├── destinations.php         รายการสถานที่ท่องเที่ยว (กรองตามหมวดหมู่)
├── about.php                 ข้อมูลทั่วไปเกี่ยวกับประเทศจีน + ภาษาจีน
├── register.php              สมัครสมาชิก
├── login.php                  เข้าสู่ระบบ
├── logout.php                 ออกจากระบบ
└── dashboard.php               หน้าสมาชิก (ต้องล็อกอินก่อน)
```

## วิธีติดตั้งบน XAMPP

1. ติดตั้งและเปิดโปรแกรม **XAMPP** จากนั้นเปิดใช้งาน **Apache** และ **MySQL** ใน XAMPP Control Panel

2. คัดลอกโฟลเดอร์ทั้งหมด `china-travel/` ไปวางไว้ที่:
   - Windows: `C:\xampp\htdocs\china-travel`
   - macOS: `/Applications/XAMPP/htdocs/china-travel`

3. สร้างฐานข้อมูล:
   - เปิดเบราว์เซอร์ไปที่ `http://localhost/phpmyadmin`
   - คลิกแท็บ **Import** เลือกไฟล์ `sql/database.sql` แล้วกด **Go**
   - หรือรันผ่าน command line: `mysql -u root -p < sql/database.sql`

   ไฟล์นี้จะสร้างฐานข้อมูลชื่อ `china_travel` พร้อมตาราง `users` และ `destinations` (มีข้อมูลตัวอย่าง 8 สถานที่ให้พร้อมใช้งาน)

4. ตรวจสอบไฟล์ `config/db.php` — ค่าเริ่มต้นตรงกับ XAMPP มาตรฐาน (`root` / ไม่มีรหัสผ่าน) ถ้าคุณตั้งรหัสผ่าน MySQL ไว้เอง ให้แก้ค่า `$DB_PASS` ในไฟล์นี้

5. เปิดเบราว์เซอร์ไปที่ `http://localhost/china-travel/index.php`

## หมายเหตุด้านความปลอดภัย (สำหรับใช้งานจริง)
- รหัสผ่านเก็บด้วย `password_hash()` และตรวจสอบด้วย `password_verify()` แล้ว
- ทุก query ที่รับค่าจากผู้ใช้ใช้ **prepared statements** (`bind_param`) ป้องกัน SQL Injection
- ค่าที่แสดงผลบนหน้าเว็บผ่าน `htmlspecialchars()` ป้องกัน XSS
- ก่อนนำไปใช้งานจริง ควรเพิ่ม: HTTPS, CSRF token ในฟอร์ม, rate-limit การเข้าสู่ระบบ, และตั้งรหัสผ่านฐานข้อมูล MySQL ที่คาดเดายาก

## รูปภาพสถานที่ท่องเที่ยว
โค้ดตัวอย่างดึงรูปจาก Unsplash ผ่านลิงก์ตรง (ต้องต่ออินเทอร์เน็ต) เพื่อความรวดเร็วในการเดโม
สำหรับใช้งานจริง แนะนำให้ดาวน์โหลดรูปมาเก็บไว้ในโฟลเดอร์ `assets/images/` แล้วแก้ path ในไฟล์ `index.php` และ `destinations.php`
ให้ชี้ไปที่ไฟล์ในเครื่อง (คอลัมน์ `image_file` ในตาราง `destinations` เตรียมชื่อไฟล์ไว้ให้แล้ว)
