<?php
require_once "koneksi.php";

$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM testimoni WHERE id=$id");

header("Location:index.php#testimoni");
exit;
?>