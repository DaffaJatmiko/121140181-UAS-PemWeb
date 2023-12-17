<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit;
}

// Fungsi logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    setcookie('loggedInUser', '', time() - 3600, "/"); // Hapus cookie
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Planner</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

        // Fungsi untuk menetapkan cookie
        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        // Fungsi untuk mendapatkan nilai cookie
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        // Fungsi untuk menghapus cookie
        function deleteCookie(cname) {
            document.cookie = cname + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }

        // Implementasi pengelolaan state menggunakan browser storage
        function saveToLocalStorage(data) {
            localStorage.setItem('workoutData', JSON.stringify(data));
        }

        function getFromLocalStorage() {
            var data = localStorage.getItem('workoutData');
            return data ? JSON.parse(data) : null;
        }

        // Penggunaan contoh untuk menyimpan dan mendapatkan data dari browser storage
        var sampleData = {
            jenis_latihan: 'Contoh Latihan',
            durasi: '30',
            intensitas: 'Sedang',
            hari: 'Senin',
            waktu: '08:00'
        };

        saveToLocalStorage(sampleData);
        var retrievedData = getFromLocalStorage();
        console.log('Retrieved Data:', retrievedData);

        // Fungsi untuk mengganti mode tampilan
        function toggleDarkMode() {
            var body = document.body;
            var isDarkMode = body.classList.contains('dark-mode');

            if (isDarkMode) {
                body.classList.remove('dark-mode');
                body.classList.add('light-mode');
                localStorage.setItem('darkMode', 'disabled');
            } else {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'enabled');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            var body = document.body;
            var isDarkMode = localStorage.getItem('darkMode') === 'enabled';
            var tbody = document.querySelector('.table-body');

            if (isDarkMode) {
                body.classList.add('dark-mode');
                tbody.classList.add('dark-mode');
            } else {
                body.classList.add('light-mode');
                tbody.classList.add('light-mode');
            }
        });
    </script>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
            transition: background-color 0.5s, color 0.5s;
        }

        .container {
            margin-top: 50px;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.5s;
        }

        h2 {
            text-align: center;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }

        .btn-danger:hover {
            background-color: #bd2130;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.5s;
            background-color: #34495e;
        }

        tr {
            color: #ffffff;
        }

        th, td {
            border: 1px solid #34495e;
            padding: 12px;
            text-align: center;
        }

        th.light-mode, td.light-mode {
            background-color: #3498db;
            color: #000000;
        }

        tbody tr {
            transition: background-color 0.5s, color 0.5s;
        }

        tr.dark-mode {
            color: #ffffff;
        }

        tbody tr.dark-mode {
            color: #ffffff; 
        }

        tbody tr.dark-mode:nth-child(odd) {
            background-color: #34495e;
        }

        tbody tr.dark-mode:hover {
            background-color: #3d5266;
        }

        tbody tr.light-mode {
            background-color: #ecf0f1;
            color: #2c3e50; /* Warna teks untuk mode terang */
        }

        tbody tr.light-mode:nth-child(odd) {
            background-color: #ecf0f1;
        }

        tbody tr.light-mode:hover {
            background-color: #d0d3d4;
        }

        /* Warna teks untuk mode terang */
        tbody tr.light-mode {
            color: #2c3e50;
        }

        .btn-primary, .btn-danger, a {
            margin-right: 5px;
            color: #ffffff;
        }

        /* Gaya untuk mode tampilan gelap */
        body.dark-mode {
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .container.dark-mode {
            background-color: #34495e;
        }

        /* Gaya untuk mode tampilan terang */
        body.light-mode {
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        .container.light-mode {
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Workout Plan</h2>

        <form method="post" action="">
            <button type="submit" name="logout" class="btn btn-danger float-end">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>

        <button onclick="toggleDarkMode()" class="btn btn-primary">
            <i class="bi bi-brightness-high"></i> Switch Mode
        </button>

        <a href="/create.php" class="btn btn-primary">
            <i class="bi bi-plus"></i> New Workout
        </a>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Jenis Latihan</th>
                    <th>Durasi (menit)</th>
                    <th>Intensitas</th>
                    <th>Hari</th>
                    <th>Waktu</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody class='<?php echo isset($_COOKIE['darkMode']) && $_COOKIE['darkMode'] === 'enabled' ? "dark-mode" : "light-mode"; ?>'>
                <?php
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

                // Read all rows from the database table
                $sql = "SELECT * FROM exercise_schedule";
                $result = $connection->query($sql);

                if (!$result) {
                    die("Invalid query : " . $connection->error);
                }

                // Read data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[jenis_latihan]</td>
                        <td>$row[durasi]</td>
                        <td>$row[intensitas]</td>
                        <td>$row[hari]</td>
                        <td>$row[waktu]</td>
                        <td>
                            <a href='/edit.php?id=$row[id]' class='btn btn-primary btn-sm'>
                                <i class='bi bi-pencil'></i> Edit
                            </a>
                            <a href='/delete.php?id=$row[id]' class='btn btn-danger btn-sm'>
                                <i class='bi bi-trash'></i> Delete
                            </a>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
