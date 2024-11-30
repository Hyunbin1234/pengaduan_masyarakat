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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengaduan</title>

    <style>

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-family: Arial, sans-serif;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

/* Table header styling */
th {
    background-color: #4CAF50;
    color: #ffffff;
    font-weight: bold;
    padding: 12px;
    text-align: left;
    border-bottom: 2px solid #ddd;
}

/* Table cell styling */
td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

/* Alternate row colors */
tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Hover effect on rows */
tr:hover {
    background-color: #f5f5f5;
}

/* Link styling */
a {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    color: #fff;
    background-color: #4CAF50;
    border-radius: 4px;
    margin: 10px 0;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #45a049;
}

/* Heading styling */
h1 {
    color: #333;
    margin: 20px 0;
    font-family: Arial, sans-serif;
}

/* Logout link specific styling */
a[href="logout.php"] {
    background-color: #f44336;
}

a[href="logout.php"]:hover {
    background-color: #da190b;
}

/* Form link specific styling */
a[href="form_pengaduan.php"] {
    background-color: #008CBA;
}

a[href="form_pengaduan.php"]:hover {
    background-color: #006d91;
}

    </style>

</head>
<body>
    <h1>Daftar Pengaduan Saya</h1>
    <a href="form_pengaduan.php">Tambah Pengaduan</a>
    <table>
        <tr>
            <th>Judul</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
        <?php foreach ($pengaduan as $p) { ?>
        <tr>
            <td><?= $p['judul_pengaduan']; ?></td>
            <td><?= $p['status_pengaduan']; ?></td>
            <td><?= $p['tanggal_pengaduan']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
