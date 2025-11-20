# 🧠 Product Recommendation System – Rekomendasi HP dengan AI Sederhana

Project ini adalah web app sederhana untuk **rekomendasi HP** berdasarkan preferensi user, 
menggunakan pendekatan **content-based filtering dengan weighted scoring** (bobot nilai).

## 🎯 Fitur Utama

### 👤 User
- Mengisi form preferensi (budget, prioritas kebutuhan, dll.)
- Melihat daftar rekomendasi HP yang diurutkan berdasarkan **skor kecocokan tertinggi**.

### 🔧 Admin
- CRUD data produk HP:
  - Nama, brand, harga
  - Skor gaming, kamera, baterai, lightweight (0–10)
  - Deskripsi & image URL (opsional)

*(Modul user & rekomendasi bisa dikembangkan di tahap berikutnya.)*

## 🧮 Konsep "AI" Sederhana

Rekomendasi dihasilkan menggunakan **weighted scoring**:

score_total = w_gaming * score_gaming
            + w_camera * score_camera
            + w_battery * score_battery
            + w_lightweight * score_lightweight
