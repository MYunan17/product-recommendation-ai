<?php
require 'db.php';

$id = $_GET['id'] ?? null;
$product = [
    'name'            => '',
    'brand'           => '',
    'price'           => '',
    'score_gaming'    => 0,
    'score_camera'    => 0,
    'score_battery'   => 0,
    'score_lightweight'=> 0,
    'image_url'       => '',
    'description'     => '',
];

$mode = 'create';

if ($id) {
    $mode = 'edit';
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if ($row) {
        $product = $row;
    } else {
        die('Produk tidak ditemukan.');
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $mode === 'create' ? 'Tambah' : 'Edit' ?> Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4"><?= $mode === 'create' ? 'Tambah Produk' : 'Edit Produk' ?></h1>

    <a href="products_list.php" class="btn btn-secondary mb-3">← Kembali</a>

    <div class="card">
        <div class="card-body">
            <form action="product_save.php" method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($id ?? '') ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control" required
                           value="<?= htmlspecialchars($product['name']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-control" required
                           value="<?= htmlspecialchars($product['brand']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga (Rp)</label>
                    <input type="number" name="price" class="form-control" required min="0"
                           value="<?= htmlspecialchars($product['price']) ?>">
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Score Gaming (0-10)</label>
                        <input type="number" name="score_gaming" class="form-control" min="0" max="10" required
                               value="<?= (int)$product['score_gaming'] ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Score Camera (0-10)</label>
                        <input type="number" name="score_camera" class="form-control" min="0" max="10" required
                               value="<?= (int)$product['score_camera'] ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Score Battery (0-10)</label>
                        <input type="number" name="score_battery" class="form-control" min="0" max="10" required
                               value="<?= (int)$product['score_battery'] ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Score Lightweight (0-10)</label>
                        <input type="number" name="score_lightweight" class="form-control" min="0" max="10" required
                               value="<?= (int)$product['score_lightweight'] ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image URL (opsional)</label>
                    <input type="text" name="image_url" class="form-control"
                           value="<?= htmlspecialchars($product['image_url']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <?= $mode === 'create' ? 'Simpan' : 'Update' ?>
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
