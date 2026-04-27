<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Quản lý lịch hẹn – LUTRA Beauty</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" type="image/jpeg" href="/images/uploads/612365143_1328013149347255_1293637779033925772_n.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
/* ─── Reset & Variables ─────────────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --gold:    oklch(72% 0.12 65);
  --gold-d:  oklch(58% 0.10 65);
  --gold-bg: oklch(22% 0.04 65);
  --bg:      oklch(12% 0.01 280);
  --bg2:     oklch(15% 0.01 280);
  --surface: oklch(18% 0.015 280);
  --surface2:oklch(21% 0.012 280);
  --border:  oklch(26% 0.01 280);
  --border2: oklch(30% 0.01 280);
  --text:    oklch(92% 0.005 280);
  --text2:   oklch(75% 0.005 280);
  --muted:   oklch(55% 0.005 280);

  --pending:   oklch(78% 0.14 85);
  --pending-bg:oklch(20% 0.04 85);
  --confirmed: oklch(65% 0.15 240);
  --confirmed-bg: oklch(18% 0.05 240);
  --completed: oklch(68% 0.14 145);
  --completed-bg: oklch(17% 0.05 145);
  --cancelled: oklch(62% 0.18 25);
  --cancelled-bg: oklch(18% 0.06 25);

  --sidebar-w: 260px;
  --header-h: 60px;
}

body {
  font-family: 'DM Sans', sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
  font-size: 0.9rem;
}

/* ─── Layout ────────────────────────────────────────────────────────────── */
.layout { display: flex; min-height: 100vh; }

.sidebar {
  width: var(--sidebar-w);
  background: var(--surface);
  border-right: 1px solid var(--border);
  display: flex;
  flex-direction: column;
  position: fixed;
  top: 0; left: 0;
  height: 100vh;
  z-index: 100;
}

.sidebar-brand {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  gap: 0.75rem;
}

.brand-icon {
  width: 36px; height: 36px;
  background: linear-gradient(135deg, var(--gold), var(--gold-d));
  border-radius: 8px;
  display: grid; place-items: center;
  font-size: 1.1rem;
  flex-shrink: 0;
}

.brand-text { line-height: 1.2; }
.brand-name {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.1rem;
  font-weight: 600;
  color: var(--gold);
}
.brand-sub { font-size: 0.7rem; color: var(--muted); letter-spacing: 0.1em; text-transform: uppercase; }

.sidebar-nav { flex: 1; padding: 1rem 0; overflow-y: auto; }

.nav-section {
  padding: 0.5rem 1.5rem 0.25rem;
  font-size: 0.65rem;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: 0.12em;
  font-weight: 500;
}

.nav-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.65rem 1.5rem;
  color: var(--text2);
  text-decoration: none;
  transition: background 0.15s, color 0.15s;
  font-size: 0.875rem;
}

.nav-item:hover { background: var(--surface2); color: var(--text); }
.nav-item.active { background: var(--gold-bg); color: var(--gold); }
.nav-item .icon { font-size: 1rem; width: 20px; text-align: center; }

.sidebar-footer {
  padding: 1rem 1.5rem;
  border-top: 1px solid var(--border);
}

.logout-btn {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  width: 100%;
  padding: 0.6rem 0.75rem;
  background: none;
  border: 1px solid var(--border);
  border-radius: 8px;
  color: var(--muted);
  font-family: inherit;
  font-size: 0.875rem;
  cursor: pointer;
  transition: background 0.15s, color 0.15s, border-color 0.15s;
}

.logout-btn:hover {
  background: oklch(18% 0.04 25);
  border-color: var(--cancelled);
  color: var(--cancelled);
}

/* ─── Main ──────────────────────────────────────────────────────────────── */
.main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }

.topbar {
  height: var(--header-h);
  background: var(--surface);
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1.75rem;
  position: sticky; top: 0; z-index: 50;
}

.page-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.3rem;
  font-weight: 500;
}

.topbar-right { display: flex; align-items: center; gap: 1rem; }

.badge-live {
  display: flex; align-items: center; gap: 0.4rem;
  font-size: 0.75rem; color: var(--completed);
  background: var(--completed-bg);
  border: 1px solid oklch(30% 0.08 145);
  padding: 0.25rem 0.6rem; border-radius: 20px;
}

.badge-live::before {
  content: '';
  width: 6px; height: 6px;
  background: var(--completed);
  border-radius: 50%;
  animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.3; }
}

.content { padding: 1.5rem 1.75rem; flex: 1; }

