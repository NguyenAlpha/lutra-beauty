<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LUTRA Beauty – Nail & Beauty Studio TP.HCM</title>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  :root {
    --mint:       oklch(0.70 0.08 148);
    --mint-light: oklch(0.94 0.025 148);
    --mint-mid:   oklch(0.82 0.055 148);
    --mint-dark:  oklch(0.40 0.11 148);
    --gold:       oklch(0.72 0.09 85);
    --white:      oklch(0.99 0.003 148);
    --off-white:  oklch(0.965 0.01 148);
    --dark:       oklch(0.16 0.018 148);
    --text:       oklch(0.32 0.015 148);
    --text-light: oklch(0.55 0.012 148);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--white);
    color: var(--dark);
    font-size: 16px;
    line-height: 1.6;
    overflow-x: hidden;
  }

  /* NAV */
  nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 48px;
    height: 72px;
    background: rgba(255,255,255,0.92);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid oklch(0.92 0.03 172);
    transition: all 0.3s;
  }
  .nav-logo {
    font-family: 'Cormorant Garamond', serif;
    font-size: 24px; font-weight: 500; letter-spacing: 0.18em; font-style: italic;
    color: var(--dark); text-decoration: none;
    display: flex; align-items: center; gap: 10px;
  }
  .nav-logo span { color: var(--mint-dark); }
  .nav-links { display: flex; gap: 36px; list-style: none; }
  .nav-links a {
    font-size: 13px; letter-spacing: 0.08em; text-transform: uppercase;
    color: var(--text); text-decoration: none; font-weight: 500;
    transition: color 0.2s;
  }
  .nav-links a:hover { color: var(--mint-dark); }
  .nav-cta {
    background: var(--mint-dark); color: white;
    padding: 10px 24px; border-radius: 50px;
    font-size: 13px; letter-spacing: 0.08em; text-transform: uppercase;
    text-decoration: none; font-weight: 500; transition: background 0.2s;
    white-space: nowrap;
  }
  .nav-cta:hover { background: var(--dark); }

  .nav-mobile-toggle {
    display: none; background: none; border: none; cursor: pointer;
    flex-direction: column; gap: 5px; padding: 4px;
  }
  .nav-mobile-toggle span {
    display: block; width: 24px; height: 1.5px; background: var(--dark);
    transition: all 0.3s;
  }

  /* HERO */
  #hero {
    height: 100vh; min-height: 600px;
    position: relative; display: flex; align-items: center;
    overflow: hidden;
  }
  .hero-slider {
    position: absolute; inset: 0;
  }
  .hero-slide {
    position: absolute; inset: 0; opacity: 0; transition: opacity 1s ease;
  }
  .hero-slide.active { opacity: 1; }
  .hero-slide img {
    width: 100%; height: 100%; object-fit: cover; object-position: center;
  }
  .hero-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(120deg, rgba(10,30,25,0.68) 0%, rgba(10,30,25,0.25) 60%, transparent 100%);
  }
  .hero-content {
    position: relative; z-index: 2; padding: 0 80px;
    max-width: 700px;
  }
  .hero-eyebrow {
    font-size: 12px; letter-spacing: 0.22em; text-transform: uppercase;
    color: var(--mint); font-weight: 400; margin-bottom: 20px;
    display: flex; align-items: center; gap: 12px;
  }
  .hero-eyebrow::before {
    content: ''; display: block; width: 40px; height: 1px; background: var(--mint);
  }
  .hero-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(56px, 7.5vw, 96px); font-weight: 300; line-height: 1.12;
    color: white; letter-spacing: 0.01em; font-style: italic;
    margin-bottom: 24px;
  }
  .hero-title em { font-style: italic; color: var(--mint); }
  .hero-sub {
    font-size: 16px; color: rgba(255,255,255,0.78); font-weight: 300;
    margin-bottom: 40px; max-width: 440px; line-height: 1.85; letter-spacing: 0.01em;
  }
  .hero-actions { display: flex; gap: 16px; flex-wrap: wrap; }
  .btn-primary {
    background: var(--mint-dark); color: white;
    padding: 15px 36px; border-radius: 50px;
    font-size: 13px; letter-spacing: 0.1em; text-transform: uppercase;
    text-decoration: none; font-weight: 500; transition: all 0.2s;
    border: none; cursor: pointer;
  }
  .btn-primary:hover { background: white; color: var(--dark); }
  .btn-outline {
    background: transparent; color: white;
    padding: 15px 36px; border-radius: 50px;
    font-size: 13px; letter-spacing: 0.1em; text-transform: uppercase;
    text-decoration: none; font-weight: 500; transition: all 0.2s;
    border: 1px solid rgba(255,255,255,0.5); cursor: pointer;
  }
  .btn-outline:hover { border-color: white; background: rgba(255,255,255,0.1); }

  /* HERO DOTS */
  .hero-dots {
    position: absolute; bottom: 36px; left: 80px; z-index: 3;
    display: flex; gap: 8px;
  }
  .hero-dot {
    width: 24px; height: 2px; background: rgba(255,255,255,0.35);
    border: none; cursor: pointer; transition: all 0.3s;
    border-radius: 1px;
  }
  .hero-dot.active { background: var(--mint); width: 48px; }

  /* SECTION SHARED */
  section { padding: 100px 80px; }
  .section-eyebrow {
    font-size: 10px; letter-spacing: 0.30em; text-transform: uppercase;
    color: var(--mint-dark); font-weight: 500; margin-bottom: 16px;
  }
  .section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(40px, 4.5vw, 62px); font-weight: 300; line-height: 1.08;
    color: var(--dark); margin-bottom: 20px; font-style: italic;
  }
  .section-title em { font-style: italic; color: var(--mint-dark); }
  .section-sub {
    font-size: 15px; color: var(--text-light); max-width: 560px;
    font-weight: 300; line-height: 1.85; letter-spacing: 0.01em;
  }
  .divider {
    width: 48px; height: 1px; background: var(--mint);
    margin: 28px 0;
  }

  /* ABOUT STRIP */
  #about {
    background: var(--mint-light);
    padding: 64px 80px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 48px;
  }
  .about-stat { text-align: center; flex: 1; }
  .about-stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 56px; font-weight: 300; color: var(--mint-dark);
    line-height: 1;
  }
  .about-stat-label {
    font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--text-light); margin-top: 8px;
  }
  .about-divider { width: 1px; height: 64px; background: oklch(0.78 0.06 172); }

  /* SERVICES */
  #services { background: var(--white); }
  .services-header { max-width: 560px; margin-bottom: 64px; }
  .services-grid {
    display: grid;
    grid-template-columns: 1.15fr 1fr 1fr;
    grid-template-rows: 340px 340px;
    gap: 3px;
  }
  .service-card {
    position: relative; overflow: hidden; cursor: pointer;
  }
  .service-card.featured { grid-row: 1 / 3; }
  .service-card img {
    width: 100%; height: 100%; object-fit: cover; object-position: center;
    transition: transform 0.65s cubic-bezier(0.25,0.46,0.45,0.94);
    display: block;
  }
  .service-card:hover img { transform: scale(1.07); }
  .service-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(8,24,20,0.82) 0%, rgba(8,24,20,0.18) 55%, transparent 100%);
    display: flex; flex-direction: column; justify-content: flex-end;
    padding: 32px 28px;
    transition: background 0.4s;
  }
  .service-card:hover .service-overlay {
    background: linear-gradient(to top, rgba(8,24,20,0.92) 0%, rgba(8,24,20,0.35) 70%, transparent 100%);
  }
  .service-num {
    font-size: 11px; letter-spacing: 0.2em; color: var(--mint);
    font-weight: 400; margin-bottom: 8px; opacity: 0.9;
  }
  .service-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px; font-weight: 400; color: white; letter-spacing: 0.02em;
    line-height: 1.1; margin-bottom: 0;
    transition: margin-bottom 0.3s;
  }
  .service-card.featured .service-name { font-size: 38px; }
  .service-desc {
    font-size: 13px; color: rgba(255,255,255,0.7); font-weight: 300;
    line-height: 1.6; overflow: hidden;
    max-height: 0; margin-top: 0;
    transition: max-height 0.35s ease, margin-top 0.35s ease;
  }
  .service-card:hover .service-desc { max-height: 80px; margin-top: 10px; }
  .service-line {
    width: 0; height: 1px; background: var(--mint);
    margin-top: 16px;
    transition: width 0.4s ease;
  }
  .service-card:hover .service-line { width: 40px; }

  /* GALLERY */
  #gallery {
    background: var(--off-white);
    padding-bottom: 60px;
  }
  .gallery-header {
    display: flex; align-items: flex-end; justify-content: space-between;
    margin-bottom: 48px;
  }
  .gallery-grid {
    display: grid;
    grid-template-columns: 1.4fr 1fr 1fr;
    grid-template-rows: 300px 300px;
    gap: 3px;
  }
  .gallery-item {
    overflow: hidden; position: relative;
    clip-path: inset(100% 0 0 0);
    transition: clip-path 0.9s cubic-bezier(0.16,1,0.3,1), transform 0.6s ease;
  }
  .gallery-item.visible { clip-path: inset(0% 0 0 0); }
  .gallery-item:nth-child(1) { transition-delay: 0s; }
  .gallery-item:nth-child(2) { transition-delay: 0.10s; }
  .gallery-item:nth-child(3) { transition-delay: 0.18s; }
  .gallery-item:nth-child(4) { transition-delay: 0.28s; }
  .gallery-item:nth-child(5) { transition-delay: 0.38s; }
  .gallery-item:first-child { grid-row: 1 / 3; }
  .gallery-item img {
    width: 100%; height: 100%; object-fit: cover; object-position: center;
    transition: transform 0.6s ease;
  }
  .gallery-item:hover img { transform: scale(1.06); }

  /* BOOKING */
  #booking {
    background: var(--mint-light);
    display: grid; grid-template-columns: 1fr 1fr; gap: 80px;
    align-items: center;
  }
  .booking-form {
    background: white; padding: 48px; border-radius: 24px;
    box-shadow: 0 12px 64px rgba(0,80,60,0.13);
  }
  .form-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 32px; font-weight: 400; color: var(--dark);
    margin-bottom: 32px;
  }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
  .form-group { margin-bottom: 16px; }
  .form-group label {
    display: block; font-size: 11px; letter-spacing: 0.12em;
    text-transform: uppercase; color: var(--text-light);
    margin-bottom: 8px; font-weight: 500;
  }
  .form-group input, .form-group select, .form-group textarea {
    width: 100%; padding: 12px 16px;
    border: 1px solid oklch(0.88 0.03 148);
    border-radius: 12px; font-family: 'DM Sans', sans-serif;
    font-size: 14px; color: var(--dark); background: white;
    transition: border-color 0.2s; outline: none;
    -webkit-appearance: none;
  }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
    border-color: var(--mint-dark);
  }
  .form-group textarea { resize: none; height: 80px; }
  .form-submit {
    width: 100%; padding: 15px; background: var(--mint-dark); color: white;
    border: none; border-radius: 50px; cursor: pointer;
    font-size: 13px; letter-spacing: 0.1em; text-transform: uppercase;
    font-family: 'DM Sans', sans-serif; font-weight: 500;
    transition: background 0.2s; margin-top: 8px;
  }
  .form-submit:hover { background: var(--dark); }
  .form-success {
    display: none; text-align: center; padding: 40px 20px;
  }
  .form-success-icon { font-size: 48px; margin-bottom: 16px; }
  .form-success-text {
    font-family: 'Cormorant Garamond', serif;
    font-size: 26px; color: var(--mint-dark);
  }

  .booking-info { }
  .booking-info .section-title { margin-bottom: 32px; }
  .info-item {
    display: flex; gap: 20px; align-items: flex-start; margin-bottom: 28px;
  }
  .info-icon {
    width: 44px; height: 44px; border-radius: 50%;
    background: white; display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 18px;
    box-shadow: 0 2px 12px rgba(0,80,60,0.12);
  }
  .info-label {
    font-size: 11px; letter-spacing: 0.12em; text-transform: uppercase;
    color: var(--mint-dark); font-weight: 500; margin-bottom: 4px;
  }
  .info-value { font-size: 15px; color: var(--dark); line-height: 1.6; }
  .contact-buttons { display: flex; gap: 12px; margin-top: 36px; flex-wrap: wrap; }
  .contact-btn {
    display: flex; align-items: center; gap: 10px;
    padding: 13px 24px; border-radius: 50px; text-decoration: none;
    font-size: 13px; font-weight: 500; letter-spacing: 0.04em;
    transition: all 0.2s; border: none; cursor: pointer;
  }
  .btn-zalo { background: #0068FF; color: white; }
  .btn-zalo:hover { background: #0052cc; }
  .btn-facebook { background: #1877F2; color: white; }
  .btn-facebook:hover { background: #1465d0; }
  .btn-phone { background: var(--mint-dark); color: white; }
  .btn-phone:hover { background: var(--dark); }

  /* MAP */
  #map-section {
    padding: 0;
    display: grid; grid-template-columns: 1fr 1fr;
    height: 440px;
  }
  .map-frame { width: 100%; height: 100%; border: 0; display: block; }
  .map-info {
    background: var(--dark); color: white;
    padding: 64px 64px; display: flex; flex-direction: column;
    justify-content: center;
  }
  .map-info-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 32px; font-weight: 300; margin-bottom: 32px;
    color: white; font-style: italic;
  }
  .branch {
    margin-bottom: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
  }
  .branch:last-child { border-bottom: none; margin-bottom: 0; }
  .branch-name {
    font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase;
    color: var(--mint); margin-bottom: 8px; font-weight: 500;
  }
  .branch-addr {
    font-size: 14px; color: rgba(255,255,255,0.75); line-height: 1.6;
  }
  .branch-addr a {
    color: var(--mint); text-decoration: none; font-size: 12px;
    letter-spacing: 0.05em; display: inline-block; margin-top: 6px;
  }

  /* FOOTER */
  footer {
    background: var(--dark); padding: 60px 80px 36px;
    border-top: 1px solid rgba(255,255,255,0.06);
  }
  .footer-top {
    display: grid; grid-template-columns: 1.5fr 1fr 1fr;
    gap: 64px; margin: 100px 0px 48px;
  }
  .footer-brand-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 28px; font-weight: 400; color: white;
    letter-spacing: 0.1em; margin-bottom: 16px; font-style: italic;
  }
  .footer-brand-name span { color: var(--mint); }
  .footer-tagline {
    font-size: 13px; color: rgba(255,255,255,0.45);
    font-weight: 300; line-height: 1.7; max-width: 260px;
  }
  .footer-col-title {
    font-size: 11px; letter-spacing: 0.15em; text-transform: uppercase;
    color: var(--mint); font-weight: 500; margin-bottom: 20px;
  }
  .footer-links { list-style: none; }
  .footer-links li { margin-bottom: 10px; }
  .footer-links a {
    font-size: 13px; color: rgba(255,255,255,0.55); text-decoration: none;
    transition: color 0.2s;
  }
  .footer-links a:hover { color: var(--mint); }
  .footer-bottom {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 28px; border-top: 1px solid rgba(255,255,255,0.08);
    font-size: 12px; color: rgba(255,255,255,0.3);
  }
  .footer-social { display: flex; gap: 16px; }
  .footer-social a {
    width: 36px; height: 36px; border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.15);
    display: flex; align-items: center; justify-content: center;
    color: rgba(255,255,255,0.5); text-decoration: none;
    font-size: 14px; transition: all 0.2s;
  }
  .footer-social a:hover { border-color: var(--mint); color: var(--mint); }

  /* FLOATING CTA */
  .float-cta {
    position: fixed; bottom: 28px; right: 28px; z-index: 50;
    display: flex; flex-direction: column; gap: 10px;
    align-items: flex-end;
  }
  .float-btn {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 18px; border-radius: 50px !important;
    text-decoration: none; font-size: 13px; font-weight: 500;
    box-shadow: 0 4px 24px rgba(0,0,0,0.2);
    transition: all 0.2s; white-space: nowrap;
    transform: translateX(calc(100% + 28px));
    opacity: 0;
  }
  .float-btn.show { transform: translateX(0); opacity: 1; }
  .float-btn.zalo { background: #0068FF; color: white; transition-delay: 0s; }
  .float-btn.fb { background: #1877F2; color: white; transition-delay: 0.05s; }
  .float-toggle {
    width: 52px; height: 52px; border-radius: 50%;
    background: var(--mint-dark); color: white; border: none; cursor: pointer;
    font-size: 20px; display: flex; align-items: center; justify-content: center;
    box-shadow: 0 4px 20px rgba(0,80,60,0.35);
    transition: all 0.2s;
  }
  .float-toggle:hover { background: var(--dark); transform: scale(1.05); }
  .float-toggle .open { display: block; }
  .float-toggle .close { display: none; }
  .float-toggle.active .open { display: none; }
  .float-toggle.active .close { display: block; }

  /* NOTIFICATION */
  .notification {
    position: fixed; top: 88px; right: 24px; z-index: 200;
    background: white; border-left: 3px solid var(--mint-dark);
    padding: 16px 20px; border-radius: 2px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.1);
    font-size: 14px; color: var(--dark);
    transform: translateX(calc(100% + 40px)); opacity: 0;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    max-width: 320px;
  }
  .notification.show { transform: translateX(0); opacity: 1; }

  /* ===== ANIMATIONS ===== */
  .fade-up {
    opacity: 0; transform: translateY(36px);
    transition: opacity 0.8s cubic-bezier(0.16,1,0.3,1), transform 0.8s cubic-bezier(0.16,1,0.3,1);
  }
  .fade-up.visible { opacity: 1; transform: translateY(0); }

  /* Hero entrance */
  .hero-eyebrow  { opacity: 0; transform: translateY(20px); animation: heroIn 0.9s cubic-bezier(0.16,1,0.3,1) 0.3s forwards; }
  .hero-title    { opacity: 0; transform: translateY(28px); animation: heroIn 1.0s cubic-bezier(0.16,1,0.3,1) 0.5s forwards; }
  .hero-sub      { opacity: 0; transform: translateY(22px); animation: heroIn 0.9s cubic-bezier(0.16,1,0.3,1) 0.75s forwards; }
  .hero-actions  { opacity: 0; transform: translateY(18px); animation: heroIn 0.9s cubic-bezier(0.16,1,0.3,1) 0.95s forwards; }
  @keyframes heroIn { to { opacity: 1; transform: translateY(0); } }

  /* Divider draw */
  .divider {
    width: 0 !important; height: 1px; background: var(--mint);
    margin: 28px 0;
    transition: width 1s cubic-bezier(0.16,1,0.3,1);
  }
  .divider.visible { width: 48px !important; }

  /* Counter numbers */
  .about-stat-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: 56px; font-weight: 300; color: var(--mint-dark);
    line-height: 1;
    transition: opacity 0.4s;
  }

  /* Nav scroll shadow */
  nav.scrolled {
    box-shadow: 0 2px 32px rgba(0,0,0,0.08);
  }

  /* Service card stagger */
  .services-grid .service-card:nth-child(1) { transition-delay: 0s; }
  .services-grid .service-card:nth-child(2) { transition-delay: 0.1s; }
  .services-grid .service-card:nth-child(3) { transition-delay: 0.18s; }
  .services-grid .service-card:nth-child(4) { transition-delay: 0.26s; }
  .services-grid .service-card:nth-child(5) { transition-delay: 0.34s; }

  /* Booking form slide-in */
  .booking-form {
    opacity: 0; transform: translateX(32px);
    transition: opacity 0.9s cubic-bezier(0.16,1,0.3,1) 0.2s, transform 0.9s cubic-bezier(0.16,1,0.3,1) 0.2s;
  }
  .booking-form.visible { opacity: 1; transform: translateX(0); }

  /* Stat count-up flash */
  @keyframes countPop { 0%,100% { transform: scale(1); } 50% { transform: scale(1.12); } }
  .about-stat-num.pop { animation: countPop 0.4s ease; }

  /* RESPONSIVE */
  @media (max-width: 1024px) {
    nav { padding: 0 24px; }
    section { padding: 80px 32px; }
    #about { padding: 48px 32px; }
    .hero-content { padding: 0 40px; }
    .hero-dots { left: 40px; }
    .services-grid { grid-template-columns: 1fr 1fr; grid-template-rows: 260px 260px; }
    .service-card.featured { grid-row: 1; grid-column: 1 / 3; }
    #booking { grid-template-columns: 1fr; gap: 48px; }
    #map-section { grid-template-columns: 1fr; height: auto; }
    .map-frame { height: 300px; }
    .map-info { padding: 48px 32px; }
    footer { padding: 48px 32px 24px; }
    .footer-top { grid-template-columns: 1fr 1fr; gap: 40px; }
  }
  @media (max-width: 768px) {
    .nav-links, .nav-cta { display: none; }
    .nav-mobile-toggle { display: flex; }
    .hero-content { padding: 0 24px; max-width: 100%; }
    .hero-dots { left: 24px; }
    section { padding: 64px 24px; }
    #about { flex-wrap: wrap; padding: 40px 24px; gap: 28px; }
    .about-divider { display: none; }
    .services-grid { grid-template-columns: 1fr 1fr; }
    .gallery-grid { grid-template-columns: 1fr 1fr; grid-template-rows: 200px 200px 200px; }
    .gallery-item:first-child { grid-row: 1; }
    .booking-form { padding: 28px 24px; }
    .form-row { grid-template-columns: 1fr; }
    .gallery-header { flex-direction: column; align-items: flex-start; gap: 16px; }
    footer { padding: 40px 24px 20px; }
    .footer-top { grid-template-columns: 1fr; gap: 28px; }
    .footer-bottom { flex-direction: column; gap: 16px; text-align: center; }
    #map-section { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav id="navbar">
  <a href="#" class="nav-logo">LUTRA <span>Beauty</span></a>
  <ul class="nav-links">
    <li><a href="#services">Dịch Vụ</a></li>
    <li><a href="#gallery">Tác Phẩm</a></li>
    <li><a href="#booking">Đặt Lịch</a></li>
    <li><a href="#map-section">Chi Nhánh</a></li>
  </ul>
  <a href="#booking" class="nav-cta">Đặt Lịch Ngay</a>
  <button class="nav-mobile-toggle" onclick="toggleMobileMenu()" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- HERO -->
<section id="hero">
  <div class="hero-slider">
    <div class="hero-slide active">
      <img src="{{ asset('images/uploads/656822071_1392452999569936_7655083812312432656_n.jpg') }}" alt="Nail Art LUTRA Beauty">
    </div>
    <div class="hero-slide">
      <img src="{{ asset('images/uploads/674586843_1411190274362875_8259045166252610272_n.jpg') }}" alt="Nail Art LUTRA Beauty">
    </div>
    <div class="hero-slide">
      <img src="{{ asset('images/uploads/678905858_1412856530862916_4924077008544793857_n.jpg') }}" alt="Nail Art LUTRA Beauty">
    </div>
    <div class="hero-slide">
      <img src="{{ asset('images/uploads/675208414_1412856537529582_6285410571894616874_n.jpg') }}" alt="Nail Art LUTRA Beauty">
    </div>
  </div>
  <div class="hero-overlay"></div>
  <div class="hero-content">
    <p class="hero-eyebrow">Nail & Beauty Studio · TP. Hồ Chí Minh</p>
    <h1 class="hero-title">Vẻ Đẹp <em>Hoàn Hảo</em><br>Từng Chi Tiết</h1>
    <p class="hero-sub">Không gian làm đẹp sang trọng với đội ngũ nghệ nhân chuyên nghiệp. Mỗi bộ nail là một tác phẩm nghệ thuật.</p>
    <div class="hero-actions">
      <a href="#booking" class="btn-primary">Đặt Lịch Ngay</a>
      <a href="#services" class="btn-outline">Xem Dịch Vụ</a>
    </div>
  </div>
  <div class="hero-dots">
    <button class="hero-dot active" onclick="goToSlide(0)"></button>
    <button class="hero-dot" onclick="goToSlide(1)"></button>
    <button class="hero-dot" onclick="goToSlide(2)"></button>
    <button class="hero-dot" onclick="goToSlide(3)"></button>
  </div>
</section>

<!-- ABOUT STRIP -->
<div id="about">
  <div class="about-stat fade-up">
    <div class="about-stat-num">5+</div>
    <div class="about-stat-label">Năm kinh nghiệm</div>
  </div>
  <div class="about-divider"></div>
  <div class="about-stat fade-up">
    <div class="about-stat-num">2</div>
    <div class="about-stat-label">Chi nhánh TP.HCM</div>
  </div>
  <div class="about-divider"></div>
  <div class="about-stat fade-up">
    <div class="about-stat-num">5K+</div>
    <div class="about-stat-label">Khách hàng tin tưởng</div>
  </div>
  <div class="about-divider"></div>
  <div class="about-stat fade-up">
    <div class="about-stat-num">100%</div>
    <div class="about-stat-label">Nguyên liệu an toàn</div>
  </div>
</div>

<!-- SERVICES -->
<section id="services">
  <div class="services-header fade-up">
    <p class="section-eyebrow">Dịch Vụ</p>
    <h2 class="section-title">Chăm Sóc <em>Toàn Diện</em></h2>
    <div class="divider"></div>
    <p class="section-sub">Từ nail nghệ thuật đến làm đẹp toàn thân — tất cả trong không gian thư giãn sang trọng.</p>
  </div>
  <div class="services-grid">
    <div class="service-card featured fade-up">
      <img src="{{ asset('images/uploads/675208414_1412856537529582_6285410571894616874_n-ad502744.jpg') }}" alt="Làm Nail" style="object-position: center 30%;">
      <div class="service-overlay">
        <div class="service-num">01</div>
        <div class="service-name">Làm Nail</div>
        <div class="service-desc">Nail gel, acrylic, nail art 3D, ombre, vẽ tay theo yêu cầu. Đa dạng mẫu từ tối giản đến cầu kỳ.</div>
        <div class="service-line"></div>
      </div>
    </div>
    <div class="service-card fade-up">
      <img src="{{ asset('images/uploads/27-4-2026_124849_www.instagram.com.jpeg') }}" alt="Mi" style="object-position: center 20%;">
      <div class="service-overlay">
        <div class="service-num">02</div>
        <div class="service-name">Nối Mi</div>
        <div class="service-desc">Mi Hàn Quốc, volume, Russian. Đôi mắt cuốn hút tự nhiên và bền đẹp.</div>
        <div class="service-line"></div>
      </div>
    </div>
    <div class="service-card fade-up">
      <img src="{{ asset('images/uploads/27-4-2026_125547_www.instagram.com.jpeg') }}" alt="Chân Mày" style="object-position: center 25%;">
      <div class="service-overlay">
        <div class="service-num">03</div>
        <div class="service-name">Chân Mày</div>
        <div class="service-desc">Phun chân mày giả lông, bột, sương. Định hình khuôn mặt hoàn hảo.</div>
        <div class="service-line"></div>
      </div>
    </div>
    <div class="service-card fade-up">
      <img src="{{ asset('images/uploads/27-4-2026_125331_www.instagram.com.jpeg') }}" alt="Phun Xăm" style="object-position: center 35%;">
      <div class="service-overlay">
        <div class="service-num">04</div>
        <div class="service-name">Phun Xăm</div>
        <div class="service-desc">Phun xăm thẩm mỹ môi, mí mắt. Kỹ thuật hiện đại, an toàn, tự nhiên.</div>
        <div class="service-line"></div>
      </div>
    </div>
    <div class="service-card fade-up">
      <img src="{{ asset('images/uploads/Rsadada.jpg') }}" alt="Gội Đầu" style="object-position: center 40%;">
      <div class="service-overlay">
        <div class="service-num">05</div>
        <div class="service-name">Gội Đầu</div>
        <div class="service-desc">Gội đầu thư giãn với liệu trình dưỡng tóc cao cấp. Massage đầu phục hồi tinh thần.</div>
        <div class="service-line"></div>
      </div>
    </div>
  </div>
</section>

<!-- GALLERY -->
<section id="gallery">
  <div class="gallery-header">
    <div>
      <p class="section-eyebrow">Tác Phẩm</p>
      <h2 class="section-title">Nghệ Thuật <em>Trên Từng</em><br>Đầu Ngón Tay</h2>
    </div>
    <a href="https://www.facebook.com/lutra.beautystudio" target="_blank" class="btn-primary" style="white-space:nowrap">Xem Thêm Tác Phẩm</a>
  </div>
  <div class="gallery-grid">
    <div class="gallery-item">
      <img src="{{ asset('images/uploads/656822071_1392452999569936_7655083812312432656_n.jpg') }}" alt="Nail Art">
    </div>
    <div class="gallery-item">
      <img src="{{ asset('images/uploads/671996342_1409795011169068_8876576504544255409_n.jpg') }}" alt="Nail Art">
    </div>
    <div class="gallery-item">
      <img src="{{ asset('images/uploads/674586843_1411190274362875_8259045166252610272_n.jpg') }}" alt="Nail Art">
    </div>
    <div class="gallery-item">
      <img src="{{ asset('images/uploads/678905858_1412856530862916_4924077008544793857_n.jpg') }}" alt="Nail Art">
    </div>
    <div class="gallery-item">
      <img src="{{ asset('images/uploads/675208414_1412856537529582_6285410571894616874_n.jpg') }}" alt="Nail Art">
    </div>
  </div>
</section>

<!-- BOOKING -->
<section id="booking">
  <div class="booking-info fade-up">
    <p class="section-eyebrow">Đặt Lịch</p>
    <h2 class="section-title">Hẹn Lịch<br><em>Dễ Dàng</em></h2>
    <div class="divider"></div>
    <div class="info-item">
      <div class="info-icon">🕐</div>
      <div>
        <div class="info-label">Giờ Mở Cửa</div>
        <div class="info-value">Thứ 2 – Chủ Nhật: 8:30 – 22:00</div>
      </div>
    </div>
    <div class="info-item">
      <div class="info-icon">📞</div>
      <div>
        <div class="info-label">Hotline</div>
        <div class="info-value">0977.233.338</div>
      </div>
    </div>
    <div class="info-item">
      <div class="info-icon">📍</div>
      <div>
        <div class="info-label">Chi Nhánh 1</div>
        <div class="info-value">121 Lý Chiêu Hoàng, P.10, Q.6</div>
      </div>
    </div>
    <div class="info-item">
      <div class="info-icon">📍</div>
      <div>
        <div class="info-label">Chi Nhánh 2</div>
        <div class="info-value">Shophouse AK9-000.01, Chung cư Akari<br>77 Võ Văn Kiệt, Q. Bình Tân</div>
      </div>
    </div>
    <div class="contact-buttons">
      <a href="https://zalo.me/0977233338" target="_blank" class="contact-btn btn-zalo">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14H9V9h2v7zm4 0h-2V9h2v7z"/></svg>
        Chat Zalo
      </a>
      <a href="https://www.facebook.com/lutra.beautystudio" target="_blank" class="contact-btn btn-facebook">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="white"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
        Facebook
      </a>
      <a href="tel:0977233338" class="contact-btn btn-phone">
        📞 Gọi Ngay
      </a>
    </div>
  </div>

  <div class="booking-form fade-up" id="booking-form-wrapper">
    <div class="form-title">Đặt Lịch Hẹn</div>
    <form id="bookingForm" onsubmit="submitForm(event)">
      <div class="form-row">
        <div class="form-group">
          <label>Họ & Tên *</label>
          <input type="text" placeholder="Nguyễn Thị Lan" required>
        </div>
        <div class="form-group">
          <label>Số Điện Thoại *</label>
          <input type="tel" placeholder="0977 000 000" required>
        </div>
      </div>
      <div class="form-group">
        <label>Dịch Vụ *</label>
        <select required>
          <option value="">Chọn dịch vụ...</option>
          <option>Làm Nail</option>
          <option>Phun Xăm</option>
          <option>Gội Đầu</option>
          <option>Nối Mi</option>
          <option>Phun Chân Mày</option>
          <option>Combo nhiều dịch vụ</option>
        </select>
      </div>
      <div class="form-row">
        <div class="form-group">
          <label>Ngày Hẹn *</label>
          <input type="date" required>
        </div>
        <div class="form-group">
          <label>Giờ Hẹn *</label>
          <select required>
            <option value="">Chọn giờ...</option>
            <option>08:00</option><option>09:00</option><option>10:00</option>
            <option>11:00</option><option>13:00</option><option>14:00</option>
            <option>15:00</option><option>16:00</option><option>17:00</option>
            <option>18:00</option><option>19:00</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>Chi Nhánh</label>
        <select>
          <option>CN1 – 121 Lý Chiêu Hoàng, Q.6</option>
          <option>CN2 – Akari, 77 Võ Văn Kiệt, Q.Bình Tân</option>
        </select>
      </div>
      <div class="form-group">
        <label>Ghi Chú</label>
        <textarea placeholder="Mẫu nail yêu thích, yêu cầu đặc biệt..."></textarea>
      </div>
      <button type="submit" class="form-submit">Xác Nhận Đặt Lịch</button>
    </form>
    <div class="form-success" id="formSuccess">
      <div class="form-success-icon">✓</div>
      <div class="form-success-text">Đặt lịch thành công!</div>
      <p style="font-size:14px;color:var(--text-light);margin-top:12px;">Chúng tôi sẽ liên hệ xác nhận trong vòng 30 phút.</p>
    </div>
  </div>
</section>

<!-- MAP -->
<div id="map-section">
  <iframe class="map-frame"
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1165.4056894936796!2d106.62546636716957!3d10.738963975095169!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752d3433e58339%3A0x68f3eaa7f0442bd6!2sLutra%20Beauty%20Nail%20Qu%E1%BA%ADn%206!5e0!3m2!1svi!2s!4v1776842592314!5m2!1svi!2s"
    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
  </iframe>
  <div class="map-info">
    <div class="map-info-title">Hệ Thống<br>Chi Nhánh</div>
    <div class="branch">
      <div class="branch-name">Chi Nhánh 1 · Quận 6</div>
      <div class="branch-addr">
        121 Lý Chiêu Hoàng, Phường 10, Quận 6, TP.HCM
        <br>
        <a href="https://maps.app.goo.gl/6foJxJbvFrqNhsmp8" target="_blank">Xem trên Google Maps →</a>
      </div>
    </div>
    <div class="branch">
      <div class="branch-name">Chi Nhánh 2 · Quận Bình Tân</div>
      <div class="branch-addr">
        Shophouse AK9-000.01, Chung cư Akari<br>
        77 Võ Văn Kiệt, Quận Bình Tân, TP.HCM
      </div>
    </div>
    <div style="margin-top:28px;">
      <div class="branch-name">Hotline</div>
      <div class="branch-addr" style="font-size:22px;color:white;font-family:'Cormorant Garamond',serif;font-weight:300;">
        0977.233.338
      </div>
    </div>
  </div>
</div>

<!-- FOOTER -->
<footer>
  <div class="footer-top">
    <div>
      <div class="footer-brand-name">LUTRA <span>Beauty</span></div>
      <p class="footer-tagline">Không gian làm đẹp sang trọng, chuyên nghiệp tại TP. Hồ Chí Minh. Mỗi khách hàng là một tác phẩm nghệ thuật.</p>
    </div>
    <div>
      <div class="footer-col-title">Dịch Vụ</div>
      <ul class="footer-links">
        <li><a href="#services">Làm Nail</a></li>
        <li><a href="#services">Phun Xăm</a></li>
        <li><a href="#services">Gội Đầu</a></li>
        <li><a href="#services">Nối Mi</a></li>
        <li><a href="#services">Phun Chân Mày</a></li>
      </ul>
    </div>
    <div>
      <div class="footer-col-title">Liên Hệ</div>
      <ul class="footer-links">
        <li><a href="tel:0977233338">📞 0977.233.338</a></li>
        <li><a href="https://www.facebook.com/lutra.beautystudio" target="_blank">Facebook Page</a></li>
        <li><a href="https://zalo.me/0977233338" target="_blank">Zalo</a></li>
        <li><a href="#booking">Đặt Lịch Online</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <div>© 2025 LUTRA Beauty. All rights reserved.</div>
    <div class="footer-social">
      <a href="https://www.facebook.com/lutra.beautystudio" target="_blank" title="Facebook">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
      </a>
      <a href="https://zalo.me/0977233338" target="_blank" title="Zalo">Z</a>
    </div>
  </div>
</footer>

<!-- FLOATING CTA -->
<div class="float-cta">
  <a href="https://zalo.me/0977233338" target="_blank" class="float-btn zalo" id="floatZalo">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><circle cx="12" cy="12" r="10"/><text x="6" y="16" font-size="8" fill="#0068FF" font-weight="bold">Z</text></svg>
    Chat Zalo
  </a>
  <a href="https://www.facebook.com/lutra.beautystudio" target="_blank" class="float-btn fb" id="floatFb">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
    Nhắn Facebook
  </a>
  <button class="float-toggle" id="floatToggle" onclick="toggleFloat()">
    <span class="open">💬</span>
    <span class="close">✕</span>
  </button>
</div>

<!-- NOTIFICATION -->
<div class="notification" id="notification">
  ✓ Đặt lịch thành công! Chúng tôi sẽ liên hệ sớm.
</div>

<script>
// Hero Slider
let currentSlide = 0;
const slides = document.querySelectorAll('.hero-slide');
const dots = document.querySelectorAll('.hero-dot');

function goToSlide(n) {
  slides[currentSlide].classList.remove('active');
  dots[currentSlide].classList.remove('active');
  currentSlide = n;
  slides[currentSlide].classList.add('active');
  dots[currentSlide].classList.add('active');
}

setInterval(() => {
  goToSlide((currentSlide + 1) % slides.length);
}, 4500);

// Float toggle
function toggleFloat() {
  const toggle = document.getElementById('floatToggle');
  const zalo = document.getElementById('floatZalo');
  const fb = document.getElementById('floatFb');
  toggle.classList.toggle('active');
  zalo.classList.toggle('show');
  fb.classList.toggle('show');
}

// Form submit
function submitForm(e) {
  e.preventDefault();
  document.getElementById('bookingForm').style.display = 'none';
  document.getElementById('formSuccess').style.display = 'block';
  const notif = document.getElementById('notification');
  notif.classList.add('show');
  setTimeout(() => notif.classList.remove('show'), 4000);
}

// Nav shadow on scroll
window.addEventListener('scroll', () => {
  document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 40);
}, { passive: true });

