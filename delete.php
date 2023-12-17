<?php
session_start(); 

// Mengecek apakah id tersedia di database atau tidak
if (isset($_GET["id"])) {
  $id = $_GET["id"];

  $servername = "localhost";
  $username = "id21684061_jatming";
  $password = "@Workoutplanner123";
  $database = "id21684061_workout_planner";

  // Create connection
  $connection = new mysqli($servername, $username, $password, $database);


  // Menghapus data di database berdasarkan id
  $sql = "DELETE FROM exercise_schedule WHERE id = $id";
  $connection->query($sql);

}

// redirect ke halaman index
header("location: /index.php");
exit;
?>