/* ─── Stats ─────────────────────────────────────────────────────────────── */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.stat-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 12px;
  padding: 1.1rem 1.25rem;
  display: flex;
  align-items: center;
  gap: 1rem;
}

.stat-icon {
  width: 42px; height: 42px;
  border-radius: 10px;
  display: grid; place-items: center;
  font-size: 1.2rem;
  flex-shrink: 0;
}

.stat-icon.gold  { background: var(--gold-bg); }
.stat-icon.blue  { background: var(--confirmed-bg); }
.stat-icon.green { background: var(--completed-bg); }
.stat-icon.yellow{ background: var(--pending-bg); }

.stat-info {}
.stat-value {
  font-size: 1.5rem;
  font-weight: 500;
  font-family: 'Cormorant Garamond', serif;
  line-height: 1.2;
}
.stat-label { font-size: 0.75rem; color: var(--muted); margin-top: 0.1rem; }

/* ─── Two-column layout ─────────────────────────────────────────────────── */
.grid-main {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 1.25rem;
  align-items: start;
}

/* ─── Card ──────────────────────────────────────────────────────────────── */
.card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 14px;
  overflow: hidden;
}

.card-header {
  padding: 1rem 1.25rem;
  border-bottom: 1px solid var(--border);
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 0.75rem;
  flex-wrap: wrap;
}

.card-header-title {
  font-size: 0.95rem;
  font-weight: 500;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

/* ─── Filter bar ────────────────────────────────────────────────────────── */
.filter-bar {
  display: flex;
  gap: 0.6rem;
  flex-wrap: wrap;
  align-items: center;
}

.filter-input, .filter-select {
  background: var(--bg2);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 0.45rem 0.8rem;
  color: var(--text);
  font-family: inherit;
  font-size: 0.8rem;
  outline: none;
  transition: border-color 0.15s;
}

.filter-input:focus, .filter-select:focus { border-color: var(--gold); }
.filter-input { min-width: 180px; }
.filter-select option { background: var(--surface); }

.btn-filter {
  padding: 0.45rem 1rem;
  background: var(--gold-bg);
  border: 1px solid oklch(35% 0.06 65);
  border-radius: 8px;
  color: var(--gold);
  font-family: inherit;
  font-size: 0.8rem;
  cursor: pointer;
  transition: background 0.15s;
}
.btn-filter:hover { background: oklch(26% 0.06 65); }

.btn-reset {
  padding: 0.45rem 0.8rem;
  background: none;
  border: 1px solid var(--border);
  border-radius: 8px;
  color: var(--muted);
  font-family: inherit;
  font-size: 0.8rem;
  cursor: pointer;
  transition: color 0.15s, border-color 0.15s;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
}
.btn-reset:hover { color: var(--text); border-color: var(--border2); }

/* ─── Table ─────────────────────────────────────────────────────────────── */
.table-wrap { overflow-x: auto; }

table { width: 100%; border-collapse: collapse; }

thead tr { border-bottom: 1px solid var(--border); }
thead th {
  padding: 0.7rem 1rem;
  text-align: left;
  font-size: 0.7rem;
  font-weight: 500;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  white-space: nowrap;
}

tbody tr {
  border-bottom: 1px solid oklch(20% 0.01 280);
  transition: background 0.1s;
}
tbody tr:last-child { border-bottom: none; }
tbody tr:hover { background: var(--surface2); }

tbody td {
  padding: 0.75rem 1rem;
  vertical-align: middle;
  font-size: 0.875rem;
}

.td-name { font-weight: 500; }
.td-phone { color: var(--text2); font-size: 0.82rem; }
.td-service { color: var(--text2); }
.td-date { white-space: nowrap; }
.td-time { white-space: nowrap; color: var(--gold); font-size: 0.85rem; }
.td-branch { font-size: 0.8rem; color: var(--muted); max-width: 130px; }

/* ─── Status badge ──────────────────────────────────────────────────────── */
.status-badge {
  display: inline-flex;
  align-items: center;
  gap: 0.35rem;
  padding: 0.25rem 0.6rem;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 500;
  white-space: nowrap;
}

.status-badge::before {
  content: '';
  width: 5px; height: 5px;
  border-radius: 50%;
  background: currentColor;
}

.badge-pending   { background: var(--pending-bg);   color: var(--pending);   border: 1px solid oklch(30% 0.07 85); }
.badge-confirmed { background: var(--confirmed-bg);  color: var(--confirmed); border: 1px solid oklch(28% 0.08 240); }
.badge-completed { background: var(--completed-bg);  color: var(--completed); border: 1px solid oklch(28% 0.08 145); }
.badge-cancelled { background: var(--cancelled-bg);  color: var(--cancelled); border: 1px solid oklch(28% 0.09 25); }

/* ─── Action buttons ────────────────────────────────────────────────────── */
.actions { display: flex; align-items: center; gap: 0.4rem; }

.btn-icon {
  width: 30px; height: 30px;
  border-radius: 7px;
  border: 1px solid var(--border);
  background: none;
  color: var(--muted);
  cursor: pointer;
  display: grid; place-items: center;
  font-size: 0.85rem;
  transition: background 0.15s, color 0.15s, border-color 0.15s;
}
.btn-icon:hover { background: var(--surface2); color: var(--text); border-color: var(--border2); }
.btn-icon.call:hover  { background: var(--completed-bg); color: var(--completed); border-color: oklch(28% 0.08 145); }
.btn-icon.view:hover  { background: var(--confirmed-bg); color: var(--confirmed); border-color: oklch(28% 0.08 240); }
.btn-icon.delete:hover{ background: var(--cancelled-bg); color: var(--cancelled); border-color: oklch(28% 0.09 25); }

/* Status dropdown */
.status-select {
  background: var(--bg2);
  border: 1px solid var(--border);
  border-radius: 6px;
  padding: 0.25rem 0.4rem;
  color: var(--text);
  font-family: inherit;
  font-size: 0.75rem;
  cursor: pointer;
  outline: none;
  transition: border-color 0.15s;
}
.status-select:focus { border-color: var(--gold); }
.status-select option { background: var(--surface); }

/* ─── Pagination ────────────────────────────────────────────────────────── */
.pagination-wrap {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0.85rem 1.25rem;
  border-top: 1px solid var(--border);
  font-size: 0.8rem;
  color: var(--muted);
  flex-wrap: wrap;
  gap: 0.5rem;
}

.pagination { display: flex; gap: 0.35rem; flex-wrap: wrap; }

.pagination a, .pagination span {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 32px;
  height: 32px;
  padding: 0 0.5rem;
  border-radius: 7px;
  border: 1px solid var(--border);
  text-decoration: none;
  font-size: 0.8rem;
  transition: background 0.15s, border-color 0.15s, color 0.15s;
}

.pagination a { color: var(--text2); }
.pagination a:hover { background: var(--surface2); color: var(--text); border-color: var(--border2); }
.pagination span.active { background: var(--gold-bg); border-color: oklch(35% 0.06 65); color: var(--gold); }
.pagination span.disabled { color: var(--muted); cursor: default; background: none; }

/* ─── Calendar ──────────────────────────────────────────────────────────── */
.cal-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1.25rem;
  border-bottom: 1px solid var(--border);
}

