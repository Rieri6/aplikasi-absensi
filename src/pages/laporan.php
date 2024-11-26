<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $start = $_POST['start'];
    $end = $_POST['end'];

    $sql = "SELECT siswa.nama, siswa.kelas, absensi.tanggal, absensi.status 
            FROM absensi 
            JOIN siswa ON absensi.id_siswa = siswa.id 
            WHERE absensi.tanggal BETWEEN :start AND :end";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['start' => $start, 'end' => $end]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kehadiran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Laporan Kehadiran</h1>
        <form method="POST" class="mb-4">
            <div class="row">
                <div class="col-md-5">
                    <label class="form-label">Mulai</label>
                    <input type="date" name="start" class="form-control" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Selesai</label>
                    <input type="date" name="end" class="form-control" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </div>
        </form>
        <?php if (!empty($data)) : ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $d) : ?>
                        <tr>
                            <td><?= $d['nama'] ?></td>
                            <td><?= $d['kelas'] ?></td>
                            <td><?= $d['tanggal'] ?></td>
                            <td><?= $d['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
