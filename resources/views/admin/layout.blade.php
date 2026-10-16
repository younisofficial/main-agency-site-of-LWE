<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title') — {{ config('agency.name') }} Admin</title>
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <style>
        :root { --night:#0b1b33; --accent:#0e9f6e; --accent-strong:#057a55; --soft:#def7ec; --sun:#fbbf24; --paper:#f5f7fa; --line:#e3e8ef; --muted:#64748b; --body:#334155; --ink:#0f172a; --wa:#128c45; }
        * { box-sizing: border-box; }
        body { margin:0; font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif; background:var(--paper); color:var(--body); font-size:16px; line-height:1.5; }
        a { color:var(--accent); }
        .bar { background:var(--night); color:#fff; }
        .wrap { max-width:960px; margin:0 auto; padding:0 16px; }
        .bar .wrap { display:flex; align-items:center; justify-content:space-between; gap:12px; min-height:64px; }
        .bar img { height:34px; width:auto; display:block; }
        .btn { display:inline-flex; align-items:center; justify-content:center; gap:6px; border:0; border-radius:8px; padding:10px 16px; font:inherit; font-weight:600; cursor:pointer; text-decoration:none; }
        .btn-primary { background:var(--accent); color:#fff; } .btn-primary:hover { background:var(--accent-strong); }
        .btn-wa { background:var(--wa); color:#fff; }
        .btn-light { background:#fff; color:var(--ink); border:1px solid var(--line); }
        .btn-ghost { background:transparent; color:#fff; border:1px solid rgba(255,255,255,.3); }
        .btn-danger { background:#fff; color:#b42318; border:1px solid #f1c7c2; }
        .btn-sm { padding:7px 12px; font-size:14px; }
        h1 { color:var(--ink); font-size:28px; margin:28px 0 4px; }
        .tabs { display:flex; gap:8px; margin:16px 0 20px; flex-wrap:wrap; }
        .tab { padding:8px 14px; border-radius:999px; border:1px solid var(--line); background:#fff; color:var(--body); text-decoration:none; font-weight:600; }
        .tab.on { background:var(--night); color:#fff; border-color:var(--night); }
        .card { background:#fff; border:1px solid var(--line); border-radius:14px; padding:18px; margin-bottom:14px; }
        .card.new { border-left:5px solid var(--sun); }
        .top { display:flex; justify-content:space-between; gap:10px; flex-wrap:wrap; }
        .name { font-size:19px; font-weight:700; color:var(--ink); }
        .date { color:var(--muted); font-size:14px; }
        .badge { display:inline-block; background:var(--sun); color:var(--night); font-size:12px; font-weight:700; border-radius:999px; padding:2px 9px; margin-left:6px; vertical-align:middle; }
        dl { display:grid; grid-template-columns: 110px 1fr; gap:6px 12px; margin:14px 0; }
        dt { color:var(--muted); font-size:14px; } dd { margin:0; color:var(--ink); }
        .msg { background:var(--paper); border-radius:10px; padding:12px 14px; white-space:pre-wrap; margin:0 0 14px; }
        .actions { display:flex; gap:8px; flex-wrap:wrap; }
        .actions form { margin:0; }
        .empty { background:#fff; border:1px dashed var(--line); border-radius:14px; padding:28px; text-align:center; color:var(--muted); }
        .pager { display:flex; justify-content:space-between; margin:20px 0 40px; }
        .login { max-width:380px; margin:12vh auto 0; background:#fff; border:1px solid var(--line); border-radius:16px; padding:28px; }
        label { display:block; font-weight:600; color:var(--ink); margin-bottom:6px; }
        input[type=password], input[type=email] { width:100%; border:1px solid var(--line); border-radius:8px; padding:12px; font:inherit; }
        .error { color:#b42318; font-size:14px; margin-top:6px; }
        .nav { display:flex; gap:8px; align-items:center; flex-wrap:wrap; }
        .nav a { color:#fff; text-decoration:none; padding:7px 10px; border-radius:8px; font-weight:600; font-size:14px; }
        .nav a.on, .nav a:hover { background:rgba(255,255,255,.12); }
        .field { margin-bottom:14px; }
        .ok { background:#e2ebe6; color:#275248; border-radius:10px; padding:10px 12px; font-weight:600; }
        .note { background:#fff7e6; border:1px solid #f6d58e; border-radius:10px; padding:12px; font-size:14px; }
        @media (max-width:560px) { dl { grid-template-columns:1fr; } dt { margin-top:6px; } }
    </style>
</head>
<body>
    @yield('body')
</body>
</html>
