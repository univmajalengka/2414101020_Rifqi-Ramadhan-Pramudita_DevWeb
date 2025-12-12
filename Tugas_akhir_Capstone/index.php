<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Wisata Pantai Balongan Indah - Beranda</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <div class="logo">Wisata Balongan Indah</div>
        <nav>
            <a href="index.php" class="active">Beranda</a>
            <a href="index.php#paket">Paket Wisata</a>
            <a href="modifikasi_pesanan.php">Data Pesanan</a>
        </nav>
    </header>

    <main>
        
        <section class="hero-section">
            <h2>Keindahan Pantai Balongan Indah</h2>
            <p>Rasakan pesona alam laut yang otentik, cocok untuk liburan keluarga.</p>
            
            <div class="hero-images">
                <img src="assets/balongan_main.jpg" alt="Pantai Utama" class="img-main">
                <img src="assets/balongan_snorkeling.jpg" alt="Snorkeling">
                <img src="assets/balongan_sunset.jpg" alt="Sunset">
                <img src="assets/balongan_resto.jpg" alt="Restoran">
                <img src="assets/balongan_boat.jpg" alt="Perahu">
            </div>
        </section>

        <h3 class="section-title" id="paket">Paket Terpopuler</h3>
        
        <div class="package-list">
        <?php
        $packages = [
            ["nama" => "Paket Regulasi Pantai (Reguler)", "deskripsi" => "Akses penuh ke area pantai, fasilitas dasar, dan spot foto.", "harga" => "15000", "video_link" => "https://www.youtube.com/embed/youtubeID1"],
            ["nama" => "Paket Sunset Romantis", "deskripsi" => "Paket makan malam di tepi pantai dan akses melihat matahari terbenam.", "harga" => "50000", "video_link" => "https://www.youtube.com/embed/youtubeID2"]
        ];

        foreach ($packages as $package):
        ?>
            <div class="paket-wisata">
                <div class="package-image">
                    <img src="assets/package_default.jpg" alt="<?php echo $package['nama']; ?>">
                </div>
                
                <div class="package-details">
                    <div>
                        <h4><?php echo $package['nama']; ?></h4>
                        <p><?php echo $package['deskripsi']; ?></p>
                        <p class="package-price">Harga: Rp <?php echo number_format($package['harga'], 0, ',', '.'); ?>/Pax</p>
                    </div>
                    <div>
                        <a href="pemesanan.php?paket=<?php echo urlencode($package['nama']); ?>" class="btn-pesan">Pesan Sekarang &rarr;</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
        
        <section class="video-ulasan">
            <h3 class="section-title">🎬 Video Ulasan Pantai</h3>
            <p style="text-align: center; margin-bottom: 20px;">Tonton ulasan visual tentang keindahan dan suasana Pantai Balongan Indah.</p>
            
            <div class="video-container">
                <iframe 
                    width="100%" 
                    height="450" 
                    src="https://www.youtube.com/embed/FjMRQgxzoqw" 
                    frameborder="0" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                    allowfullscreen>
                </iframe>
            </div>
        </section>

    </main>
    
    </body>
</html>