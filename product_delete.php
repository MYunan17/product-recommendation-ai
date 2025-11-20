<?php
require 'db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die('ID tidak valid.');
}

$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
$stmt->execute([$id]);

header('Location: products_list.php?msg=' . urlencode('Produk berhasil dihapus.'));
exit;
