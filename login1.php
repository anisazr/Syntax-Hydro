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
    
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    
    $sql = "SELECT * FROM users WHERE username = '$username'"; 
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) > 0) {
         $user = mysqli_fetch_assoc($result);

       
        if (password_verify($password, $user['password'])) { 
            $_SESSION['user_data'] = [
                'username' => $user['username'], 
            ];

            
            header("Location: homepage.php");
            exit();
        } else {
            echo "Password salah. Silakan coba lagi.";
        }
    } else {
        echo "Pengguna tidak ditemukan. Silakan registrasi.";
    }

    
    mysqli_close($koneksi);
}
?>