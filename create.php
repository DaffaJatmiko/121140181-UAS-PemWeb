<?php
session_start(); // Mulai sesi

include('Workout.php');

// Periksa status login pengguna
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$servername = "localhost";
$username = "id21684061_jatming";
$password = "@Workoutplanner123";
$database = "id21684061_workout_planner";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("connection failed : " . $connection->connect_error);
}

$workoutManager = new Workout($connection);

$jenis_latihan = "";
$durasi = "";
$intensitas = "";
$hari = "";
$waktu = "";

$errorMessage = "";
$successMessage = "";

// Implementasi state management
$jenis_latihan_cookie = "";
$durasi_cookie = "";
$intensitas_cookie = "";
$hari_cookie = "";
$waktu_cookie = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Simpan data ke cookie jika form disubmit
    $jenis_latihan_cookie = isset($_POST['jenis_latihan']) ? $_POST['jenis_latihan'] : "";
    $durasi_cookie = isset($_POST['durasi']) ? $_POST['durasi'] : "";
    $intensitas_cookie = isset($_POST['intensitas']) ? $_POST['intensitas'] : "";
    $hari_cookie = isset($_POST['hari']) ? $_POST['hari'] : "";
    $waktu_cookie = isset($_POST['waktu']) ? $_POST['waktu'] : "";

    setcookie('jenis_latihan', $jenis_latihan_cookie, time() + (86400 * 30), "/"); // Cookie berlaku selama 30 hari
    setcookie('durasi', $durasi_cookie, time() + (86400 * 30), "/");
    setcookie('intensitas', $intensitas_cookie, time() + (86400 * 30), "/");
    setcookie('hari', $hari_cookie, time() + (86400 * 30), "/");
    setcookie('waktu', $waktu_cookie, time() + (86400 * 30), "/");
} else {
    // Ambil data dari cookie jika ada
    $jenis_latihan_cookie = isset($_COOKIE['jenis_latihan']) ? $_COOKIE['jenis_latihan'] : "";
    $durasi_cookie = isset($_COOKIE['durasi']) ? $_COOKIE['durasi'] : "";
    $intensitas_cookie = isset($_COOKIE['intensitas']) ? $_COOKIE['intensitas'] : "";
    $hari_cookie = isset($_COOKIE['hari']) ? $_COOKIE['hari'] : "";
    $waktu_cookie = isset($_COOKIE['waktu']) ? $_COOKIE['waktu'] : "";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis_latihan = isset($_POST['jenis_latihan']) ? $_POST['jenis_latihan'] : "";
    $durasi = isset($_POST['durasi']) ? $_POST['durasi'] : "";
    $intensitas = isset($_POST['intensitas']) ? $_POST['intensitas'] : "";
    $hari = isset($_POST['hari']) ? $_POST['hari'] : "";
    $waktu = isset($_POST['waktu']) ? $_POST['waktu'] : "";

    // Validasi input sebelum diproses oleh PHP
    if (empty($jenis_latihan) || empty($durasi) || empty($intensitas) || empty($hari) || empty($waktu)) {
        $errorMessage = "Semua parameter harus diisi.";
    } else {
        // Tambahkan workout baru ke database
        $result = $workoutManager->addWorkout($jenis_latihan, $durasi, $intensitas, $hari, $waktu);

        if (!$result) {
            $errorMessage = "Terjadi kesalahan dalam eksekusi query: " . $connection->error;
        } else {
            $successMessage = "Workout berhasil ditambahkan.";
            // Hapus cookie setelah berhasil menambahkan workout
            setcookie('jenis_latihan', "", time() - 3600, "/");
            setcookie('durasi', "", time() - 3600, "/");
            setcookie('intensitas', "", time() - 3600, "/");
            setcookie('hari', "", time() - 3600, "/");
            setcookie('waktu', "", time() - 3600, "/");
            // Redirect ke halaman utama setelah berhasil menambahkan workout
            header("Refresh: 1; url=/index.php"); // Redirect setelah 2 detik
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Planner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        background-color: #2c3e50;
        color: #ecf0f1;
    }
    .container {
        background-color: #34495e;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        color: #ecf0f1; 
    }
    h2 {
        color: #ecf0f1;
    }
    .btn-primary {
        background-color: #3498db;
        border: 1px solid #3498db;
    }
    .btn-primary:hover {
        background-color: #2980b9;
        border: 1px solid #2980b9;
    }
    .btn-danger {
        background-color: #e74c3c;
        border: 1px solid #e74c3c;
    }
    .btn-danger:hover {
        background-color: #c0392b;
        border: 1px solid #c0392b;
    }
    input[type="text"] {
        color: #000000; 
    }
    .btn-primary, .btn-danger, a {
        margin-right: 5px;
    }
</style>
    <script>
        function validateForm() {
            // Implementasi validasi input sebelum diproses oleh PHP
            var jenisLatihan = document.getElementById('jenis_latihan').value;
            var durasi = document.getElementById('durasi').value;
            var intensitas = document.getElementById('intensitas').value;
            var hari = document.getElementById('hari').value;
            var waktu = document.getElementById('waktu').value;

            if (jenisLatihan === '' || durasi === '' || intensitas === '' || hari === '' || waktu === '') {
                alert('Harap lengkapi semua kolom input.');
                return false;
            }
            return true;
        }

        function handleFormSubmit() {
            if (validateForm()) {
                // Lakukan submit form ke PHP
                document.getElementById('workoutForm').submit();
            }
        }
    </script>
</head>
<body>
    <div class="container my-5">
        <h2>New Workout</h2>

        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post" onsubmit="return validateForm()" id="workoutForm" autocomplete="off">
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Jenis Latihan</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="jenis_latihan" id="jenis_latihan" value="<?php echo $jenis_latihan_cookie; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Durasi (menit)</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="durasi" id="durasi" value="<?php echo $durasi_cookie; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Intensitas</label>
                <div class="col-sm-6">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="intensitas" id="rendah" value="Rendah" <?php echo ($intensitas_cookie == 'Rendah') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="rendah">Rendah</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="intensitas" id="sedang" value="Sedang" <?php echo ($intensitas_cookie == 'Sedang') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="sedang">Sedang</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="intensitas" id="tinggi" value="Tinggi" <?php echo ($intensitas_cookie == 'Tinggi') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="tinggi">Tinggi</label>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Hari</label>
                <div class="col-sm-6">
                    <select class="form-select" name="hari" id="hari">
                        <option value="" <?php echo ($hari_cookie == '') ? 'selected' : ''; ?> disabled>Pilih Hari</option>
                        <option value="Senin" <?php echo ($hari_cookie == 'Senin') ? 'selected' : ''; ?>>Senin</option>
                        <option value="Selasa" <?php echo ($hari_cookie == 'Selasa') ? 'selected' : ''; ?>>Selasa</option>
                        <option value="Rabu" <?php echo ($hari_cookie == 'Rabu') ? 'selected' : ''; ?>>Rabu</option>
                        <option value="Kamis" <?php echo ($hari_cookie == 'Kamis') ? 'selected' : ''; ?>>Kamis</option>
                        <option value="Jumat" <?php echo ($hari_cookie == 'Jumat') ? 'selected' : ''; ?>>Jumat</option>
                        <option value="Sabtu" <?php echo ($hari_cookie == 'Sabtu') ? 'selected' : ''; ?>>Sabtu</option>
                        <option value="Minggu" <?php echo ($hari_cookie == 'Minggu') ? 'selected' : ''; ?>>Minggu</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="" class="col-sm-3 col-form-label">Waktu</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="waktu" id="waktu" value="<?php echo $waktu_cookie; ?>">
                </div>
            </div>

            <?php
            if (!empty($successMessage)) {
                echo "
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-3'> 
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a href="/index.php" class="btn btn-outline-primary" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
