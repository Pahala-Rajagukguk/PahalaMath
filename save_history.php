<?php
$servername = "localhost"; // Ganti sesuai server Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "calculator_history";

// Koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari request
$data = json_decode(file_get_contents('php://input'), true);
$expression = $data['expression'];
$result = $data['result'];

// Simpan data
$sql = "INSERT INTO history (expression, result) VALUES ('$expression', '$result')";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>
