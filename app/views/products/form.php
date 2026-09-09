<?php
$escape = static fn($value) => htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
$is_edit = $mode === 'edit';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $is_edit ? 'Edit product' : 'Add product' ?> | Marrow's Pantry</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root { --ink:#24201d; --muted:#766c63; --paper:#f4eee5; --card:#fffaf2; --red:#9d3b2e; --gold:#bd8b42; --line:#dfd2c2; } * { box-sizing:border-box; } body { margin:0; min-height:100vh; color:var(--ink); background:var(--paper); background-image:radial-gradient(#d9c8b2 1px,transparent 1px); background-size:24px 24px; font-family:'DM Sans',sans-serif; } .shell { width:min(700px,calc(100% - 40px)); margin:auto; padding:28px 0 60px; } nav { display:flex; justify-content:space-between; margin-bottom:75px; } nav a { color:var(--red); font-size:13px; font-weight:700; text-decoration:none; text-transform:uppercase; letter-spacing:.1em; } .eyebrow { margin:0 0 12px; color:var(--gold); font-size:12px; font-weight:700; letter-spacing:.16em; text-transform:uppercase; } h1 { margin:0 0 12px; font:700 clamp(42px,7vw,68px)/.98 'Playfair Display',serif; } .intro { margin:0 0 32px; color:var(--muted); line-height:1.6; } form { padding:30px; border-top:4px solid var(--red); background:var(--card); border:1px solid var(--line); } .error { margin-bottom:22px; padding:12px 14px; border-left:3px solid var(--red); background:#f7ded7; color:#7d2c23; font-size:14px; } label { display:block; margin:19px 0 7px; font-size:12px; font-weight:700; letter-spacing:.08em; text-transform:uppercase; } input, textarea { width:100%; padding:13px 14px; border:1px solid var(--line); background:#fffdf9; color:var(--ink); font:inherit; } textarea { min-height:125px; resize:vertical; } input:focus, textarea:focus { outline:2px solid var(--gold); outline-offset:2px; } .grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; } .submit { display:flex; justify-content:flex-end; gap:14px; margin-top:28px; } .submit a, button { padding:13px 17px; border:0; cursor:pointer; font:700 12px 'DM Sans',sans-serif; letter-spacing:.08em; text-decoration:none; text-transform:uppercase; } .submit a { color:var(--red); border:1px solid var(--line); } button { color:#fffaf2; background:var(--red); } button:hover { background:#7d2c23; } @media (max-width:600px) { .shell { width:calc(100% - 28px); } nav { margin-bottom:52px; } form { padding:22px; } .grid { display:block; } }
    </style>
</head>
<body><main class="shell"><nav><a href="/products">&larr; Pantry inventory</a><a href="/logout">Sign out</a></nav>
    <p class="eyebrow">Marrow's Pantry / inventory desk</p><h1><?= $is_edit ? 'Refine the dish.' : 'Stock the pantry.' ?></h1><p class="intro"><?= $is_edit ? 'Keep the details honest so the kitchen knows exactly what it has.' : 'Add an ingredient or finished product to the restaurant ledger.' ?></p>
    <form method="post" action="<?= $is_edit ? '/products/edit/' . (int)$product['id'] : '/products/create' ?>">
        <?php if (!empty($error)): ?><div class="error"><?= $escape($error) ?></div><?php endif; ?>
        <label for="product_name">Product name</label><input id="product_name" name="product_name" type="text" maxlength="100" value="<?= $escape($product['product_name']) ?>" required>
        <label for="description">Description</label><textarea id="description" name="description" required><?= $escape($product['description']) ?></textarea>
        <div class="grid"><div><label for="price">Price</label><input id="price" name="price" type="number" min="0" step="0.01" value="<?= $escape($product['price']) ?>" required></div><div><label for="quantity">Quantity</label><input id="quantity" name="quantity" type="number" min="0" step="1" value="<?= $escape($product['quantity']) ?>" required></div></div>
        <div class="submit"><a href="/products">Cancel</a><button type="submit"><?= $is_edit ? 'Save changes' : 'Add to pantry' ?></button></div>
    </form>
</main></body></html>
