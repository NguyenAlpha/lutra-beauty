<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đặt lịch mới – LUTRA Beauty</title>
<style>
  body { font-family: 'Segoe UI', Arial, sans-serif; background: #f4f7f6; margin: 0; padding: 32px 16px; color: #1a2e28; }
  .card { background: white; max-width: 520px; margin: 0 auto; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
  .header { background: #2d5a4a; padding: 32px; text-align: center; }
  .header-logo { font-size: 22px; font-weight: 300; color: white; letter-spacing: 0.2em; }
  .header-logo span { color: #7ecba8; }
  .header-sub { color: rgba(255,255,255,0.65); font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase; margin-top: 6px; }
  .body { padding: 36px 32px; }
  .alert { background: #edf7f2; border-left: 3px solid #2d5a4a; padding: 14px 16px; border-radius: 4px; margin-bottom: 28px; font-size: 14px; color: #2d5a4a; }
  .row { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f0f4f2; }
  .row:last-child { border-bottom: none; }
  .label { font-size: 11px; text-transform: uppercase; letter-spacing: 0.1em; color: #7a9e92; font-weight: 600; }
  .value { font-size: 14px; color: #1a2e28; font-weight: 500; text-align: right; max-width: 60%; }
  .note-box { background: #f8fbf9; border-radius: 8px; padding: 14px 16px; margin-top: 20px; font-size: 14px; color: #3d5a50; line-height: 1.6; }
  .footer { background: #f8fbf9; padding: 20px 32px; text-align: center; font-size: 12px; color: #9ab5ac; border-top: 1px solid #edf2f0; }
</style>
</head>
<body>
<div class="card">
  <div class="header">
    <div class="header-logo">LUTRA <span>Beauty</span></div>
    <div class="header-sub">Thông báo đặt lịch mới</div>
  </div>
  <div class="body">
    <div class="alert">
      ✅ Có khách đặt lịch mới lúc {{ $booking->created_at->format('H:i – d/m/Y') }}
    </div>

    <div class="row">
      <span class="label">Họ & Tên: </span>
      <span class="value">{{ $booking->name }}</span>
    </div>
    <div class="row">
      <span class="label">Số Điện Thoại: </span>
      <span class="value">{{ $booking->phone }}</span>
    </div>
    <div class="row">
      <span class="label">Dịch Vụ: </span>
      <span class="value">{{ $booking->service }}</span>
    </div>
    <div class="row">
      <span class="label">Ngày Hẹn: </span>
      <span class="value">{{ \Carbon\Carbon::parse($booking->date)->format('d/m/Y') }}</span>
    </div>
    <div class="row">
      <span class="label">Giờ Hẹn: </span>
      <span class="value">{{ $booking->time }}</span>
    </div>
    <div class="row">
      <span class="label">Chi Nhánh: </span>
      <span class="value">{{ $booking->branch }}</span>
    </div>

    @if($booking->note)
    <div class="note-box">
      <span style="font-size:11px;text-transform:uppercase;letter-spacing:0.1em;color:#7a9e92;font-weight:600;">Ghi chú</span><br>
      {{ $booking->note }}
    </div>
    @endif
  </div>
  <div class="footer">
    LUTRA Beauty · 121 Lý Chiêu Hoàng, Q.6 · 0977.233.338
  </div>
</div>
</body>
</html>
