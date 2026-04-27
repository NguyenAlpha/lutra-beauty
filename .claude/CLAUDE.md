# LUTRA Beauty – Tài liệu dự án

## Tổng quan

Landing page + admin panel cho quán nail **LUTRA Beauty** tại TP. Hồ Chí Minh. Xây dựng bằng Laravel 13 + Laravel Sail (Docker). Giao diện được thiết kế bởi Claude AI Design.

## Công nghệ sử dụng

- **Backend:** Laravel 13, PHP 8.x
- **Frontend:** Vanilla HTML/CSS/JS (không dùng Tailwind cho trang chính), CSS custom với `oklch()` color space
- **Font:** Cormorant Garamond (tiêu đề) + DM Sans (body) — Google Fonts CDN
- **Build tool:** Vite 8 + Tailwind CSS v4 (giữ sẵn để mở rộng sau)
- **Database:** MySQL (qua Docker Sail)
- **Môi trường:** Laravel Sail (Docker), chạy tại `http://localhost`

## Cấu trúc thư mục quan trọng

```
resources/views/
  welcome.blade.php               # Trang landing page chính (toàn bộ HTML/CSS/JS nhúng)
  emails/booking.blade.php        # Template email thông báo đặt lịch
  admin/
    login.blade.php               # Trang đăng nhập admin
    bookings/index.blade.php      # Dashboard admin: bảng + calendar

app/Http/Controllers/
  BookingController.php           # Xử lý form đặt lịch: validate → lưu DB → email → Messenger
  Admin/
    AuthController.php            # Đăng nhập / đăng xuất admin (session-based)
    BookingAdminController.php    # CRUD admin: list, show, updateStatus, destroy

app/Http/Middleware/
  AdminAuth.php                   # Bảo vệ route /admin, redirect về login nếu chưa đăng nhập

app/Models/
  Booking.php                     # Model lịch hẹn (status_label, status_color accessors)

app/Mail/
  BookingMailable.php             # Cấu hình email thông báo

database/migrations/
  2026_04_28_000000_create_bookings_table.php        # Bảng bookings
  2026_04_28_100000_add_status_to_bookings_table.php # Thêm cột status

public/images/uploads/            # Hình ảnh sản phẩm + favicon (ảnh .png từ Instagram)

LUTRA Beauty-Claude design/       # File thiết kế gốc từ Claude AI Design
  index.html                      # HTML gốc
  uploads/                        # Ảnh gốc (đã copy sang public/images/uploads/)
```

## Tính năng đã có

### Landing Page
- Hero slider tự động 4 ảnh (chuyển mỗi 4.5 giây)
- Section: Thống kê, Dịch vụ (5 loại), Gallery, Đặt lịch, Bản đồ, Footer
- Animation scroll (fade-up, clip-path reveal, counter count-up)
- Responsive mobile (breakpoint 768px, 1024px)
- Nút float Zalo + Facebook góc phải

### Form đặt lịch
- Validation frontend: họ tên, SĐT Việt Nam (regex), dịch vụ, ngày (hôm nay → +7 ngày theo giờ local), giờ
- Submit bằng `fetch` (AJAX, không reload trang)
- Sau submit: ẩn form, hiện thông báo thành công + toast notification

### Backend khi có đặt lịch mới
1. Validate + lưu vào bảng `bookings` (MySQL)
2. Gửi email HTML đến `nhatnguyen27042005@gmail.com` (Gmail SMTP)
3. Gửi tin nhắn Messenger vào cá nhân chủ quán (Facebook Send API)

### Admin Panel (`/admin`)
- **Xác thực:** session-based, credentials từ `.env` (`ADMIN_EMAIL` / `ADMIN_PASSWORD`)
- **Stats cards:** tổng lịch hẹn / hôm nay / chờ xác nhận / đã xác nhận
- **Bảng lịch hẹn:** tìm kiếm theo tên/SĐT, lọc theo status/dịch vụ/ngày, phân trang 10/trang
- **Action buttons mỗi row:**
  - 📞 Gọi — `<a href="tel:...">` gọi thẳng số khách (tiện trên mobile)
  - 👁 Xem — modal chi tiết đầy đủ
  - Dropdown đổi trạng thái inline (AJAX PATCH)
  - 🗑 Xoá — confirm trước, xoá mềm row (AJAX DELETE)
- **Calendar card:** lịch tháng điều hướng được, chấm màu theo trạng thái, click ngày xem danh sách mini
- Toast notification cho mọi action AJAX

## Database

Bảng `bookings`:
| Cột | Kiểu | Ghi chú |
|-----|------|---------|
| id | bigint | Auto increment |
| name | string | Họ tên khách |
| phone | string | Số điện thoại |
| service | string | Dịch vụ chọn |
| date | date | Ngày hẹn |
| time | string | Giờ hẹn |
| branch | string | Chi nhánh |
| note | text nullable | Ghi chú |
| status | enum | `pending` / `confirmed` / `completed` / `cancelled` (default: pending) |
| created_at / updated_at | timestamp | Timezone: Asia/Ho_Chi_Minh |

## Cấu hình môi trường (.env)

Các biến quan trọng cần thiết lập:
```
# App
APP_TIMEZONE=Asia/Ho_Chi_Minh

# Database (Sail mặc định)
DB_CONNECTION=mysql
DB_HOST=mysql
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

# Email (Gmail SMTP)
MAIL_MAILER=smtp
MAIL_SCHEME=smtps
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=<gmail>
MAIL_PASSWORD="<app-password-16-ký-tự>"

# Facebook Messenger
FACEBOOK_PSID=<psid-của-chủ-quán>
FACEBOOK_PAGE_ACCESS_TOKEN=<page-access-token>

# Admin Panel
ADMIN_EMAIL=admin@lutrabeauty.com
ADMIN_PASSWORD=<mật-khẩu-admin>
```

> ⚠️ Page Access Token Facebook hết hạn sau ~60 ngày, cần gia hạn định kỳ.

## Chạy dự án

```bash
# Khởi động Sail
./vendor/bin/sail up

# Chạy migration (lần đầu hoặc khi có migration mới)
./vendor/bin/sail artisan migrate

# Dừng
./vendor/bin/sail down
```

## Routes

| Method | URI | Chức năng |
|--------|-----|-----------|
| GET | `/` | Landing page |
| POST | `/booking` | Đặt lịch (AJAX) |
| GET | `/admin/login` | Trang đăng nhập admin |
| POST | `/admin/login` | Xử lý đăng nhập |
| POST | `/admin/logout` | Đăng xuất |
| GET | `/admin` | Dashboard admin (cần auth) |
| GET | `/admin/bookings/{id}` | Chi tiết booking JSON (cần auth) |
| PATCH | `/admin/bookings/{id}/status` | Đổi trạng thái (cần auth) |
| DELETE | `/admin/bookings/{id}` | Xoá booking (cần auth) |

## Thông tin quán

- **Hotline:** 0977.233.338
- **Chi nhánh 1:** 121 Lý Chiêu Hoàng, P.10, Q.6, TP.HCM
- **Chi nhánh 2:** Shophouse AK9-000.01, Chung cư Akari, 77 Võ Văn Kiệt, Q.Bình Tân
- **Giờ mở cửa:** Thứ 2 – Chủ Nhật: 8:30 – 22:00
- **Facebook:** [lutra.beautystudio](https://www.facebook.com/lutra.beautystudio)
