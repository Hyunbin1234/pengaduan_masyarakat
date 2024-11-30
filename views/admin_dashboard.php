<?php
session_start();
if ($_SESSION['role'] != 'admin') {
  header("Location: login.php");
  exit();
}

include '../config/database.php';
$sql = "SELECT p.*, u.nama AS nama_user FROM Pengaduan p JOIN User u ON p.id_user = u.id_user";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$pengaduan = $stmt->fetchAll();
?>

<!-- <h1>Daftar Semua Pengaduan</h1>
<table>
  <tr>
    <th>Nama User</th>
    <th>Judul</th>
    <th>Status</th>
    <th>Tanggal</th>
    <th>Aksi</th>
  </tr>
  <?php foreach ($pengaduan as $p) { ?>
  <tr>
    <td><?= $p['nama_user']; ?></td>
    <td><?= $p['judul_pengaduan']; ?></td>
    <td><?= $p['status_pengaduan']; ?></td>
    <td><?= $p['tanggal_pengaduan']; ?></td>
    <td>
      <a href="edit_pengaduan.php?id=<?= $p['id_pengaduan']; ?>">Edit</a>
    </td>
  </tr>
  <?php } ?>
</table>
<a href="logout.php">Logout</a> -->

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <!-- <link rel="stylesheet" href="styles.css"> Link ke CSS -->

  <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', sans-serif;
}

body {
    background: #f5f7fb;
    color: #333;
    line-height: 1.6;
}

.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 20px;
}

h1 {
    color: #1a237e;
    margin-bottom: 1rem;
    font-size: 2.2rem;
}

p {
    margin-bottom: 2rem;
    color: #555;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

thead {
    background: #1a237e;
    color: white;
}

th {
    padding: 1rem;
    text-align: left;
    font-weight: 600;
}

td {
    padding: 1rem;
    border-bottom: 1px solid #eee;
}

tbody tr:hover {
    background-color: #f8f9ff;
}

/* Form Elements Styling */
form {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

select {
    padding: 0.5rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    background: white;
    color: #333;
    cursor: pointer;
    min-width: 120px;
}

select:focus {
    outline: none;
    border-color: #1a237e;
    box-shadow: 0 0 0 2px rgba(26, 35, 126, 0.1);
}

button {
    background: #1a237e;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background: #283593;
}

/* Status Colors */
td:nth-last-child(2) {
    font-weight: 500;
}

td:nth-last-child(2):contains('Pending') {
    color: #f57c00;
}

td:nth-last-child(2):contains('In Progress') {
    color: #0288d1;
}

td:nth-last-child(2):contains('Resolved') {
    color: #388e3c;
}

/* Logout Button */
.logout-btn {
    display: inline-block;
    background: #dc3545;
    color: white;
    padding: 0.75rem 1.5rem;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s ease;
}

.logout-btn:hover {
    background: #c82333;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        padding: 0 10px;
    }

    table {
        display: block;
        overflow-x: auto;
    }

    th, td {
        min-width: 120px;
    }
    
    form {
        flex-direction: column;
        align-items: stretch;
    }
    
    select, button {
        width: 100%;
        margin: 0.2rem 0;
    }
}

/* Description column width limit */
td:nth-child(3) {
    max-width: 300px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Animation for new entries */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

tbody tr {
    animation: fadeIn 0.3s ease-out forwards;
}

  </style>

</head>
<body>
  <div class="container">
    <h1>Dashboard Admin</h1>
    <p>Hi, <strong>Admin!!.</strong> Berikut adalah daftar pengaduan yang masuk:</p>
    
    <!-- Tabel Pengaduan -->
    <table>
      <thead>
        <tr>
          <th>Judul Pengaduan</th>
          <th>Nama Pelapor</th>
          <th>Deskripsi Pengaduan</th>
          <th>Tanggal</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pengaduan as $data) : ?>
          <tr>
            <td><?php echo htmlspecialchars($data['judul_pengaduan']); ?></td>
            <td><?php echo htmlspecialchars($data['nama_user']); ?></td>
            <td><?php echo htmlspecialchars($data['deskripsi']); ?></td>
            <td><?php echo htmlspecialchars($data['tanggal_pengaduan']); ?></td>
            <td><?php echo htmlspecialchars($data['status_pengaduan'] ?? ''); ?></td>
            <td>
                <form action="edit_pengaduan.php" method="POST">
                    <input type="hidden" name="id_pengaduan" value="<?php echo htmlspecialchars($data['id_pengaduan'] ?? ''); ?>">
                    <select name="status_pengaduan">
                        <option value="Pending" <?php if ($data['status_pengaduan'] == 'Pending') echo 'selected'; ?>>Pending</option>
                        <option value="In Progress" <?php if ($data['status_pengaduan'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                        <option value="Resolved" <?php if ($data['status_pengaduan'] == 'Resolved') echo 'selected'; ?>>Resolved</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <a href="logout.php" class="logout-btn">Logout</a>
  </div>
</body>
</html>
