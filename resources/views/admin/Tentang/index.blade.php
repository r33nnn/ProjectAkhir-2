<?php
// resources/views/tentang/index.php
// Untuk Laravel: rename ke index.blade.php
?>
<!DOCTYPE html>
@php
    $tentang = \App\Models\Tentang::first() ?? new \App\Models\Tentang();
@endphp
<html lang="id">
<head>
  <meta charset="UTF-8"/
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tentang Kami – Admin GBI Tambunan</title>
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@500;600;700&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --bg:        #f4f6f9;
      --white:     #ffffff;
      --border:    #e4e8ef;
      --border2:   #d0d7e3;
      --text:      #1a2233;
      --muted:     #7a8499;
      --cyan:      #1da8e0;
      --cyan-dk:   #0d85b5;
      --cyan-lt:   #e8f6fd;
      --gold:      #c89b3c;
      --gold-lt:   #fdf6e3;
      --danger:    #e05555;
      --danger-lt: #fdf0f0;
      --success:   #2ea86a;
      --success-lt:#e8f7ef;
      --sidebar:   #1e2430;
    }
    * { margin:0; padding:0; box-sizing:border-box; }
    body { background:var(--bg); font-family:'Nunito',sans-serif; color:var(--text); min-height:100vh; }

    /* ─── TOPBAR ─── */
    .topbar {
      position:fixed; top:0; left:0; right:0; z-index:200;
      height:56px; display:flex; align-items:center; justify-content:space-between;
      padding:0 20px 0 0;
      background:var(--white); border-bottom:1px solid var(--border);
      box-shadow:0 1px 8px rgba(0,0,0,.06);
    }
    .topbar-left {
      display:flex; align-items:center; width:240px; height:100%; flex-shrink:0;
      background:var(--sidebar); padding:0 18px;
    }
    .hamburger { background:none; border:none; color:rgba(255,255,255,.5); font-size:20px; cursor:pointer; margin-right:12px; transition:color .15s; }
    .hamburger:hover { color:#fff; }
    .brand { display:flex; align-items:center; gap:10px; text-decoration:none; }
    .brand-logo {
      width:32px; height:32px; background:linear-gradient(135deg,var(--cyan),var(--gold));
      border-radius:7px; display:flex; align-items:center; justify-content:center;
      font-family:'Rajdhani',sans-serif; font-weight:700; font-size:13px; color:#fff; flex-shrink:0;
    }
    .brand-name { font-family:'Rajdhani',sans-serif; font-size:16px; font-weight:700; color:#fff; }
    .brand-name span { color:var(--cyan); }
    .topbar-nav { display:flex; align-items:center; gap:2px; flex:1; padding:0 14px; }
    .topbar-nav a {
      color:var(--muted); font-size:13px; font-weight:600;
      text-decoration:none; padding:5px 12px; border-radius:6px; transition:all .15s;
    }
    .topbar-nav a:hover { color:var(--text); background:#f0f2f5; }
    .topbar-nav a.active { color:var(--cyan); background:var(--cyan-lt); }
    .topbar-right { display:flex; align-items:center; gap:12px; }
    .btn-viewsite {
      background:var(--cyan-lt); border:1px solid rgba(29,168,224,.3); color:var(--cyan);
      font-family:'Nunito',sans-serif; font-size:12px; font-weight:700;
      padding:5px 14px; border-radius:6px; cursor:pointer; transition:all .15s;
    }
    .btn-viewsite:hover { background:var(--cyan); color:#fff; }
    .avatar {
      width:32px; height:32px; border-radius:50%;
      background:linear-gradient(135deg,var(--gold),var(--cyan));
      display:flex; align-items:center; justify-content:center;
      font-size:12px; font-weight:700; color:#fff; cursor:pointer;
    }

    /* ─── SIDEBAR ─── */
    .sidebar {
      position:fixed; top:56px; left:0; bottom:0; width:240px;
      background:var(--sidebar); display:flex; flex-direction:column; overflow-y:auto; z-index:100;
    }
    .sidebar-user {
      display:flex; align-items:center; gap:12px; padding:18px 18px 14px;
      border-bottom:1px solid rgba(255,255,255,.07);
    }
    .sidebar-user .ava {
      width:40px; height:40px; border-radius:50%;
      background:linear-gradient(135deg,var(--gold),var(--cyan));
      display:flex; align-items:center; justify-content:center;
      font-size:15px; font-weight:700; color:#fff; flex-shrink:0;
    }
    .sidebar-user .info strong { display:block; font-size:14px; font-weight:700; color:#fff; }
    .sidebar-user .info span   { font-size:11px; color:var(--cyan); }
    .sidebar-search {
      display:flex; align-items:center; gap:8px; margin:12px 14px;
      background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.1);
      border-radius:7px; padding:7px 12px;
    }
    .sidebar-search input { background:none; border:none; outline:none; color:#fff; font-family:'Nunito',sans-serif; font-size:13px; flex:1; }
    .sidebar-search input::placeholder { color:rgba(255,255,255,.3); }
    .nav-section { padding:10px 18px 4px; font-size:10px; font-weight:700; letter-spacing:1.4px; color:rgba(255,255,255,.25); text-transform:uppercase; }
    .sidebar nav a {
      display:flex; align-items:center; gap:10px; padding:9px 18px;
      font-size:13.5px; font-weight:600; color:rgba(255,255,255,.5);
      text-decoration:none; border-left:3px solid transparent; transition:all .15s;
    }
    .sidebar nav a:hover { color:#fff; background:rgba(255,255,255,.06); }
    .sidebar nav a.active { color:#fff; border-left-color:var(--cyan); background:rgba(29,168,224,.15); }
    .sidebar nav a .ico { font-size:15px; width:20px; text-align:center; }
    .sidebar-footer { margin-top:auto; padding:14px 18px; border-top:1px solid rgba(255,255,255,.07); font-size:11px; color:rgba(255,255,255,.3); }
    .sidebar-footer strong { color:rgba(255,255,255,.6); display:block; }

    /* ─── WRAPPER ─── */
    .wrapper { margin-left:240px; padding-top:56px; min-height:100vh; }

    /* ─── CONTENT HEADER ─── */
    .content-header {
      display:flex; align-items:center; justify-content:space-between;
      padding:20px 28px 0;
    }
    .content-header h1 { font-family:'Rajdhani',sans-serif; font-size:22px; font-weight:700; }
    .breadcrumb-bar { display:flex; align-items:center; gap:6px; font-size:12px; color:var(--muted); }
    .breadcrumb-bar a { color:var(--cyan); text-decoration:none; }
    .breadcrumb-bar a:hover { text-decoration:underline; }

    /* ─── CONTENT ─── */
    .content { padding:22px 28px 60px; }

    /* ─── HERO BANNER ─── */
    .page-hero {
      position:relative; overflow:hidden;
      border-radius:16px; margin-bottom:28px;
      background:linear-gradient(135deg, var(--cyan-dk), var(--cyan), #29c4f0);
      padding:36px 40px;
      box-shadow:0 6px 24px rgba(29,168,224,.25);
    }
    .page-hero::before {
      content:''; position:absolute; inset:0;
      background:
        radial-gradient(ellipse 50% 80% at 95% 50%, rgba(255,255,255,.12) 0%, transparent 65%),
        radial-gradient(ellipse 35% 60% at 5%  90%, rgba(200,155,60,.18) 0%, transparent 55%);
      pointer-events:none;
    }
    .hero-tag {
      display:inline-block; background:rgba(255,255,255,.2);
      border:1px solid rgba(255,255,255,.35); color:#fff;
      font-size:11px; font-weight:700; letter-spacing:1.2px; text-transform:uppercase;
      padding:4px 12px; border-radius:20px; margin-bottom:12px;
    }
    .page-hero h2 { font-family:'Rajdhani',sans-serif; font-size:28px; font-weight:700; color:#fff; margin-bottom:8px; }
    .page-hero p  { color:rgba(255,255,255,.8); font-size:14px; max-width:520px; line-height:1.65; }
    .hero-actions { margin-top:20px; display:flex; gap:10px; }
    .btn-hero-primary {
      background:#fff; color:var(--cyan); border:none;
      font-family:'Nunito',sans-serif; font-size:13px; font-weight:700;
      padding:9px 20px; border-radius:8px; cursor:pointer; transition:all .18s;
      box-shadow:0 3px 10px rgba(0,0,0,.1);
    }
    .btn-hero-primary:hover { transform:translateY(-1px); box-shadow:0 6px 16px rgba(0,0,0,.15); }
    .btn-hero-outline {
      background:rgba(255,255,255,.15); color:#fff;
      border:1px solid rgba(255,255,255,.4);
      font-family:'Nunito',sans-serif; font-size:13px; font-weight:700;
      padding:9px 20px; border-radius:8px; cursor:pointer; transition:all .18s;
    }
    .btn-hero-outline:hover { background:rgba(255,255,255,.25); }

    /* ─── SECTION TITLE ─── */
    .section-title {
      font-family:'Rajdhani',sans-serif; font-size:18px; font-weight:700; color:var(--text);
      letter-spacing:.4px; margin-bottom:16px;
      display:flex; align-items:center; gap:10px;
    }
    .section-title::after { content:''; flex:1; height:1px; background:var(--border); }

    /* ─── SEJARAH ─── */
    .sejarah-card {
      background:var(--white); border:1px solid var(--border); border-radius:14px;
      padding:28px; margin-bottom:20px;
      box-shadow:0 1px 6px rgba(0,0,0,.05);
    }
    .sejarah-card .edit-bar {
      display:flex; align-items:flex-start; justify-content:space-between; gap:16px;
    }
    .sejarah-text { flex:1; font-size:14px; color:var(--muted); line-height:1.75; }
    .sejarah-text p { margin-bottom:10px; }
    .sejarah-text p:last-child { margin-bottom:0; }

    .milestone-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    .milestone-card {
      background:var(--white); border:1px solid var(--border); border-radius:12px;
      padding:24px 22px; display:flex; align-items:center; gap:18px;
      box-shadow:0 1px 4px rgba(0,0,0,.04);
      transition:transform .2s, box-shadow .2s;
      animation:fadeUp .4s ease both;
    }
    .milestone-card:nth-child(1){animation-delay:.05s}
    .milestone-card:nth-child(2){animation-delay:.12s}
    .milestone-card:hover { transform:translateY(-3px); box-shadow:0 8px 20px rgba(0,0,0,.08); }
    @keyframes fadeUp { from{opacity:0;transform:translateY(16px)} to{opacity:1;transform:translateY(0)} }
    .ms-icon {
      width:54px; height:54px; border-radius:14px; flex-shrink:0;
      display:flex; align-items:center; justify-content:center; font-size:24px;
    }
    .ms-icon.c { background:var(--cyan-lt); }
    .ms-icon.g { background:var(--gold-lt); }
    .ms-year { font-family:'Rajdhani',sans-serif; font-size:22px; font-weight:700; color:var(--text); line-height:1; }
    .ms-label { font-size:12.5px; color:var(--muted); margin-top:4px; line-height:1.5; }

    /* ─── VISI MISI ─── */
    .vm-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:8px; }
    .vm-card {
      background:var(--white); border:1px solid var(--border); border-radius:12px;
      padding:24px 22px; box-shadow:0 1px 4px rgba(0,0,0,.04);
      transition:transform .2s, box-shadow .2s;
      animation:fadeUp .4s ease both;
    }
    .vm-card:nth-child(1){animation-delay:.05s}
    .vm-card:nth-child(2){animation-delay:.12s}
    .vm-card:hover { transform:translateY(-3px); box-shadow:0 8px 20px rgba(0,0,0,.08); }
    .vm-icon {
      width:46px; height:46px; border-radius:12px; margin-bottom:14px;
      display:flex; align-items:center; justify-content:center; font-size:20px;
    }
    .vm-icon.c { background:var(--cyan-lt); }
    .vm-icon.g { background:var(--gold-lt); }
    .vm-icon.s { background:var(--success-lt); }
    .vm-icon.r { background:var(--danger-lt); }
    .vm-title { font-family:'Rajdhani',sans-serif; font-size:17px; font-weight:700; color:var(--text); margin-bottom:8px; }
    .vm-quote {
      font-size:13px; color:var(--muted); line-height:1.65;
      border-left:3px solid var(--cyan-lt); padding-left:12px; font-style:italic;
    }
    .vm-card:nth-child(2) .vm-quote { border-left-color:var(--gold-lt); }

    /* ─── KEPEMIMPINAN ─── */
    .leader-grid { display:grid; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); gap:16px; }
    .leader-card {
      background:var(--white); border:1px solid var(--border); border-radius:14px;
      padding:28px 22px; text-align:center; box-shadow:0 1px 6px rgba(0,0,0,.05);
      transition:transform .2s, box-shadow .2s;
      animation:fadeUp .4s ease both;
    }
    .leader-card:nth-child(1){animation-delay:.05s}
    .leader-card:nth-child(2){animation-delay:.12s}
    .leader-card:nth-child(3){animation-delay:.19s}
    .leader-card:hover { transform:translateY(-4px); box-shadow:0 10px 28px rgba(0,0,0,.10); }
    .leader-avatar {
      width:72px; height:72px; border-radius:50%; margin:0 auto 16px;
      background:linear-gradient(135deg, var(--cyan-lt), var(--cyan));
      display:flex; align-items:center; justify-content:center;
      font-size:26px; font-weight:700; color:var(--cyan-dk);
      border:3px solid var(--border);
      font-family:'Rajdhani',sans-serif;
      overflow:hidden; position:relative; cursor:pointer; transition:all .2s;
    }
    .leader-avatar img { width:100%; height:100%; object-fit:cover; border-radius:50%; }
    .leader-avatar:hover .ava-ol { opacity:1; }
    .ava-ol {
      position:absolute; inset:0; border-radius:50%;
      background:rgba(15,22,40,.55);
      display:flex; flex-direction:column; align-items:center; justify-content:center;
      opacity:0; transition:opacity .2s; gap:2px;
    }
    .ava-ol span { font-size:16px; }
    .ava-ol p { font-size:8px; font-weight:700; color:#fff; letter-spacing:.3px; }

    /* Drop zone foto di modal */
    .photo-drop {
      border:2px dashed var(--border2); border-radius:9px; padding:20px;
      text-align:center; cursor:pointer; transition:all .18s;
      background:var(--bg); margin-bottom:14px; position:relative;
    }
    .photo-drop:hover,.photo-drop.drag { border-color:var(--cyan); background:var(--cyan-lt); }
    .photo-drop .pd-ico { font-size:26px; margin-bottom:6px; }
    .photo-drop p { font-size:12.5px; color:var(--muted); }
    .photo-drop span { color:var(--cyan); font-weight:700; }
    .photo-drop input[type=file] { position:absolute; inset:0; opacity:0; cursor:pointer; width:100%; height:100%; }
    .photo-drop .pd-prev { width:100%; height:110px; object-fit:cover; border-radius:7px; margin-top:10px; display:none; border:1px solid var(--border); }
    .leader-name  { font-family:'Rajdhani',sans-serif; font-size:17px; font-weight:700; color:var(--text); margin-bottom:4px; }
    .leader-role  {
      display:inline-block; font-size:11px; font-weight:700; letter-spacing:.6px;
      text-transform:uppercase; padding:3px 12px; border-radius:20px; margin-bottom:14px;
      background:var(--cyan-lt); color:var(--cyan); border:1px solid rgba(29,168,224,.2);
    }
    .leader-desc  { font-size:13px; color:var(--muted); line-height:1.65; }

    /* ─── EDIT BUTTONS ─── */
    .edit-btn {
      display:inline-flex; align-items:center; gap:6px;
      background:var(--cyan-lt); color:var(--cyan); border:1px solid rgba(29,168,224,.25);
      font-family:'Nunito',sans-serif; font-size:12px; font-weight:700;
      padding:6px 14px; border-radius:7px; cursor:pointer; transition:all .15s;
      flex-shrink:0;
    }
    .edit-btn:hover { background:var(--cyan); color:#fff; }
    .add-btn {
      display:inline-flex; align-items:center; gap:7px;
      background:linear-gradient(135deg,var(--cyan),var(--cyan-dk)); color:#fff;
      border:none; font-family:'Nunito',sans-serif; font-size:12.5px; font-weight:700;
      padding:8px 16px; border-radius:7px; cursor:pointer;
      transition:all .2s; box-shadow:0 3px 10px rgba(29,168,224,.25);
    }
    .add-btn:hover { transform:translateY(-1px); box-shadow:0 6px 16px rgba(29,168,224,.35); }
    .section-head {
      display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;
    }

    /* ─── MODAL ─── */
    .overlay {
      display:none; position:fixed; inset:0; z-index:300;
      background:rgba(26,34,51,.45); backdrop-filter:blur(4px);
      align-items:center; justify-content:center;
    }
    .overlay.open { display:flex; }
    .modal {
      background:var(--white); border:1px solid var(--border); border-radius:14px;
      padding:28px; width:520px; max-width:94vw;
      box-shadow:0 20px 60px rgba(0,0,0,.15); animation:mIn .22s ease;
      max-height:92vh; overflow-y:auto;
    }
    @keyframes mIn { from{opacity:0;transform:translateY(12px) scale(.97)} to{opacity:1;transform:translateY(0) scale(1)} }
    .modal-head { display:flex; align-items:center; justify-content:space-between; margin-bottom:22px; }
    .modal-head h3 { font-family:'Rajdhani',sans-serif; font-size:19px; font-weight:700; color:var(--text); }
    .modal-head h3 span { color:var(--cyan); }
    .close-btn {
      background:#f0f2f5; border:none; color:var(--muted);
      width:30px; height:30px; border-radius:7px; cursor:pointer;
      font-size:15px; display:flex; align-items:center; justify-content:center; transition:all .14s;
    }
    .close-btn:hover { background:var(--danger); color:#fff; }
    .fg { display:flex; flex-direction:column; gap:5px; margin-bottom:14px; }
    .fg label { font-size:10.5px; font-weight:700; letter-spacing:.8px; text-transform:uppercase; color:var(--muted); }
    .fg input, .fg textarea, .fg select {
      background:var(--bg); border:1px solid var(--border); color:var(--text);
      font-family:'Nunito',sans-serif; font-size:13px; padding:9px 13px;
      border-radius:7px; outline:none; transition:all .15s; resize:none;
    }
    .fg input:focus, .fg textarea:focus { border-color:var(--cyan); background:#fff; box-shadow:0 0 0 3px rgba(29,168,224,.08); }
    .fg input::placeholder, .fg textarea::placeholder { color:#b0b8c9; }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
    .modal-foot { display:flex; justify-content:flex-end; gap:10px; margin-top:6px; }
    .btn-cancel {
      background:#f0f2f5; border:1px solid var(--border); color:var(--muted);
      font-family:'Nunito',sans-serif; font-size:13px; font-weight:600;
      padding:9px 18px; border-radius:7px; cursor:pointer; transition:all .14s;
    }
    .btn-cancel:hover { color:var(--text); background:var(--border); }
    .btn-save {
      background:linear-gradient(135deg,var(--cyan),var(--cyan-dk)); border:none; color:#fff;
      font-family:'Nunito',sans-serif; font-size:13px; font-weight:700;
      padding:9px 22px; border-radius:7px; cursor:pointer; transition:all .18s;
      box-shadow:0 3px 10px rgba(29,168,224,.25);
    }
    .btn-save:hover { transform:translateY(-1px); box-shadow:0 6px 16px rgba(29,168,224,.35); }

    /* ─── TOAST ─── */
    .toast {
      position:fixed; bottom:24px; right:24px; z-index:400;
      background:var(--white); border:1px solid var(--border); border-radius:10px;
      padding:13px 20px; display:flex; align-items:center; gap:10px;
      font-size:13px; font-weight:600; color:var(--text);
      box-shadow:0 8px 32px rgba(0,0,0,.12);
      transform:translateY(16px); opacity:0; transition:all .28s ease; pointer-events:none;
    }
    .toast.show { transform:translateY(0); opacity:1; }
    .toast.ok  { border-left:3px solid var(--success); }
    .toast.err { border-left:3px solid var(--danger); }

    ::-webkit-scrollbar { width:5px; }
    ::-webkit-scrollbar-track { background:var(--bg); }
    ::-webkit-scrollbar-thumb { background:var(--border2); border-radius:3px; }
    ::-webkit-scrollbar-thumb:hover { background:#b0b8c9; }

    @media(max-width:900px) {
      .sidebar { display:none; }
      .wrapper { margin-left:0; }
      .milestone-grid, .vm-grid { grid-template-columns:1fr; }
    }

    /* ── PROFILE SYNC: avatar support foto ── */
    .sidebar-user .ava { overflow: hidden; }
    .sidebar-user .ava img { width:100%; height:100%; object-fit:cover; }
    .avatar { overflow: hidden; }
    .avatar img { width:100%; height:100%; object-fit:cover; border-radius:50%; }
  </style>
</head>
<body>

<!-- TOPBAR -->
<header class="topbar">
  <div class="topbar-left">
    <button class="hamburger">☰</button>
    <a class="brand" href="#">
      <div class="brand-logo">GBI</div>
      <span class="brand-name">GBI <span>Tambunan</span></span>
    </a>
  </div>
  <nav class="topbar-nav">
    <a href="{{ route('welcome') }}">Beranda</a>
    <a href="{{ route('tentang.index') }}" class="active">Tentang Kami</a>
    <a href="{{ route('jadwals.index') }}">Jadwal Ibadah</a>
    <a href="{{ route('galeris.index') }}">Galeri</a>
    <a href="{{ route('khotbah.index') }}">Khotbah</a>
    <a href="{{ route('pelayanan.index') }}">Pelayanan</a>
    <a href="{{ route('kontaks.index') }}">Kontak</a>
  </nav>
  <div class="topbar-right">
    <a href="{{ route('home') }}"><button class="btn-viewsite">🌐 Lihat Website</button></a>
    <div class="avatar" id="tbAva">A</div>
  </div>
</header>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-user">
    <div class="ava" id="sbAva">A</div>
    <div class="info">
      <strong id="sbName">Admin GBI</strong>
      <span id="sbRole">Administrator</span>
    </div>
  </div>
  <div class="sidebar-search">
    <span style="color:rgba(255,255,255,.4);">🔍</span>
    <input type="text" placeholder="Search..."/>
  </div>
  <div class="nav-section">Menu Utama</div>
  <nav>
    <a href="{{ route('welcome') }}"><span class="ico">⊞</span> Dashboard</a>
    <a href="{{ route('tentang.index') }}" class="active"><span class="ico">ℹ</span> Tentang Kami</a>
    <a href="{{ route('jadwals.index') }}"><span class="ico">📅</span> Jadwal Ibadah</a>
    <a href="{{ route('galeris.index') }}"><span class="ico">🖼</span> Galeri</a>
    <a href="{{ route('khotbah.index') }}"><span class="ico">🎙</span> Khotbah</a>
    <a href="{{ route('pelayanan.index') }}"><span class="ico">🙌</span> Pelayanan</a>
    <a href="{{ route('kontaks.index') }}" ><span class="ico">✉</span> Kontak</a>
  </nav>
  <div class="nav-section">Pengaturan</div>
  <nav>
    <a href="{{ route('profil.index') }}"><span class="ico">👤</span> Profil Admin</a>
    <a href="#"><span class="ico">⚙</span> Pengaturan</a>
    <a href="#"><span class="ico">🚪</span> Keluar</a>
  </nav>
  <div class="sidebar-footer"><strong>Kelompok 5 PA-1</strong>Version 1.0.0</div>
</aside>

<!-- WRAPPER -->
<div class="wrapper">
  <div class="content-header">
    <h1>Tentang Kami</h1>
    <div class="breadcrumb-bar">
      <a href="#">Home</a> / <span>Tentang Kami</span>
    </div>
  </div>

  <div class="content">

    <!-- HERO BANNER -->
    <div class="page-hero">
      <div class="hero-tag">ℹ Halaman Publik</div>
      <h2>{{ $tentang->header_title ?? 'GBI Tambunan' }}</h2>
      <p>{{ $tentang->header_description ?? 'Mengenal lebih dekat sejarah, visi, misi, dan keluarga besar GBI Tambunan. Edit konten di bawah untuk memperbarui tampilan halaman publik.' }}</p>
      <div class="hero-actions">
        <a class="btn-hero-primary" href="{{ $tentang->id ? route('tentang.edit', $tentang->id) : route('tentang.create') }}">✏ Edit Konten</a>
        <a class="btn-hero-outline" target="_blank" href="{{ route('user.tentang') }}">🌐 Lihat Halaman Publik</a>
      </div>
    </div>

    <!-- ══ SEJARAH ══ -->
    <div class="section-head">
      <div class="section-title" style="flex:1;margin-bottom:0;">📖 Sejarah Kami</div>
      <a href="{{ $tentang->id ? route('tentang.edit', $tentang->id) : route('tentang.create') }}" class="edit-btn" style="margin-left:16px;">✏ Edit</a>
    </div>

    <div class="sejarah-card" style="margin-bottom:16px;">
      <div class="edit-bar">
        <div class="sejarah-text" id="sejarahText">
          <p>{{ $tentang->sejarah ?? 'GBI Tambunan adalah bagian dari sinode Gereja Bethel Indonesia. Sejak berdiri pada tahun 1970, kami berkomitmen untuk melayani Tuhan dan membangun komunitas yang bertumbuh dalam iman, pengharapan, dan kasih.' }}</p>
        </div>
      </div>
    </div>

    <div class="milestone-grid" style="margin-bottom:32px;">
      <div class="milestone-card">
        <div class="ms-icon c">⛪</div>
        <div>
          <div class="ms-year">{{ $tentang->tahun_berdiri ?? '1970' }}</div>
          <div class="ms-label">Berdirinya Gereja Bethel Indonesia</div>
        </div>
      </div>
      <div class="milestone-card">
        <div class="ms-icon g">🙌</div>
        <div>
          <div class="ms-year">Sekarang</div>
          <div class="ms-label">Melayani komunitas lokal dengan kasih Kristus</div>
        </div>
      </div>
    </div>

    <!-- ══ VISI & MISI ══ -->
    <div class="section-head">
      <div class="section-title" style="flex:1;margin-bottom:0;">✨ Visi & Misi</div>
      <a href="{{ $tentang->id ? route('tentang.edit', $tentang->id) : route('tentang.create') }}" class="edit-btn" style="margin-left:16px;">✏ Edit</a>
    </div>

    <div class="vm-grid" style="margin-bottom:32px;">
      <div class="vm-card">
        <div class="vm-icon c">💙</div>
        <div class="vm-title">Visi</div>
        <div class="vm-quote" id="visiText">{{ $tentang->visi ?? 'Membangun gereja yang kuat dalam iman dan pengharapan' }}</div>
      </div>
      <div class="vm-card">
        <div class="vm-icon g">🤝</div>
        <div class="vm-title">Misi</div>
        <div class="vm-quote" id="misiText">{{ $tentang->misi ?? 'Melayani Tuhan dengan sepenuh hati dan mengasihi sesama' }}</div>
      </div>
    </div>

    <!-- ══ KEPEMIMPINAN ══ -->
    <div class="section-head">
      <div class="section-title" style="flex:1;margin-bottom:0;">👤 Kepemimpinan</div>
      <a href="{{ $tentang->id ? route('tentang.edit', $tentang->id) : route('tentang.create') }}" class="add-btn">＋ Tambah Pemimpin</a>
    </div>

    <div class="leader-grid" id="leaderGrid">

      <div class="leader-card">
        <div class="leader-avatar">{{ strtoupper(substr($tentang->gembala_nama ?? 'G',0,1)) }}</div>
        <div class="leader-name">{{ $tentang->gembala_nama ?? 'Gembala Sidang' }}</div>
        <div class="leader-role">{{ $tentang->gembala_jabatan ?? 'Pemimpin Rohani' }}</div>
        <div class="leader-desc">{{ $tentang->gembala_deskripsi ?? 'Sebagai gembala, kami berkomitmen untuk memimpin jemaat dalam kasih Kristus.' }}</div>
        <div style="display:flex;gap:8px;justify-content:center;margin-top:16px;">
          <a class="edit-btn" href="{{ $tentang->id ? route('tentang.edit', $tentang->id) : route('tentang.create') }}">✏ Edit</a>
        </div>
      </div>

      <div class="leader-card">
        <div class="leader-avatar">SM</div>
        <div class="leader-name">Pdt. Samuel Manurung</div>
        <div class="leader-role">Wakil Gembala</div>
        <div class="leader-desc">Membantu memimpin jemaat dalam pelayanan mingguan dan pembinaan rohani kelompok sel dan pemuda gereja.</div>
        <div style="display:flex;gap:8px;justify-content:center;margin-top:16px;">
          <a class="edit-btn" href="{{ $tentang->id ? route('tentang.edit', $tentang->id) : route('tentang.create') }}">✏ Edit</a>
        </div>
      </div>

    </div>

  </div><!-- /content -->
</div><!-- /wrapper -->

<div class="toast" id="toast"></div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none">@csrf</form>

<script>
  function toast(msg, type='ok') {
    const t = document.getElementById('toast');
    t.textContent = (type==='ok' ? '✅ ' : '🗑 ') + msg;
    t.className = 'toast ' + type;
    t.classList.add('show');
    setTimeout(()=>t.classList.remove('show'), 3000);
  }
</script>
</body>
</html>    _lFoto = null;
    document.getElementById('lFotoPreview').style.display='none';
    document.getElementById('lFotoPreview').src='';
    document.getElementById('lFotoInput').value='';
    document.getElementById('pdLeader').querySelector('.pd-ico').style.display='';
    document.querySelectorAll('#pdLeader p').forEach(e=>e.style.display='');
  }
  function showLPreview(src){
    document.getElementById('lFotoPreview').src=src;
    document.getElementById('lFotoPreview').style.display='block';
    document.getElementById('pdLeader').querySelector('.pd-ico').style.display='none';
    document.querySelectorAll('#pdLeader p').forEach(e=>e.style.display='none');
  }
  function onLFoto(e){
    const f=e.target.files[0]; if(!f) return;
    if(f.size>2*1024*1024){ toast('File terlalu besar! Maks 2MB','err'); return; }
    const r=new FileReader();
    r.onload=ev=>{ _lFoto=ev.target.result; showLPreview(_lFoto); };
    r.readAsDataURL(f);
  }

  /* Drag-drop pada drop zone */
  const pdL=document.getElementById('pdLeader');
  pdL.addEventListener('dragover',e=>{e.preventDefault();pdL.classList.add('drag');});
  pdL.addEventListener('dragleave',()=>pdL.classList.remove('drag'));
  pdL.addEventListener('drop',e=>{
    e.preventDefault();pdL.classList.remove('drag');
    const f=e.dataTransfer.files[0]; if(!f||!f.type.startsWith('image/')) return;
    onLFoto({target:{files:[f]}});
  });

  /* Klik langsung pada avatar (quick change tanpa buka modal) */
  function quickFotoLeader(idx){
    const inp=document.createElement('input');
    inp.type='file'; inp.accept='image/*';
    inp.onchange=e=>{
      const f=e.target.files[0]; if(!f) return;
      if(f.size>2*1024*1024){ toast('Maks 2MB','err'); return; }
      const r=new FileReader();
      r.onload=ev=>{
        leaders[idx].foto=ev.target.result;
        save(K.leaders, leaders);
        renderLeaders();
        toast('Foto pemimpin diperbarui ✓','ok');
      };
      r.readAsDataURL(f);
    };
    inp.click();
  }
</script>

<script>
/* ── PROFILE SYNC ── */
(function(){
  const KEY = 'gbi_profile_v1';
  function initials(n){ return (n||'A').split(' ').map(w=>w[0]).join('').toUpperCase().slice(0,2); }
  function txt(id,v){ const e=document.getElementById(id); if(e) e.textContent=v||''; }
  function setAva(id, nama, foto, circle){
    const el=document.getElementById(id); if(!el) return;
    if(foto){
      const r=circle?'border-radius:50%':'';
      el.innerHTML=`<img src="${foto}" alt="" style="width:100%;height:100%;object-fit:cover;${r}"/>`;
    } else { el.innerHTML=initials(nama); }
  }
  function sync(){
    let p=null;
    try{ const r=localStorage.getItem(KEY); if(r) p=JSON.parse(r); }catch(_){}
    if(!p) return;
    setAva('tbAva', p.nama, p.foto, true);
    setAva('sbAva', p.nama, p.foto, false);
    txt('sbName', p.nama);
    txt('sbRole', p.jabatan);
  }
  sync();
  window.addEventListener('storage', e=>{ if(e.key===KEY) sync(); });
  window.addEventListener('focus', sync);
  document.addEventListener('visibilitychange', ()=>{ if(document.visibilityState==='visible') sync(); });
})();
</script>
</body>
</html>