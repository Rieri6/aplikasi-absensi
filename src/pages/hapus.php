<?php
include '../config/koneksi.php';

$type = $_GET['type'];
$id = $_GET['id'];

if ($type === 'siswa') {
    $pdo->prepare("DELETE FROM siswa WHERE id = :id")->execute(['id' => $id]);
} elseif ($type === 'absensi') {
    $pdo->prepare("DELETE FROM absensi WHERE id = :id")->execute(['id' => $id]);
}

echo "<script>alert('Berhasil hapus!'); window.location.href='lihat_absensi.php';</script>";
?>
