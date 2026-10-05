<?php
require_once "koneksi.php";
mysqli_query($conn,"UPDATE pengunjung SET jumlah=jumlah+1 WHERE id=1");
$pengunjung=mysqli_fetch_assoc(mysqli_query($conn,"SELECT jumlah FROM pengunjung WHERE id=1"));
if(isset($_POST['kirim'])){
    $nama=mysqli_real_escape_string($conn,$_POST['nama']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pesan=mysqli_real_escape_string($conn,$_POST['pesan']);
    mysqli_query($conn,"INSERT INTO testimoni(nama,email,pesan) VALUES('$nama','$email','$pesan')");
    header("Location:index.php#testimoni");exit;
}
$data=mysqli_query($conn,"SELECT * FROM testimoni ORDER BY id DESC");
$jumlah=mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>DapurKita Cooking Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root{--orange:#e98a68}
        .btn-orange{background:var(--orange);color:#fff;border:0}
        section:nth-of-type(odd){background:#fff7f3}
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-orange" href="#beranda">
            <img src="images/logo.jpeg" width="40" class="me-2">DapurKita
        </a>
        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="#beranda">Beranda</a>
                <a class="nav-link" href="#profil">Profil</a>
                <a class="nav-link" href="#kursus">Kursus</a>
                <a class="nav-link" href="#galeri">Galeri</a>
                <a class="nav-link" href="#testimoni">Testimoni</a>
                <span class="nav-link">
                    <i class="bi bi-people"></i> <?= $pengunjung['jumlah'] ?>
                </span>
            </div>
            <form class="d-flex ms-3" role="search">
                <input class="form-control me-2" type="search" placeholder="Search">
                <button class="btn btn-outline-secondary" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
<section id="beranda" class="py-5">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h1 class="fw-bold">Belajar Memasak <span class="text-orange">Jadi Lebih Menyenangkan</span></h1>
                <p class="lead text-secondary">Temukan keseruan memasak bersama DapurKita dengan pembelajaran yang mudah dan praktis.</p>
                <a href="#kursus" class="btn btn-orange">Lihat Kursus</a>
            </div>
            <div class="col-lg-6">
                <img src="images/hero.png" class="img-fluid rounded-4 w-100">
            </div>
        </div>
    </div>
</section>
<section id="profil" class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center mb-4 text-orange">Tentang DapurKita</h2>
        <div class="row align-items-center g-4">
            <div class="col-md-6">
                <img src="images/profil.png" class="img-fluid rounded-4" style="width:90%">
            </div>
            <div class="col-md-6">
                <p class="text-secondary">DapurKita Cooking Course adalah tempat belajar memasak untuk siapa saja yang ingin meningkatkan kemampuan memasaknya.</p>
                <h5 class="text-orange">Visi</h5>
                <p class="text-secondary">Menjadi tempat belajar memasak yang kreatif, praktis, dan menyenangkan.</p>
                <h5 class="text-orange">Misi</h5>
                <p class="text-secondary">Memberikan pembelajaran memasak yang mudah dipahami dan menyenangkan.</p>
                <a href="#kursus" class="btn btn-orange">Lihat Kursus</a>
            </div>
        </div>
    </div>
</section>
<section id="kursus" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4 text-orange">Pilihan Kursus</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            <?php
            $kursus=[
                ["n.jpeg","Masakan Nusantara","Belajar makanan khas Indonesia.","Rp200.000"],
                ["i.jpeg","Italian Cooking","Belajar pasta dan makanan Italia.","Rp250.000"],
                ["b.jpeg","Baking & Pastry","Belajar membuat kue dan pastry.","Rp300.000"],
                ["d.jpeg","Dessert & Snack","Belajar dessert dan camilan.","Rp225.000"]
            ];
            foreach($kursus as $k){ ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="images/<?= $k[0] ?>" class="card-img-top">
                        <div class="card-body">
                            <h5><?= $k[1] ?></h5>
                            <p class="text-secondary"><?= $k[2] ?></p>
                            <b class="text-orange"><?= $k[3] ?></b>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<section id="galeri" class="py-5 bg-white">
    <div class="container">
        <h2 class="text-center mb-4 text-orange">Galeri</h2>
        <div class="row row-cols-1 row-cols-md-3 g-3">
            <?php foreach(["1.jpg","2.jpg","3.jpg"] as $img){ ?>
                <div class="col">
                    <img src="images/<?= $img ?>" class="img-fluid rounded-3 w-100">
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<section id="testimoni" class="py-5">
    <div class="container">
        <h2 class="text-center text-orange">Testimoni</h2>
        <p class="text-center text-secondary"><?= $jumlah ?> Komentar</p>
        <div class="card shadow-sm border-0 mx-auto mb-4" style="max-width:800px">
            <div class="card-body">
                <form method="POST">
                    <input name="nama" class="form-control mb-3" placeholder="Nama" required>
                    <input name="email" type="email" class="form-control mb-3" placeholder="Email" required>
                    <textarea name="pesan" class="form-control mb-3" rows="4" placeholder="Tulis pengalaman..." required></textarea>
                    <button name="kirim" class="btn btn-orange">Kirim Testimoni</button>
                </form>
            </div>
        </div>
        <?php while($d=mysqli_fetch_assoc($data)){ ?>
            <div class="card shadow-sm border-0 mx-auto mb-3" style="max-width:800px">
                <div class="card-body">
                    <b><?= htmlspecialchars($d['nama']) ?></b>
                    <small class="text-secondary"> · <?= htmlspecialchars($d['email']) ?></small>
                    <small class="float-end"><?= date('d-m-Y',strtotime($d['created_at'])) ?></small>
                    <p class="mt-3"><?= nl2br(htmlspecialchars($d['pesan'])) ?></p>
                    <a class="text-orange me-3" href="edit.php?id=<?= $d['id'] ?>">Edit</a>
                    <a class="text-danger" href="hapus.php?id=<?= $d['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
<footer class="bg-dark text-white text-center py-4">
    <h5>🍳 DapurKita Cooking Course</h5>
    <p class="text-secondary">Belajar memasak dengan mudah dan menyenangkan.</p>
    <button class="btn btn-orange" data-bs-toggle="modal" data-bs-target="#whatsappModal">
        <i class="bi bi-whatsapp"></i> WhatsApp
    </button>
</footer>
<div class="modal fade" id="whatsappModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hubungi Kami</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <p>Hubungi kami melalui WhatsApp.</p>
                <a href="https://wa.me/6281234567890" class="btn btn-success">
                    <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 