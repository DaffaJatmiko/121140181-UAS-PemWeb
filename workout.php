<?php

class Workout {
  private $connection;

  public function __construct($connection) {
    $this->connection = $connection;
  }

  public function addWorkout($jenis_latihan, $durasi, $intensitas, $hari, $waktu) {
    // Implementasi untuk menambahkan latihan ke dalam basis data
    $jenis_latihan = $this->connection->real_escape_string($jenis_latihan);
    $durasi = $this->connection->real_escape_string($durasi);
    $intensitas = $this->connection->real_escape_string($intensitas);
    $hari = $this->connection->real_escape_string($hari);
    $waktu = $this->connection->real_escape_string($waktu);

    $sql = "INSERT INTO exercise_schedule (jenis_latihan, durasi, intensitas, hari, waktu) VALUES ('$jenis_latihan', '$durasi', '$intensitas', '$hari', '$waktu')";
    $result = $this->connection->query($sql);

    return $result;
}


  public function updateWorkout($id, $jenis_latihan, $durasi, $intensitas, $hari, $waktu) {
    // Implementasi untuk memperbarui data latihan dalam basis data berdasarkan ID
    $jenis_latihan = $this->connection->real_escape_string($jenis_latihan);
    $durasi = $this->connection->real_escape_string($durasi);
    $intensitas = $this->connection->real_escape_string($intensitas);
    $hari = $this->connection->real_escape_string($hari);
    $waktu = $this->connection->real_escape_string($waktu);

    $sql = "UPDATE exercise_schedule SET jenis_latihan = '$jenis_latihan', durasi = '$durasi', intensitas = '$intensitas', hari = '$hari', waktu = '$waktu' WHERE id = $id";
    $result = $this->connection->query($sql);

    return $result;
}

}