.cal-nav {
  display: flex; align-items: center; gap: 0.4rem;
}

.cal-nav-btn {
  width: 28px; height: 28px;
  border-radius: 6px;
  border: 1px solid var(--border);
  background: none;
  color: var(--muted);
  cursor: pointer;
  display: grid; place-items: center;
  font-size: 0.8rem;
  transition: background 0.15s, color 0.15s;
  text-decoration: none;
}
.cal-nav-btn:hover { background: var(--surface2); color: var(--text); }

.cal-month-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1rem;
  font-weight: 600;
  color: var(--gold);
  min-width: 130px;
  text-align: center;
}

.cal-body { padding: 0.75rem; }

.cal-weekdays {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  margin-bottom: 0.25rem;
}
.cal-weekday {
  text-align: center;
  font-size: 0.65rem;
  font-weight: 500;
  color: var(--muted);
  text-transform: uppercase;
  padding: 0.3rem 0;
}

.cal-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 2px; }

.cal-day {
  aspect-ratio: 1;
  border-radius: 6px;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  font-size: 0.78rem;
  color: var(--text2);
  cursor: default;
  position: relative;
  transition: background 0.1s;
  gap: 2px;
}

.cal-day.empty { }
.cal-day.other { color: oklch(35% 0.005 280); }
.cal-day.today { background: var(--gold-bg); color: var(--gold); font-weight: 500; }
.cal-day.has-booking { cursor: pointer; }
.cal-day.has-booking:hover { background: var(--surface2); }

.cal-day-num { line-height: 1; }

.cal-dots {
  display: flex; gap: 2px; align-items: center;
}
.cal-dot {
  width: 5px; height: 5px;
  border-radius: 50%;
  flex-shrink: 0;
}
.cal-dot.pending   { background: var(--pending); }
.cal-dot.confirmed { background: var(--confirmed); }
.cal-dot.completed { background: var(--completed); }
.cal-dot.cancelled { background: var(--cancelled); }

