<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari formulir registrasi
    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";

    // Validasi input
    if (empty($username) || empty($password)) {
        echo "Username dan password harus diisi.";
        exit;
    }

    // Hash password sebelum disimpan ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Simpan informasi pengguna ke dalam database
    $servername = "localhost";
    $dbUsername = "id21684061_jatming";
    $dbPassword = "@Workoutplanner123";
    $dbName = "id21684061_workout_planner";

    $connection = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Lindungi dari SQL injection
    $username = $connection->real_escape_string($username);

    // Periksa apakah username sudah ada dalam database
    $checkQuery = "SELECT * FROM users WHERE username = '$username'";
    $checkResult = $connection->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Tampilkan pesan error dengan gaya CSS yang lebih baik
        echo "<script>
                // Fungsi untuk menampilkan pesan error
                function showError() {
                    document.getElementById('message-container').innerHTML = '<strong>Error:</strong> Username sudah digunakan. Silakan pilih username lain.';
                    document.getElementById('message-container').style.backgroundColor = '#e74c3c';
                    document.getElementById('message-container').style.color = '#ffffff';
                    document.getElementById('message-container').style.padding = '10px';
                    document.getElementById('message-container').style.borderRadius = '5px';
                    document.getElementById('message-container').style.display = 'block';
                }
                // Panggil fungsi saat halaman dimuat
                window.onload = showError;
              </script>";
    } else {
        // Username belum ada, lakukan registrasi
        $sql = "INSERT INTO users (username, password_hash) VALUES ('$username', '$hashedPassword')";

        if ($connection->query($sql) === TRUE) {
            // Tampilkan pesan berhasil dengan gaya CSS yang mirip dengan pesan error
            echo "<div id='success-message' style='display: none; background-color: #2ecc71; color: #ffffff; padding: 10px; border-radius: 5px; margin-bottom: 10px;'>
                    Registrasi berhasil. Silakan <a href='login.php' style='color: #ffffff; text-decoration: underline;'>login</a>.
                  </div>";
            // Tambahkan script untuk menampilkan pesan berhasil setelah halaman dimuat
            echo "<script>
                    // Fungsi untuk menampilkan pesan berhasil dan redirect setelah 2 detik
                    function showSuccess() {
                        document.getElementById('success-message').style.display = 'block';
                        setTimeout(function(){ window.location.href = 'login.php'; }, 1000); // Redirect setelah 2 detik
                    }
                    // Panggil fungsi saat halaman dimuat
                    window.onload = showSuccess;
                  </script>";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }

    $connection->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #2c3e50;
            color: #ecf0f1;
            flex-direction: column;
        }
        .message-container {
            text-align: center;
            margin-bottom: 20px;
        }
        #error-message,
        #success-message {
            display: none;
            background-color: #e74c3c;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px;
        }
        form {
            max-width: 300px;
            margin: auto;
            background-color: #34495e;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; 
        }
        label {
            color: #bdc3c7;
        }
        .form-control {
            background-color: #2c3e50;
            color: #ecf0f1;
            border: 1px solid #bdc3c7;
        }
        .btn-primary {
            background-color: #3498db;
            border: 1px solid #3498db;
        }
        .btn-primary:hover {
            background-color: #2980b9;
            border: 1px solid #2980b9;
        }
        .btn-secondary {
            background-color: #2ecc71;
            border: 1px solid #2ecc71;
        }
        .btn-secondary:hover {
            background-color: #27ae60;
            border: 1px solid #27ae60;
        }
        a {
            color: #3498db;
        }
        a:hover {
            color: #2980b9;
        }
    </style>
</head>
<body>
    <div id="message-container" class="message-container"></div>

    <div class="container">
        <h2 class="text-center mb-4">Registrasi Pengguna</h2>
        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <p class="mt-3">Sudah punya akun? <a href="login.php">Login disini</a></p>
        </form>
    </div>
</body>
</html>
