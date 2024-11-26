<?php
include '../config/koneksi.php';

$sql = "SELECT absensi.id, siswa.nama, siswa.kelas, absensi.tanggal, absensi.status  
        FROM absensi  
        JOIN siswa ON absensi.id_siswa = siswa.id";
$data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Data Absensi</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $d) : ?>
                    <tr>
                        <td><?= $d['nama'] ?></td>
                        <td><?= $d['kelas'] ?></td>
                        <td><?= $d['tanggal'] ?></td>
                        <td><?= $d['status'] ?></td>
                        <td>
                            <a href="hapus.php?type=absensi&id=<?= $d['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
