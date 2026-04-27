<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin – LUTRA Beauty</title>
<link rel="icon" type="image/jpeg" href="/images/uploads/612365143_1328013149347255_1293637779033925772_n.png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  :root {
    --gold:    oklch(72% 0.12 65);
    --gold-d:  oklch(58% 0.10 65);
    --bg:      oklch(14% 0.01 280);
    --surface: oklch(18% 0.01 280);
    --border:  oklch(26% 0.01 280);
    --text:    oklch(92% 0.005 280);
    --muted:   oklch(60% 0.005 280);
    --red:     oklch(60% 0.18 25);
  }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
  }

  .login-wrap {
    width: 100%;
    max-width: 400px;
  }

  .brand {
    text-align: center;
    margin-bottom: 2.5rem;
  }

  .brand-logo {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 0.5rem;
  }

  .brand-icon {
    width: 44px;
    height: 44px;
    background: linear-gradient(135deg, var(--gold), var(--gold-d));
    border-radius: 10px;
    display: grid;
    place-items: center;
    font-size: 1.3rem;
  }

  .brand-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.7rem;
    font-weight: 600;
    color: var(--gold);
    letter-spacing: 0.05em;
  }

  .brand-sub {
    font-size: 0.8rem;
    color: var(--muted);
    letter-spacing: 0.15em;
    text-transform: uppercase;
  }

  .card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 2rem;
  }

  .card-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.4rem;
    font-weight: 500;
    margin-bottom: 0.25rem;
  }

  .card-desc {
    font-size: 0.85rem;
    color: var(--muted);
    margin-bottom: 1.75rem;
  }

  .field { margin-bottom: 1.25rem; }

  .field label {
    display: block;
    font-size: 0.8rem;
    font-weight: 500;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 0.5rem;
  }

  .field input {
    width: 100%;
    background: var(--bg);
    border: 1px solid var(--border);
    border-radius: 8px;
    padding: 0.7rem 1rem;
    color: var(--text);
    font-family: inherit;
    font-size: 0.95rem;
    transition: border-color 0.2s;
    outline: none;
  }

  .field input:focus { border-color: var(--gold); }
  .field input.error { border-color: var(--red); }

  .field-error {
    font-size: 0.8rem;
    color: var(--red);
    margin-top: 0.4rem;
  }

  .alert-error {
    background: oklch(22% 0.04 25);
    border: 1px solid oklch(35% 0.08 25);
    border-radius: 8px;
    padding: 0.75rem 1rem;
    font-size: 0.85rem;
    color: oklch(75% 0.14 25);
    margin-bottom: 1.25rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .btn-login {
    width: 100%;
    padding: 0.8rem;
    background: linear-gradient(135deg, var(--gold), var(--gold-d));
    border: none;
    border-radius: 8px;
    color: oklch(14% 0.01 280);
    font-family: inherit;
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: opacity 0.2s, transform 0.1s;
    margin-top: 0.5rem;
  }

  .btn-login:hover { opacity: 0.9; }
  .btn-login:active { transform: scale(0.99); }

  .back-link {
    text-align: center;
    margin-top: 1.25rem;
    font-size: 0.85rem;
  }

  .back-link a {
    color: var(--muted);
    text-decoration: none;
    transition: color 0.2s;
  }

  .back-link a:hover { color: var(--gold); }
</style>
</head>
<body>
<div class="login-wrap">
  <div class="brand">
    <div class="brand-logo">
      <div class="brand-icon">💅</div>
      <div class="brand-name">LUTRA Beauty</div>
    </div>
    <div class="brand-sub">Admin Portal</div>
  </div>

  <div class="card">
    <div class="card-title">Đăng nhập</div>
    <div class="card-desc">Quản lý lịch đặt hẹn LUTRA Beauty</div>

    @if ($errors->has('email') && !$errors->has('email', 'default'))
    <div class="alert-error">⚠ {{ $errors->first('email') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
      @csrf

      <div class="field">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}"
               placeholder="admin@lutrabeauty.com"
               class="{{ $errors->has('email') ? 'error' : '' }}"
               autocomplete="email" autofocus>
        @error('email') <div class="field-error">{{ $message }}</div> @enderror
      </div>

      <div class="field">
        <label>Mật khẩu</label>
        <input type="password" name="password"
               placeholder="••••••••"
               class="{{ $errors->has('password') ? 'error' : '' }}"
               autocomplete="current-password">
        @error('password') <div class="field-error">{{ $message }}</div> @enderror
      </div>

      <button type="submit" class="btn-login">Đăng nhập</button>
    </form>
  </div>

  <div class="back-link">
    <a href="{{ url('/') }}">← Quay về trang chủ</a>
  </div>
</div>
</body>
</html>
