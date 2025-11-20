<?php
require 'db.php';

// Ambil input user
$min = (int)($_GET['min'] ?? 0);
$max = (int)($_GET['max'] ?? 999999999);
$p1  = $_GET['priority_1'] ?? '';
$p2  = $_GET['priority_2'] ?? '';

// Validasi sederhana
if ($min <= 0 || $max <= 0 || $p1 === '') {
    die("Input tidak valid.");
}

$stmt = $pdo->prepare("SELECT * FROM products WHERE price BETWEEN ? AND ?");
$stmt->execute([$min, $max]);
$products = $stmt->fetchAll();

// 2️⃣ Bobot prioritas
$weights = [
    'gaming'     => 0,
    'camera'     => 0,
    'battery'    => 0,
    'lightweight'=> 0
];

// Jika user pilih dua prioritas
if ($p2 !== '') {
    $weights[$p1] = 0.6;
    $weights[$p2] = 0.4;
} else {
    // Jika hanya satu prioritas → bobot penuh
    $weights[$p1] = 1.0;
}

//Hitung skor total untuk setiap produk
foreach ($products as &$p) {
    $score = 
        $p['score_gaming']     * $weights['gaming'] +
        $p['score_camera']     * $weights['camera'] +
        $p['score_battery']    * $weights['battery'] +
        $p['score_lightweight']* $weights['lightweight'];

    $p['score_total'] = round($score, 2);
}

//Urutkan produk berdasarkan skor tinggi → rendah
usort($products, function($a, $b){
    return $b['score_total'] <=> $a['score_total'];
});
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Rekomendasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <h2 class="mb-4">📱 Hasil Rekomendasi</h2>

    <a href="search_form.php" class="btn btn-secondary mb-3">← Kembali</a>

    <?php if (empty($products)): ?>
        <div class="alert alert-warning">
            Tidak ada produk yang cocok dengan budget Anda.
        </div>
    <?php endif; ?>

    <div class="row">
        <?php foreach ($products as $p): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if ($p['image_url']): ?>
                        <img src="<?= $p['image_url'] ?>" class="card-img-top" alt="">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5><?= htmlspecialchars($p['name']) ?></h5>
                        <p class="text-muted"><?= htmlspecialchars($p['brand']) ?></p>

                        <p>Harga: <strong>Rp<?= number_format($p['price'], 0, ',', '.') ?></strong></p>

                        <p>Skor Kecocokan:
                            <span class="badge bg-success"><?= $p['score_total'] ?>/10</span>
                        </p>

                        <ul class="small">
                            <li>Gaming: <?= $p['score_gaming'] ?></li>
                            <li>Kamera: <?= $p['score_camera'] ?></li>
                            <li>Baterai: <?= $p['score_battery'] ?></li>
                            <li>Ringan: <?= $p['score_lightweight'] ?></li>
                        </ul>

                        <p><?= nl2br(htmlspecialchars($p['description'])) ?></p>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

</body>
</html>
