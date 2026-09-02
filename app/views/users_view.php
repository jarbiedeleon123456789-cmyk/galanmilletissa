<?php $user_count = count($users ?? []); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People Directory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#17232f; --muted:#6f7d87; --line:#dbe4e5; --paper:#f6f8f5; --panel:#fff; --mint:#b8e3d1; --coral:#f27f6d; --navy:#1e3a4b; }
        * { box-sizing: border-box; }
        body { margin:0; background:var(--paper); color:var(--ink); font-family:'DM Sans',sans-serif; }
        .shell { max-width:1180px; margin:0 auto; padding:28px 28px 56px; }
        .topbar { display:flex; align-items:center; justify-content:space-between; gap:24px; margin-bottom:72px; }
        .brand { display:flex; align-items:center; gap:12px; color:var(--ink); text-decoration:none; font-family:'Space Grotesk',sans-serif; font-size:18px; font-weight:700; }
        .mark { display:grid; width:38px; height:38px; place-items:center; border-radius:12px 12px 12px 3px; background:var(--coral); color:#fff; font-size:19px; transform:rotate(-8deg); }
        .status { display:flex; align-items:center; gap:8px; color:var(--muted); font-size:13px; }
        .status i { width:8px; height:8px; border-radius:50%; background:#51b884; box-shadow:0 0 0 4px #d9f1e4; }
        .intro { display:grid; grid-template-columns:1.2fr .8fr; gap:48px; align-items:end; margin-bottom:42px; }
        .eyebrow { margin:0 0 14px; color:#d26152; font-size:12px; font-weight:700; letter-spacing:.14em; text-transform:uppercase; }
        h1 { max-width:620px; margin:0; font-family:'Space Grotesk',sans-serif; font-size:clamp(42px,6vw,76px); line-height:.96; letter-spacing:-.04em; }
        .description { max-width:310px; margin:0 0 5px; color:var(--muted); font-size:16px; line-height:1.6; }
        .summary { display:flex; align-items:center; gap:20px; padding:18px 22px; border:1px solid var(--line); border-radius:18px; background:var(--panel); }
        .summary strong { font-family:'Space Grotesk',sans-serif; font-size:32px; }
        .summary span { color:var(--muted); font-size:13px; line-height:1.3; }
        .directory { overflow:hidden; border:1px solid var(--line); border-radius:22px; background:var(--panel); box-shadow:0 20px 50px rgba(30,58,75,.07); }
        .directory-head { display:flex; justify-content:space-between; align-items:center; padding:24px 28px; border-bottom:1px solid var(--line); }
        .directory-head h2 { margin:0; font-family:'Space Grotesk',sans-serif; font-size:20px; }
        .directory-head p { margin:5px 0 0; color:var(--muted); font-size:13px; }
        .count { padding:7px 11px; border-radius:20px; background:var(--mint); color:var(--navy); font-size:12px; font-weight:700; }
        table { width:100%; border-collapse:collapse; }
        th { padding:15px 28px; color:var(--muted); background:#fbfcfb; font-size:11px; font-weight:700; letter-spacing:.1em; text-align:left; text-transform:uppercase; }
        td { padding:19px 28px; border-top:1px solid #edf1f0; font-size:14px; }
        tr:hover td { background:#f7fbf8; }
        .person { display:flex; align-items:center; gap:12px; font-weight:700; }
        .avatar { display:grid; width:36px; height:36px; place-items:center; border-radius:50%; background:var(--navy); color:#fff; font-family:'Space Grotesk',sans-serif; font-size:13px; }
        .email { color:var(--muted); }
        .username { color:#d26152; font-weight:700; }
        .empty { padding:40px 28px; color:var(--muted); text-align:center; }
        footer { margin-top:22px; color:var(--muted); font-size:12px; }
        @media (max-width:720px) { .shell{padding:20px 16px 40px}.topbar{margin-bottom:48px}.status{display:none}.intro{display:block}.description{margin-top:24px}.summary{margin-top:24px}.directory{overflow-x:auto}table{min-width:660px}.directory-head{padding:20px}th,td{padding-left:20px;padding-right:20px} }
    </style>
</head>
<body>
    <main class="shell">
        <nav class="topbar" aria-label="Main navigation">
            <a class="brand" href="/"><span class="mark">↗</span><span>LavaLust</span></a>
            <div class="status"><i></i> Directory online</div>
        </nav>
        <section class="intro">
            <div><p class="eyebrow">Community directory</p><h1>Meet the people behind the work.</h1></div>
            <p class="description">A clear, calm home for your growing team. Browse everyone in one place.</p>
        </section>
        <section class="summary" aria-label="Directory summary"><strong><?= $user_count ?></strong><span>registered<br>members</span></section>
        <section class="directory" aria-labelledby="directory-title">
            <header class="directory-head"><div><h2 id="directory-title">All members</h2><p>People currently in your directory</p></div><span class="count"><?= $user_count ?> total</span></header>
            <?php if (!empty($users)): ?>
                <table><thead><tr><th>Member</th><th>Email</th><th>Username</th></tr></thead><tbody>
                    <?php foreach ($users as $user): ?>
                        <?php $initials = strtoupper(substr($user['firstname'], 0, 1) . substr($user['lastname'], 0, 1)); ?>
                        <tr><td><div class="person"><span class="avatar"><?= htmlspecialchars($initials) ?></span><?= htmlspecialchars($user['firstname'] . ' ' . $user['lastname']) ?></div></td><td class="email"><?= htmlspecialchars($user['email']) ?></td><td class="username">@<?= htmlspecialchars($user['username']) ?></td></tr>
                    <?php endforeach; ?>
                </tbody></table>
            <?php else: ?><p class="empty">No members found.</p><?php endif; ?>
        </section>
        <footer>© <?= date('Y') ?> LavaLust · People directory</footer>
    </main>
</body>
</html>
