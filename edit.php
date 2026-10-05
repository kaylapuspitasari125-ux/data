<?php
require_once "koneksi.php";

$id=(int)$_GET['id'];
$data=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM testimoni WHERE id=$id"));
if(isset($_POST['update'])){
    $nama=mysqli_real_escape_string($conn,$_POST['nama']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pesan=mysqli_real_escape_string($conn,$_POST['pesan']);

    mysqli_query($conn,"UPDATE testimoni SET nama='$nama',email='$email',pesan='$pesan' WHERE id=$id");
    header("Location:index.php#testimoni");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Edit Testimoni</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <div class="col-md-6 mx-auto bg-white p-4 rounded shadow-sm">
            <h3 class="mb-3">Edit Testimoni</h3>
            <form method="POST">
                <input name="nama" class="form-control mb-3"
                       value="<?= htmlspecialchars($data['nama']) ?>" placeholder="Nama" required>
                <input name="email" type="email" class="form-control mb-3"
                       value="<?= htmlspecialchars($data['email']) ?>" placeholder="Email" required>
                <textarea name="pesan" class="form-control mb-3"
                          rows="4" placeholder="Pesan" required><?= htmlspecialchars($data['pesan']) ?></textarea>
                <button name="update" class="btn">Simpan</button>
                <a href="index.php#testimoni" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>