/* ─── Calendar Booking List ─────────────────────────────────────────────── */
.cal-bookings-panel {
  border-top: 1px solid var(--border);
  padding: 0.75rem;
  max-height: 260px;
  overflow-y: auto;
}

.cal-bookings-date {
  font-size: 0.75rem;
  font-weight: 500;
  color: var(--muted);
  margin-bottom: 0.5rem;
  display: flex; align-items: center; gap: 0.35rem;
}

.cal-booking-item {
  display: flex;
  align-items: center;
  gap: 0.6rem;
  padding: 0.5rem 0.6rem;
  background: var(--bg2);
  border-radius: 8px;
  margin-bottom: 0.4rem;
  border: 1px solid var(--border);
  transition: border-color 0.15s;
}
.cal-booking-item:last-child { margin-bottom: 0; }
.cal-booking-item:hover { border-color: var(--border2); }

.cal-booking-time {
  font-size: 0.75rem;
  font-weight: 500;
  color: var(--gold);
  min-width: 38px;
}

.cal-booking-info { flex: 1; min-width: 0; }
.cal-booking-name { font-size: 0.8rem; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.cal-booking-service { font-size: 0.7rem; color: var(--muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

.cal-no-bookings {
  text-align: center;
  padding: 1rem 0;
  font-size: 0.8rem;
  color: var(--muted);
}

/* ─── Empty state ───────────────────────────────────────────────────────── */
.empty-state {
  text-align: center;
  padding: 3rem 1rem;
  color: var(--muted);
}
.empty-state-icon { font-size: 2.5rem; margin-bottom: 0.75rem; opacity: 0.4; }
.empty-state-text { font-size: 0.9rem; }

/* ─── Modal ─────────────────────────────────────────────────────────────── */
.modal-overlay {
  position: fixed; inset: 0; z-index: 1000;
  background: oklch(0% 0 0 / 0.6);
  backdrop-filter: blur(4px);
  display: flex; align-items: center; justify-content: center; padding: 1rem;
  opacity: 0; pointer-events: none;
  transition: opacity 0.2s;
}
.modal-overlay.open { opacity: 1; pointer-events: auto; }

.modal {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 16px;
  width: 100%; max-width: 460px;
  transform: translateY(8px);
  transition: transform 0.2s;
  overflow: hidden;
}
.modal-overlay.open .modal { transform: translateY(0); }

.modal-header {
  padding: 1.25rem 1.5rem;
  border-bottom: 1px solid var(--border);
  display: flex; align-items: center; justify-content: space-between;
}
.modal-title {
  font-family: 'Cormorant Garamond', serif;
  font-size: 1.2rem;
  font-weight: 500;
}
.modal-close {
  width: 30px; height: 30px;
  border-radius: 7px;
  border: 1px solid var(--border);
  background: none;
  color: var(--muted);
  cursor: pointer;
  display: grid; place-items: center;
  font-size: 1rem;
  transition: background 0.15s, color 0.15s;
}
.modal-close:hover { background: var(--surface2); color: var(--text); }

.modal-body { padding: 1.5rem; }

.detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
.detail-item {}
.detail-label {
  font-size: 0.7rem;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: 0.08em;
  margin-bottom: 0.3rem;
}
.detail-value { font-size: 0.9rem; font-weight: 500; }
.detail-full { grid-column: 1 / -1; }
.detail-note {
  background: var(--bg2);
  border: 1px solid var(--border);
  border-radius: 8px;
  padding: 0.65rem 0.85rem;
  font-size: 0.875rem;
  color: var(--text2);
  line-height: 1.5;
}

.modal-footer {
  padding: 1rem 1.5rem;
  border-top: 1px solid var(--border);
  display: flex; justify-content: flex-end; gap: 0.6rem;
}

.btn { padding: 0.55rem 1.1rem; border-radius: 8px; border: 1px solid; font-family: inherit; font-size: 0.875rem; cursor: pointer; transition: opacity 0.15s; }
.btn-secondary { background: none; border-color: var(--border); color: var(--text2); }
.btn-secondary:hover { background: var(--surface2); color: var(--text); }
.btn-danger { background: oklch(18% 0.06 25); border-color: oklch(35% 0.1 25); color: var(--cancelled); }
.btn-danger:hover { opacity: 0.85; }

/* ─── Toast ─────────────────────────────────────────────────────────────── */
.toast-container { position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 2000; display: flex; flex-direction: column; gap: 0.5rem; }

.toast {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 0.7rem 1rem;
  font-size: 0.85rem;
  display: flex; align-items: center; gap: 0.5rem;
  box-shadow: 0 4px 20px oklch(0% 0 0 / 0.3);
  transform: translateX(100%);
  transition: transform 0.3s ease;
  max-width: 280px;
}
.toast.show { transform: translateX(0); }
.toast.success { border-left: 3px solid var(--completed); }
.toast.error   { border-left: 3px solid var(--cancelled); }

/* ─── Scrollbar ─────────────────────────────────────────────────────────── */
::-webkit-scrollbar { width: 5px; height: 5px; }
::-webkit-scrollbar-track { background: transparent; }
::-webkit-scrollbar-thumb { background: var(--border); border-radius: 3px; }
::-webkit-scrollbar-thumb:hover { background: var(--border2); }

/* ─── Responsive ────────────────────────────────────────────────────────── */
@media (max-width: 1200px) {
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .grid-main { grid-template-columns: 1fr; }
}

@media (max-width: 768px) {
  :root { --sidebar-w: 0px; }
  .sidebar { display: none; }
  .main { margin-left: 0; }
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
  .content { padding: 1rem; }
}
</style>
</head>
<body>
<div class="layout">

  {{-- Sidebar --}}
  <aside class="sidebar">
    <div class="sidebar-brand">
      <div class="brand-icon">💅</div>
      <div class="brand-text">
        <div class="brand-name">LUTRA Beauty</div>
        <div class="brand-sub">Admin</div>
      </div>
    </div>

    <nav class="sidebar-nav">
      <div class="nav-section">Quản lý</div>
      <a href="{{ route('admin.bookings.index') }}" class="nav-item active">
        <span class="icon">📋</span> Lịch hẹn
      </a>

      <div class="nav-section" style="margin-top:1rem">Liên kết</div>
      <a href="{{ url('/') }}" target="_blank" class="nav-item">
        <span class="icon">🌐</span> Trang chủ
      </a>
    </nav>

    <div class="sidebar-footer">
      <form method="POST" action="{{ route('admin.logout') }}">
        @csrf
        <button type="submit" class="logout-btn">
          <span>🚪</span> Đăng xuất
        </button>
      </form>
    </div>
  </aside>

  {{-- Main --}}
  <div class="main">
    <header class="topbar">
      <div class="page-title">Lịch hẹn</div>
      <div class="topbar-right">
        <span class="badge-live">Hoạt động</span>
        <span style="font-size:0.8rem;color:var(--muted)">{{ session('admin_email') }}</span>
      </div>
    </header>

    <div class="content">

      {{-- Stats --}}
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon gold">📅</div>
          <div class="stat-info">
            <div class="stat-value">{{ $stats['total'] }}</div>
            <div class="stat-label">Tổng lịch hẹn</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon blue">🗓️</div>
          <div class="stat-info">
            <div class="stat-value">{{ $stats['today'] }}</div>
            <div class="stat-label">Hôm nay</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon yellow">⏳</div>
          <div class="stat-info">
            <div class="stat-value">{{ $stats['pending'] }}</div>
            <div class="stat-label">Chờ xác nhận</div>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-icon green">✅</div>
          <div class="stat-info">
            <div class="stat-value">{{ $stats['confirmed'] }}</div>
            <div class="stat-label">Đã xác nhận</div>
          </div>
        </div>
      </div>

      {{-- Main grid --}}
      <div class="grid-main">

        {{-- Booking table --}}
        <div class="card">
          <div class="card-header">
            <div class="card-header-title">📋 Danh sách lịch hẹn</div>
            <form method="GET" action="{{ route('admin.bookings.index') }}" class="filter-bar" id="filterForm">
              <input type="text" name="search" class="filter-input"
                     placeholder="Tên, số điện thoại..."
                     value="{{ request('search') }}">

              <select name="status" class="filter-select">
                <option value="">Tất cả trạng thái</option>
                <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>Chờ xác nhận</option>
                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
              </select>

              <select name="service" class="filter-select">
                <option value="">Tất cả dịch vụ</option>
                @foreach ($services as $svc)
                <option value="{{ $svc }}" {{ request('service') === $svc ? 'selected' : '' }}>{{ $svc }}</option>
                @endforeach
              </select>

              <input type="date" name="date" class="filter-input" style="min-width:auto"
                     value="{{ request('date') }}">

              <button type="submit" class="btn-filter">Lọc</button>
              @if (request()->hasAny(['search','status','service','date']))
              <a href="{{ route('admin.bookings.index') }}" class="btn-reset">✕ Xoá</a>
              @endif

              <input type="hidden" name="cal_month" value="{{ $calMonth }}">
            </form>
          </div>

          <div class="table-wrap">
            @if ($bookings->count())
            <table>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Khách hàng</th>
                  <th>Dịch vụ</th>
                  <th>Ngày</th>
                  <th>Giờ</th>
                  <th>Chi nhánh</th>
                  <th>Trạng thái</th>
                  <th>Hành động</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($bookings as $booking)
                <tr id="row-{{ $booking->id }}">
                  <td style="color:var(--muted);font-size:0.78rem">{{ $booking->id }}</td>
                  <td>
                    <div class="td-name">{{ $booking->name }}</div>
                    <div class="td-phone">{{ $booking->phone }}</div>
                  </td>
                  <td class="td-service">{{ $booking->service }}</td>
                  <td class="td-date">{{ $booking->date->format('d/m/Y') }}</td>
                  <td class="td-time">{{ $booking->time }}</td>
                  <td class="td-branch">{{ $booking->branch }}</td>
                  <td>
                    <select class="status-select" data-id="{{ $booking->id }}"
                            onchange="updateStatus(this)">
                      <option value="pending"   {{ $booking->status === 'pending'   ? 'selected' : '' }}>⏳ Chờ</option>
                      <option value="confirmed" {{ $booking->status === 'confirmed' ? 'selected' : '' }}>✅ Xác nhận</option>
                      <option value="completed" {{ $booking->status === 'completed' ? 'selected' : '' }}>🎉 Hoàn thành</option>
                      <option value="cancelled" {{ $booking->status === 'cancelled' ? 'selected' : '' }}>❌ Hủy</option>
                    </select>
                  </td>
                  <td>
                    <div class="actions">
                      <a class="btn-icon call" href="tel:{{ $booking->phone }}" title="Gọi {{ $booking->phone }}">📞</a>
                      <button class="btn-icon view" title="Xem chi tiết"
                              onclick="viewBooking({{ $booking->id }})">👁</button>
                      <button class="btn-icon delete" title="Xoá lịch hẹn"
                              onclick="deleteBooking({{ $booking->id }}, '{{ addslashes($booking->name) }}')">🗑</button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <div class="empty-state">
              <div class="empty-state-icon">📭</div>
              <div class="empty-state-text">Không có lịch hẹn nào</div>
            </div>
            @endif
          </div>

          @if ($bookings->hasPages())
          <div class="pagination-wrap">
            <span>Hiển thị {{ $bookings->firstItem() }}–{{ $bookings->lastItem() }} / {{ $bookings->total() }}</span>
            <div class="pagination">
              {{-- Previous --}}
              @if ($bookings->onFirstPage())
                <span class="disabled">‹</span>
              @else
                <a href="{{ $bookings->previousPageUrl() }}">‹</a>
              @endif

              {{-- Pages --}}
              @foreach ($bookings->getUrlRange(max(1, $bookings->currentPage()-2), min($bookings->lastPage(), $bookings->currentPage()+2)) as $page => $url)
                @if ($page == $bookings->currentPage())
                  <span class="active">{{ $page }}</span>
                @else
                  <a href="{{ $url }}">{{ $page }}</a>
                @endif
              @endforeach

              {{-- Next --}}
              @if ($bookings->hasMorePages())
                <a href="{{ $bookings->nextPageUrl() }}">›</a>
              @else
                <span class="disabled">›</span>
              @endif
            </div>
          </div>
          @endif
        </div>

        {{-- Calendar card --}}
        <div>
          <div class="card">
            @php
              $prevMonth = \Carbon\Carbon::parse($calMonth . '-01')->subMonth()->format('Y-m');
              $nextMonth = \Carbon\Carbon::parse($calMonth . '-01')->addMonth()->format('Y-m');
              $today     = \Carbon\Carbon::today();

              // Build calendar days
              $firstDay  = $calStart->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
              $lastDay   = $calStart->copy()->endOfMonth()->endOfWeek(\Carbon\Carbon::SUNDAY);
              $days = [];
              $cur  = $firstDay->copy();
              while ($cur <= $lastDay) {
                $days[] = $cur->copy();
                $cur->addDay();
              }
            @endphp

            <div class="cal-header">
              <div class="card-header-title" style="font-size:0.85rem">📆 Lịch tháng</div>
              <div class="cal-nav">
                <a href="{{ request()->fullUrlWithQuery(['cal_month' => $prevMonth]) }}"
                   class="cal-nav-btn" title="Tháng trước">‹</a>
                <div class="cal-month-title">
                  {{ $calStart->isoFormat('MMMM YYYY') }}
                </div>
                <a href="{{ request()->fullUrlWithQuery(['cal_month' => $nextMonth]) }}"
                   class="cal-nav-btn" title="Tháng sau">›</a>
              </div>
            </div>

            <div class="cal-body">
              <div class="cal-weekdays">
                @foreach(['T2','T3','T4','T5','T6','T7','CN'] as $wd)
                <div class="cal-weekday">{{ $wd }}</div>
                @endforeach
              </div>

              <div class="cal-grid">
                @foreach ($days as $day)
                  @php
                    $key       = $day->format('Y-m-d');
                    $isToday   = $day->isSameDay($today);
                    $isMonth   = $day->month === $calStart->month;
                    $dayBooks  = $calBookings[$key] ?? collect();
                    $classes   = 'cal-day';
                    if (!$isMonth)   $classes .= ' other';
                    if ($isToday)    $classes .= ' today';
                    if ($dayBooks->count()) $classes .= ' has-booking';

                    // Collect status colors for dots (max 3 unique)
                    $dotStatuses = $dayBooks->pluck('status')->unique()->take(3);
                  @endphp
                  <div class="{{ $classes }}"
                       @if($dayBooks->count()) onclick="showCalDay('{{ $key }}', '{{ $day->format('d/m/Y') }}')" title="{{ $dayBooks->count() }} lịch hẹn" @endif>
                    <div class="cal-day-num">{{ $day->day }}</div>
                    @if($dayBooks->count())
                    <div class="cal-dots">
                      @foreach($dotStatuses as $st)
                      <div class="cal-dot {{ $st }}"></div>
                      @endforeach
                    </div>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>

            {{-- Legend --}}
            <div style="padding:0.5rem 0.75rem 0.75rem; display:flex; gap:0.75rem; flex-wrap:wrap">
              @foreach([['pending','Chờ'],['confirmed','Xác nhận'],['completed','Xong'],['cancelled','Hủy']] as [$s,$l])
              <div style="display:flex;align-items:center;gap:0.3rem;font-size:0.7rem;color:var(--muted)">
                <div class="cal-dot {{ $s }}"></div> {{ $l }}
              </div>
              @endforeach
            </div>

            {{-- Selected day bookings panel --}}
            <div class="cal-bookings-panel" id="calPanel">
              <div class="cal-no-bookings">Chọn ngày để xem lịch hẹn</div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

{{-- Detail Modal --}}
<div class="modal-overlay" id="detailModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title">Chi tiết lịch hẹn</div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-body" id="modalBody">
      <div style="text-align:center;padding:2rem;color:var(--muted)">Đang tải...</div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" onclick="closeModal()">Đóng</button>
      <button class="btn btn-danger" id="modalDeleteBtn">🗑 Xoá</button>
    </div>
  </div>
</div>

{{-- Toast container --}}
<div class="toast-container" id="toastContainer"></div>

{{-- Calendar data --}}
<script>
const CAL_DATA = @json($calData);
</script>

<script>
const CSRF = document.querySelector('meta[name="csrf-token"]').content;

// ── Toast ──────────────────────────────────────────────
function showToast(msg, type = 'success') {
  const el = document.createElement('div');
  el.className = `toast ${type}`;
  el.textContent = (type === 'success' ? '✓ ' : '✗ ') + msg;
  document.getElementById('toastContainer').appendChild(el);
  requestAnimationFrame(() => el.classList.add('show'));
  setTimeout(() => {
    el.classList.remove('show');
    setTimeout(() => el.remove(), 300);
  }, 3000);
}

// ── Update status ──────────────────────────────────────
async function updateStatus(select) {
  const id     = select.dataset.id;
  const status = select.value;
  try {
    const res = await fetch(`/admin/bookings/${id}/status`, {
      method:  'PATCH',
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
      body:    JSON.stringify({ status }),
    });
    const data = await res.json();
    if (data.success) {
      showToast('Đã cập nhật trạng thái');
    } else {
      showToast('Cập nhật thất bại', 'error');
    }
  } catch {
    showToast('Lỗi kết nối', 'error');
  }
}

// ── Delete booking ─────────────────────────────────────
let pendingDeleteId = null;

function deleteBooking(id, name) {
  if (!confirm(`Xoá lịch hẹn của "${name}"?\nHành động này không thể hoàn tác.`)) return;
  doDelete(id);
}

async function doDelete(id) {
  try {
    const res = await fetch(`/admin/bookings/${id}`, {
      method:  'DELETE',
      headers: { 'X-CSRF-TOKEN': CSRF },
    });
    const data = await res.json();
    if (data.success) {
      const row = document.getElementById(`row-${id}`);
      if (row) {
        row.style.transition = 'opacity 0.3s';
        row.style.opacity    = '0';
        setTimeout(() => { row.remove(); showToast('Đã xoá lịch hẹn'); }, 300);
      } else {
        showToast('Đã xoá lịch hẹn');
      }
      closeModal();
    } else {
      showToast('Xoá thất bại', 'error');
    }
  } catch {
    showToast('Lỗi kết nối', 'error');
  }
}

// ── View detail modal ──────────────────────────────────
const STATUS_COLORS = {
  pending:   'badge-pending',
  confirmed: 'badge-confirmed',
  completed: 'badge-completed',
  cancelled: 'badge-cancelled',
};

async function viewBooking(id) {
  openModal();
  pendingDeleteId = id;
  document.getElementById('modalDeleteBtn').onclick = () => deleteBooking(id, '');

  try {
    const res  = await fetch(`/admin/bookings/${id}`);
    const data = await res.json();
    document.getElementById('modalBody').innerHTML = `
      <div class="detail-grid">
        <div class="detail-item">
          <div class="detail-label">Khách hàng</div>
          <div class="detail-value">${data.name}</div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Điện thoại</div>
          <div class="detail-value"><a href="tel:${data.phone}" style="color:var(--gold);text-decoration:none">${data.phone}</a></div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Dịch vụ</div>
          <div class="detail-value">${data.service}</div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Trạng thái</div>
          <div class="detail-value"><span class="status-badge ${STATUS_COLORS[data.status]}">${data.label}</span></div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Ngày hẹn</div>
          <div class="detail-value">${data.date}</div>
        </div>
        <div class="detail-item">
          <div class="detail-label">Giờ hẹn</div>
          <div class="detail-value" style="color:var(--gold)">${data.time}</div>
        </div>
        <div class="detail-item detail-full">
          <div class="detail-label">Chi nhánh</div>
          <div class="detail-value">${data.branch}</div>
        </div>
        ${data.note ? `
        <div class="detail-item detail-full">
          <div class="detail-label">Ghi chú</div>
          <div class="detail-note">${data.note}</div>
        </div>` : ''}
        <div class="detail-item detail-full" style="border-top:1px solid var(--border);padding-top:0.75rem;margin-top:0.25rem">
          <div class="detail-label">Đặt lúc</div>
          <div class="detail-value" style="color:var(--muted);font-weight:400;font-size:0.8rem">${data.created}</div>
        </div>
      </div>
    `;
    document.getElementById('modalDeleteBtn').onclick = () => deleteBooking(id, data.name);
  } catch {
    document.getElementById('modalBody').innerHTML =
      `<div style="text-align:center;padding:2rem;color:var(--cancelled)">Không thể tải dữ liệu</div>`;
  }
}

function openModal()  { document.getElementById('detailModal').classList.add('open'); }
function closeModal() { document.getElementById('detailModal').classList.remove('open'); }

document.getElementById('detailModal').addEventListener('click', e => {
  if (e.target === e.currentTarget) closeModal();
});

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

// ── Calendar panel ─────────────────────────────────────
function showCalDay(key, label) {
  const panel    = document.getElementById('calPanel');
  const bookings = CAL_DATA[key];

  if (!bookings || bookings.length === 0) {
    panel.innerHTML = `<div class="cal-no-bookings">Không có lịch hẹn ngày ${label}</div>`;
    return;
  }

  const STATUS_CLASS = {
    pending: 'badge-pending', confirmed: 'badge-confirmed',
    completed: 'badge-completed', cancelled: 'badge-cancelled',
  };

  const items = bookings.map(b => `
    <div class="cal-booking-item" onclick="viewBooking(${b.id})" style="cursor:pointer">
      <div class="cal-booking-time">${b.time}</div>
      <div class="cal-booking-info">
        <div class="cal-booking-name">${b.name}</div>
        <div class="cal-booking-service">${b.service}</div>
      </div>
      <span class="status-badge ${STATUS_CLASS[b.status]}" style="font-size:0.65rem;padding:0.15rem 0.45rem">${b.label}</span>
    </div>
  `).join('');

  panel.innerHTML = `
    <div class="cal-bookings-date">📅 ${label} — ${bookings.length} lịch hẹn</div>
    ${items}
  `;
}
</script>
</body>
</html>
