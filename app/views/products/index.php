<?php
$escape = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
$product_count = count($products ?? []);
$is_admin = ($role ?? 'user') === 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantry inventory | Marrow's Pantry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#24201d; --muted:#766c63; --paper:#f4eee5; --card:#fffaf2; --red:#9d3b2e; --gold:#bd8b42; --sage:#586b58; --line:#dfd2c2; }
        * { box-sizing:border-box; } body { margin:0; color:var(--ink); background:var(--paper); background-image:linear-gradient(90deg,rgba(255,255,255,.25) 1px,transparent 1px); background-size:48px 48px; font-family:'DM Sans',sans-serif; }
        .shell { width:min(1180px,calc(100% - 40px)); margin:auto; padding:28px 0 60px; } nav { display:flex; align-items:center; justify-content:space-between; gap:20px; margin-bottom:76px; } .brand { display:flex; align-items:center; gap:12px; color:var(--red); text-decoration:none; font-weight:700; letter-spacing:.12em; text-transform:uppercase; font-size:13px; } .stamp { display:grid; place-items:center; width:38px; height:38px; border:2px solid var(--red); border-radius:50%; font-family:Georgia,serif; font-size:20px; }
        .nav-actions { display:flex; align-items:center; gap:18px; font-size:13px; } .nav-actions a { color:var(--red); font-weight:700; text-decoration:none; } .user { color:var(--muted); }
        .hero { display:flex; align-items:end; justify-content:space-between; gap:30px; margin-bottom:38px; } .eyebrow { margin:0 0 12px; color:var(--gold); font-size:12px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; } h1 { margin:0; max-width:700px; font:700 clamp(44px,7vw,82px)/.95 'Playfair Display',serif; } .hero-note { max-width:220px; color:var(--muted); line-height:1.6; }
        .toolbar { display:flex; align-items:center; justify-content:space-between; padding:18px 22px; border-top:4px solid var(--red); background:var(--card); } .toolbar strong { font:700 24px 'Playfair Display',serif; } .button { display:inline-block; padding:12px 16px; color:#fffaf2; background:var(--red); text-decoration:none; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; } .button:hover { background:#7d2c23; }
        .table-wrap { overflow-x:auto; background:var(--card); border:1px solid var(--line); } table { width:100%; min-width:760px; border-collapse:collapse; } th { padding:15px 20px; color:var(--muted); background:#f9f1e7; font-size:11px; letter-spacing:.1em; text-align:left; text-transform:uppercase; } td { padding:19px 20px; border-top:1px solid var(--line); vertical-align:top; } tr:hover td { background:#fffdf8; } .product-name { font-weight:700; } .description { max-width:350px; color:var(--muted); font-size:14px; line-height:1.45; } .price { color:var(--red); font-weight:700; } .quantity { display:inline-block; min-width:34px; padding:5px 8px; color:var(--sage); border:1px solid #b5c1b2; text-align:center; font-weight:700; } .actions { white-space:nowrap; } .actions a { margin-right:13px; color:var(--red); font-size:13px; font-weight:700; text-decoration:none; } .delete { display:inline; } .delete button { padding:0; border:0; color:var(--muted); background:none; cursor:pointer; font:700 13px 'DM Sans',sans-serif; } .empty { padding:55px 20px; color:var(--muted); text-align:center; }
        footer { margin-top:20px; color:var(--muted); font-size:12px; } @media (max-width:650px) { .shell { width:calc(100% - 28px); padding-top:20px; } nav { margin-bottom:52px; } .user { display:none; } .hero { display:block; } .hero-note { margin-top:22px; } .toolbar { align-items:flex-start; gap:16px; } }
    </style>
</head>
<body><main class="shell">
    <nav><a class="brand" href="/products"><span class="stamp">M</span><span>Marrow's Pantry</span></a><div class="nav-actions"><span class="user">Signed in as <?= $escape($username ?? '') ?> · <?= $is_admin ? 'Admin' : 'Viewer' ?></span><?php if ($is_admin): ?><a href="/users/create">Add user</a><?php endif; ?><a href="/logout">Sign out</a></div></nav>
    <section class="hero"><div><p class="eyebrow">Back of house / inventory</p><h1>Good ingredients,<br>well accounted for.</h1></div><p class="hero-note">A quiet ledger for the things that make the menu worth returning to.</p></section>
    <section class="toolbar"><strong><?= $product_count ?> pantry <?= $product_count === 1 ? 'item' : 'items' ?></strong><?php if ($is_admin): ?><a class="button" href="/products/create">+ Add product</a><?php else: ?><span class="user">Read-only inventory</span><?php endif; ?></section>
    <div class="table-wrap"><?php if (!empty($products)): ?><table><thead><tr><th>Product</th><th>Description</th><th>Price</th><th>Quantity</th><?php if ($is_admin): ?><th>Actions</th><?php endif; ?></tr></thead><tbody>
        <?php foreach ($products as $product): ?><tr><td class="product-name"><?= $escape($product['product_name']) ?></td><td class="description"><?= $escape($product['description']) ?></td><td class="price">$<?= number_format((float)$product['price'], 2) ?></td><td><span class="quantity"><?= $escape($product['quantity']) ?></span></td><?php if ($is_admin): ?><td class="actions"><a href="/products/edit/<?= (int)$product['id'] ?>">Edit</a><form class="delete" method="post" action="/products/delete/<?= (int)$product['id'] ?>" onsubmit="return confirm('Remove this product from the pantry?');"><button type="submit">Delete</button></form></td><?php endif; ?></tr><?php endforeach; ?>
    </tbody></table><?php else: ?><p class="empty">The pantry is waiting for its first product. Add one to begin.</p><?php endif; ?></div>
    <footer>Marrow's Pantry · <?= date('Y') ?> · Inventory desk</footer>
</main></body></html>
