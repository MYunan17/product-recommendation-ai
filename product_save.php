<?php
require 'db.php';

// Ambil data dari form
$id               = $_POST['id'] ?? null;
$name             = trim($_POST['name'] ?? '');
$brand            = trim($_POST['brand'] ?? '');
$price            = (int)($_POST['price'] ?? 0);
$score_gaming     = (int)($_POST['score_gaming'] ?? 0);
$score_camera     = (int)($_POST['score_camera'] ?? 0);
$score_battery    = (int)($_POST['score_battery'] ?? 0);
$score_lightweight= (int)($_POST['score_lightweight'] ?? 0);
$image_url        = trim($_POST['image_url'] ?? '');
$description      = trim($_POST['description'] ?? '');

// Validasi sederhana
if ($name === '' || $brand === '' || $price <= 0) {
    die('Data tidak valid.');
}

if ($id) {
    // mode update
    $sql = "UPDATE products 
            SET name = :name,
                brand = :brand,
                price = :price,
                score_gaming = :score_gaming,
                score_camera = :score_camera,
                score_battery = :score_battery,
                score_lightweight = :score_lightweight,
                image_url = :image_url,
                description = :description
            WHERE id = :id";
} else {
    // mode insert
    $sql = "INSERT INTO products 
            (name, brand, price, score_gaming, score_camera, score_battery, score_lightweight, image_url, description)
            VALUES
            (:name, :brand, :price, :score_gaming, :score_camera, :score_battery, :score_lightweight, :image_url, :description)";
}

$stmt = $pdo->prepare($sql);

$params = [
    ':name'            => $name,
    ':brand'           => $brand,
    ':price'           => $price,
    ':score_gaming'    => $score_gaming,
    ':score_camera'    => $score_camera,
    ':score_battery'   => $score_battery,
    ':score_lightweight'=> $score_lightweight,
    ':image_url'       => $image_url,
    ':description'     => $description,
];

if ($id) {
    $params[':id'] = $id;
}

$stmt->execute($params);

header('Location: products_list.php?msg=' . urlencode('Data produk berhasil disimpan.'));
exit;