// Counter animation
function animateCounter(el, target, suffix) {
  const dur = 1400;
  const start = performance.now();
  el.classList.add('pop');
  const tick = (now) => {
    const p = Math.min((now - start) / dur, 1);
    const ease = 1 - Math.pow(1 - p, 3);
    const val = Math.round(ease * target);
    el.textContent = val + suffix;
    if (p < 1) requestAnimationFrame(tick);
    else { el.textContent = target + suffix; }
  };
  requestAnimationFrame(tick);
}

const counterMap = [
  { suffix: '+', target: 5 },
  { suffix: '',  target: 2 },
  { suffix: 'K+', target: 5 },
  { suffix: '%', target: 100 },
];
let countersRun = false;
const aboutObserver = new IntersectionObserver((entries) => {
  if (entries[0].isIntersecting && !countersRun) {
    countersRun = true;
    document.querySelectorAll('.about-stat-num').forEach((el, i) => {
      const { target, suffix } = counterMap[i];
      setTimeout(() => animateCounter(el, target, suffix), i * 120);
    });
  }
}, { threshold: 0.4 });
const aboutEl = document.getElementById('about');
if (aboutEl) aboutObserver.observe(aboutEl);

// Dividers
const dividerObs = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.5 });
document.querySelectorAll('.divider').forEach(el => dividerObs.observe(el));

// Gallery clip-path reveal
const galleryObs = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); galleryObs.unobserve(e.target); } });
}, { threshold: 0, rootMargin: '0px 0px -40px 0px' });
document.querySelectorAll('.gallery-item').forEach(el => galleryObs.observe(el));

// Booking form
const bookingFormObs = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.15 });
const bForm = document.getElementById('booking-form-wrapper');
if (bForm) bookingFormObs.observe(bForm);

// Fade-up (general)
const fadeEls = document.querySelectorAll('.fade-up');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) e.target.classList.add('visible');
  });
}, { threshold: 0.12 });
fadeEls.forEach(el => observer.observe(el));

// Set min date for booking
const dateInput = document.querySelector('input[type="date"]');
if (dateInput) {
  const today = new Date().toISOString().split('T')[0];
  dateInput.min = today;
  dateInput.value = today;
}

// Mobile menu placeholder
function toggleMobileMenu() {
  document.querySelector('#services').scrollIntoView({ behavior: 'smooth' });
}
</script>

</body>
</html>
