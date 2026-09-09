<?php
$escape = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | Marrow's Pantry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#24201d; --muted:#766c63; --paper:#f4eee5; --card:#fffaf2; --red:#9d3b2e; --gold:#bd8b42; --line:#dfd2c2; }
        * { box-sizing:border-box; } body { margin:0; min-height:100vh; color:var(--ink); background-color:var(--paper); background-image:radial-gradient(#d9c8b2 1px,transparent 1px); background-size:24px 24px; font-family:'DM Sans',sans-serif; }
        .wrap { min-height:100vh; display:grid; place-items:center; padding:24px; } .panel { width:min(100%, 440px); padding:48px; background:var(--card); border:1px solid var(--line); box-shadow:14px 14px 0 #dfc7a7; }
        .brand { color:var(--red); font-size:13px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; } h1 { margin:14px 0 10px; font:700 clamp(38px,8vw,58px)/.98 'Playfair Display',serif; } .intro { color:var(--muted); line-height:1.6; margin:0 0 30px; }
        label { display:block; margin:18px 0 7px; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; } input { width:100%; padding:14px 15px; border:1px solid var(--line); background:#fffdf9; color:var(--ink); font:inherit; } input:focus { outline:2px solid var(--gold); outline-offset:2px; }
        button { width:100%; margin-top:25px; padding:15px 18px; border:0; background:var(--red); color:#fffaf2; cursor:pointer; font:700 14px 'DM Sans',sans-serif; letter-spacing:.05em; text-transform:uppercase; } button:hover { background:#7d2c23; } .error { padding:12px 14px; border-left:3px solid var(--red); background:#f7ded7; color:#7d2c23; font-size:14px; }
        @media (max-width:520px) { .panel { padding:32px 24px; box-shadow:8px 8px 0 #dfc7a7; } }
    </style>
</head>
<body><main class="wrap"><section class="panel">
    <div class="brand">Marrow's Pantry / Staff access</div><h1>Welcome back.</h1><p class="intro">Sign in to keep the pantry stocked, the menu fresh, and every product accounted for.</p>
    <?php if (!empty($error)): ?><div class="error"><?= $escape($error) ?></div><?php endif; ?>
    <form method="post" action="/login">
        <label for="identity">Username or email</label><input id="identity" name="identity" type="text" autocomplete="username" required>
        <label for="password">Password</label><input id="password" name="password" type="password" autocomplete="current-password" required>
        <button type="submit">Enter the pantry</button>
    </form>
</section></main></body></html>
