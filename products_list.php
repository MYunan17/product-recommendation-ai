<?php
// products_list.php
require 'db.php';

// Ambil semua produk
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk HP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4">Manajemen Produk HP</h1>

    <a href="product_form.php" class="btn btn-primary mb-3">+ Tambah Produk</a>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_GET['msg']) ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <strong>Daftar Produk</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Brand</th>
                    <th>Harga</th>
                    <th>Gaming</th>
                    <th>Camera</th>
                    <th>Battery</th>
                    <th>Lightweight</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="9" class="text-center">Belum ada produk.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($products as $index => $p): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= htmlspecialchars($p['name']) ?></td>
                            <td><?= htmlspecialchars($p['brand']) ?></td>
                            <td>Rp<?= number_format($p['price'], 0, ',', '.') ?></td>
                            <td><?= (int)$p['score_gaming'] ?></td>
                            <td><?= (int)$p['score_camera'] ?></td>
                            <td><?= (int)$p['score_battery'] ?></td>
                            <td><?= (int)$p['score_lightweight'] ?></td>
                            <td>
                                <a href="product_form.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="product_delete.php?id=<?= $p['id'] ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin ingin hapus produk ini?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
