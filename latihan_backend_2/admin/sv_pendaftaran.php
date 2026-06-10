<?php
include 'koneksi.php';

$full_name = trim($_POST['full_name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone_number = trim($_POST['phone_number'] ?? '');
$course_id = (int) ($_POST['course_id'] ?? 0);
$participant_count = (int) ($_POST['participant_count'] ?? 0);

if ($full_name === '' || $email === '' || $phone_number === '' || $course_id === 0 || $participant_count < 1) {
    header("Location: index.php");
    exit;
}
$query_harga = mysqli_query($conn, "SELECT price FROM courses WHERE id = '$course_id'");

if ($data_kelas = mysqli_fetch_assoc($query_harga)) {
    $harga_dasar = $data_kelas['price']; 
    $unit_price = $harga_dasar * $participant_count; 
} else {
    $unit_price = 0; 
}

$sql = "INSERT INTO registrations (full_name, email, phone_number, course_id, participant_count, unit_price) 
        VALUES (
        '$full_name',
        '$email',
        '$phone_number',
        '$course_id',
        '$participant_count',
        '$unit_price')";

$query = mysqli_query($conn, $sql);

header("Location: index.php");
exit;
?>