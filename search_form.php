<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cari Rekomendasi HP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h1 class="text-center mb-4">🔍 Cari Rekomendasi HP</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="search_result.php" method="get">

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Budget Minimum (Rp)</label>
                        <input type="number" name="min" class="form-control" required min="0">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Budget Maksimum (Rp)</label>
                        <input type="number" name="max" class="form-control" required min="0">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prioritas Kebutuhan</label>
                    <select name="priority_1" class="form-select" required>
                        <option value="">-- Pilih Prioritas Utama --</option>
                        <option value="gaming">Gaming</option>
                        <option value="camera">Kamera</option>
                        <option value="battery">Baterai</option>
                        <option value="lightweight">Ringan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Prioritas Kedua (opsional)</label>
                    <select name="priority_2" class="form-select">
                        <option value="">-- Tidak Ada --</option>
                        <option value="gaming">Gaming</option>
                        <option value="camera">Kamera</option>
                        <option value="battery">Baterai</option>
                        <option value="lightweight">Ringan</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    Cari Rekomendasi
                </button>

            </form>
        </div>
    </div>
</div>
</body>
</html>
