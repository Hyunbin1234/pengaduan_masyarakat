<?php
session_start();
if ($_SESSION['role'] != 'public') {
  header("Location: login.php"); 
  exit();
}

include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_user = $_SESSION['id_user']; 
  $judul_pengaduan = $_POST['judul_pengaduan'];
  $deskripsi = $_POST['deskripsi'];

  $sql = "INSERT INTO Pengaduan (id_user, judul_pengaduan, deskripsi) VALUES (:id_user, :judul_pengaduan, :deskripsi)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    'id_user' => $id_user,
    'judul_pengaduan' => $judul_pengaduan,
    'deskripsi' => $deskripsi
  ]);

  header("Location: user_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pengaduan</title>
  <!-- <link rel="stylesheet" href="style.css"> -->

  <style>

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    background-color: #f5f5f5;
}

h1 {
    color: #2c3e50;
    text-align: center;
    margin-bottom: 30px;
    font-size: 2em;
}

form {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Label Styling */
label {
    display: block;
    margin-bottom: 8px;
    color: #2c3e50;
    font-weight: 500;
}

/* Input and Textarea Styling */
.input {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    font-size: 16px;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.input:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
}

textarea.input {
    min-height: 150px;
    resize: vertical;
}

/* Button Styling */
button {
    position: relative;
    width: 100%;
    padding: 15px 30px;
    border: none;
    background: #3498db;
    color: white;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    border-radius: 6px;
    overflow: hidden;
    transition: all 0.3s ease;
}

button:hover {
    background: #2980b9;
    transform: translateY(-2px);
}

/* Button Animation Circles */
.circle1, .circle2, .circle3, .circle4, .circle5 {
    position: absolute;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    animation: ripple 1s ease-out infinite;
    opacity: 0;
}

.circle1 { width: 20px; height: 20px; }
.circle2 { width: 30px; height: 30px; animation-delay: 0.2s; }
.circle3 { width: 40px; height: 40px; animation-delay: 0.4s; }
.circle4 { width: 50px; height: 50px; animation-delay: 0.6s; }
.circle5 { width: 60px; height: 60px; animation-delay: 0.8s; }

@keyframes ripple {
    0% {
        transform: scale(0);
        opacity: 0.5;
    }
    100% {
        transform: scale(4);
        opacity: 0;
    }
}

/* Placeholder Styling */
::placeholder {
    color: #bdc3c7;
    opacity: 1;
}

/* Input Focus Animation */
.input:focus::placeholder {
    transform: translateY(-20px);
    opacity: 0;
    transition: all 0.3s ease;
}

/* Responsive Design */
@media screen and (max-width: 480px) {
    body {
        padding: 10px;
    }
    
    form {
        padding: 20px;
    }
    
    h1 {
        font-size: 1.5em;
    }
    
    .input {
        padding: 10px;
    }
}

  </style>

</head>
<body>
  <h1>Form Pengaduan Baru</h1>
  <form method="POST">
    <label for="judul_pengaduan">Judul Pengaduan</label>
    <!-- <input type="text" name="judul_pengaduan" id="judul_pengaduan" required> -->
    <input type="text" autocomplete="off" name="judul_pengaduan" id="judul_pengaduan" class="input" placeholder="Masukan Judul"><br>


    <label for="deskripsi">Deskripsi Pengaduan</label>
    <!-- <textarea name="deskripsi" id="deskripsi" required></textarea>

    <button type="submit">Kirim Pengaduan</button> -->
    <textarea id="deskripsi" name="deskripsi" required class="input" placeholder="Deskripsikan Pengaduanmu"></textarea><br>
    <button type="submit">
        <span class="circle1"></span>
        <span class="circle2"></span>
        <span class="circle3"></span>
        <span class="circle4"></span>
        <span class="circle5"></span>
        <span class="text">Kirim Pengaduan</span>
    </button>
  </form>
</body>
</html>
