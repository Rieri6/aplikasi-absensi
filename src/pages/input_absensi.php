<?php
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_siswa = $_POST['id_siswa'];
    $tanggal = $_POST['tanggal'];
    $status = $_POST['status'];

    $sql = "INSERT INTO absensi (id_siswa, tanggal, status) VALUES (:id_siswa, :tanggal, :status)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_siswa' => $id_siswa, 'tanggal' => $tanggal, 'status' => $status]);

    echo "<script>alert('Absensi berhasil dicatat!'); window.location.href='input_absensi.php';</script>";
}

$siswa = $pdo->query("SELECT * FROM siswa")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Input Absensi</h1>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Siswa</label>
                <select name="id_siswa" class="form-select" required>
                    <?php foreach ($siswa as $s) : ?>
                        <option value="<?= $s['id'] ?>"><?= $s['nama'] ?> - <?= $s['kelas'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Alfa">Alfa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Catat Absensi</button>
        </form>
    </div>
</body>
</html>