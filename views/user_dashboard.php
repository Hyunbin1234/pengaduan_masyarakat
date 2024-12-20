<?php
session_start();
if ($_SESSION['role'] != 'public') {
  header("Location: login.php");
  exit();
}

include '../config/database.php';
$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM Pengaduan WHERE id_user = :id_user";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_user' => $id_user]);
$pengaduan = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="rgba(233, 61, 107, .7)" />
  
  <title>Bookself Apps</title>
  
  <link rel="stylesheet" href="style.css">
    <style>
        a {
            text-decoration: none;
            color: red;
            padding-right: 20px;
            font-weight: bold;
            background-color: black;
            display: flex;
        }
    </style>

</head>

<body>
    <a href="logout.php">Logout of the Website Application!!</a> 
  <nav class="top-bar"></nav>
  <div class="content">
    <div class="col-1">
      <div class="user-information my-container">
        <div class="user-img">
          <img src="assets/img/avatar.jpg" alt="Avatar">
        </div>
        <h1 class="user-name">Oh Hyunbin</h1>
        <p class="user-bio"><i class="fi-sr-broom"></i> Programmer dan Content Creator </p>
        <ul>
          <li>
            <p>Jumlah Buku</p>
            <h4 id="jumlahBuku">3</h4>
          </li>
        </ul>
      </div>
      <div class="my-container mt-2">
        <form>
          <input class="" type="text" name="" id="bookTitle" placeholder="Cari Buku ..."/>
          <button class="submit" type="submit"><i class="fi-rr-search"></i></button>
        </form>
      </div>
      <div class="my-container icons">
        <div class="my-icon">
          <div class="read-icon">
            <i class="fi-rr-book-alt"></i>
          </div>
          <h5>Dibaca</h5>
        </div>
        <div class="my-icon">
          <div class="unread-icon">
             <i class="fi-rr-bookmark"></i>
            </div>
            <h5>Belum Dibaca</h5>
        </div>
        <div class="my-icon">
           <div class="add-book" id="add-book">
            <i class="fi-sr-add"></i>
          </div>
          <h5>add</h5>
        </div>
      </div>
    </div>
    <div class="col-2">
      <div class="my-container welcome">
        <h1>Selamat Datang di Bookself Apps</h1>
        <p>Kelola Buku jadi lebih mudah hanya di Bookself Apps, Coba Sekarang !</p>
      </div>
      
      
      <div class="content-book">
        <div class="unread" id="unread">
          <h4 class="">Belum Dibaca</h4>
        </div>
        
         <div class="read" id="read">
          <h4>Sudah Dibaca</h4>
        </div>
      </div>
    </div>
  </div>

    <div id="modal">
        <section class="my-container">
            <h2>New Book</h2>
            <form id="form">
                <div class="input-group">
                    <input type="text" id="title" placeholder="Judul Buku" class="input-form"
                        maxlength="120" pattern="^[a-zA-Z0-9_ ]*$" required />
                </div>
                <div class="input-group">
                    <input type="text" id="author" placeholder="Author" class="input-form"
                        maxlength="60" pattern="^[a-zA-Z0-9_ ]*$" required />
                </div>
                <div class="input-group">
                    <input type="date" id="year" 
                        class="input-form" min="1900" max="2026" />
                </div>
                <div class="button-group">
                    <button type="reset" class="close" id="close">Close</button>
                    <button type="submit" id="save">Save</button>
                </div>
            </form>
        </section>
    </div>
    
  <script src="./storage.js"></script>
  <script src="./main.js"></script>
</body>
</html>