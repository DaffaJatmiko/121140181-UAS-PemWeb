<?php
session_start();

// Inisialisasi pesan error
$error_message = "";

// Jika pengguna belum login, tampilkan formulir login
if (!isset($_SESSION['username'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Simpan informasi pengguna ke dalam database
        $servername = "localhost";
        $dbUsername = "id21684061_jatming";
        $dbPassword = "@Workoutplanner123";
        $dbName = "id21684061_workout_planner";

        $connection = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

        // Mengecek koneksi kedatabase
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        // Mengeksekusi query untuk mencari pengguna berdasarkan username
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $connection->query($sql);

        // Mengecek jika username pengguna ditemukan
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Memverifikasi password
            if (password_verify($password, $row['password_hash'])) {
                $_SESSION['username'] = $username;

                // Simpan data pengguna dalam cookie
                setcookie('loggedInUser', $username, time() + (86400 * 30), "/");

                // redirect ke halaman index
                header("location: index.php");
                exit;
            } else {
                // Password tidak sessuai
                $error_message = "Password salah.";
            }
        } else {
            // username tidak ditemukan
            $error_message = "Username tidak ditemukan.";
        }

        // Memutuskan koneksi kedatabase
        $connection->close();
    }
}
?>

<!-- Form HTML dengan tambahan div untuk pesan error -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            background-color: #e74c3c;
            color: #ffffff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
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
    <?php if (!empty($error_message)) : ?>
        <div id="error-message" class="message-container">
            <strong>Error:</strong> <?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <h2 class="text-center mb-4">Login Pengguna</h2>

        
        <form method="post" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p class="mt-3">Belum punya akun? <a href="register.php">Register disini</a></p>
        </form>
    </div>
</body>
</html>
