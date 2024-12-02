<?php
session_start();

$servername = "localhost"; 
$usernameDB = "root"; 
$passwordDB = ""; 
$dbname = "nama_database"; 


$koneksi = mysqli_connect($servername, $usernameDB, $passwordDB, $dbname);


if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nama = htmlspecialchars($_POST['nama']);
    $email = filter_var(strip_tags($_POST['email']), FILTER_SANITIZE_EMAIL);
    $nomor_telepon = htmlspecialchars($_POST['nomor_telepon']);
    $password = htmlspecialchars($_POST['password']);
    $alamat_rumah = htmlspecialchars($_POST['alamat_rumah']);
    
    
    if (empty($nama) || preg_match('/[0-9]/', $nama)) {
        die("Maaf, nama harus berupa huruf.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Maaf, alamat email tidak valid.");
    }

    if (empty($nomor_telepon) || preg_match('/[a-zA-Z]/', $nomor_telepon)) {
        die("Maaf, nomor telepon harus berupa angka.");
    }

    
   

    
    $sql = "INSERT INTO users (nama, email, nomor_telepon, password, alamat_rumah) VALUES ('$nama', '$email', '$nomor_telepon', '$hashed_password', '$alamat_rumah')";
    $query = mysqli_query($koneksi, $sql);

    
    if ($query) {
        
        $_SESSION['user_data'] = [
            'nama' => $nama,
            'email' => $email,
            'nomor_telepon' => $nomor_telepon,
            'alamat_rumah' => $alamat_rumah,
        ];

       header("Location: registrasi_hasil.php");
        exit();
    } else {
         header("Location: registrasi_hasil.php");
        exit();
    }

    
    mysqli_close($koneksi);
} else 
?>
