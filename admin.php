<?php
session_start();
require 'conn.php';

if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true){
    header("Location: index.php");
    exit;
}

// Hapus user
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin.php");
    exit;
}

$users = $conn->query("SELECT id, nama, email, role FROM users ORDER BY id DESC");
?>
<style>
   
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Poppins", sans-serif;
    background: #D4AF37; 
    color: #000000ff;
    padding: 20px;+
}

h2 {
    font-size: 32px;
    color: #070c72ff;
    margin-bottom: 10px;
    font-weight: 600;
    font: cinzel;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: #1e293b;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.25);
}

th {
    background: #0284c7;
    padding: 14px;
    text-align: left;
    font-size: 16px;
    font-weight: 600;
}

td {
    padding: 14px;
    border-bottom: #D4AF37;
    font-size: 15px;
}

tr:hover td {
    background: #D4AF37;
}

a.delete-btn {
    background-color: #ff3300;
    color: #fff;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 4px;
}

a.delete-btn:hover {
    background: #b91c1c;
}

.top-nav {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 15px;
}

.logout {
    background-color: #ff3300;
    color: #fff;
    padding: 8px 10px;
    gap: 5px;
    margin: 5px;
    text-decoration: none;
    border-radius: 4px;
    margin-bottom: 8px;
}

.logout:hover {
    background: #dc2626;
}

@media(max-width: 700px) {
    table {
        font-size: 12px;
    }
    td, th {
        padding: 10px;
    }
    h2 {
        font-size: 24px;
    }
}

</style>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background: #444; color: white; }
        a { text-decoration: none; color: red; }
        .logout { float: right; }
    </style>
</head>
<body>

<h2>Admin Panel</h2>

<a href="logout.php" class="logout">Logout</a>
<a href="admin_barang.php" class="logout">Data Barang</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Aksi</th>
    </tr>

    <?php while ($u = $users->fetch_assoc()): ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= $u['nama'] ?></td>
        <td><?= $u['email'] ?></td>
        <td><?= $u['role'] ?></td>
        <td>
            <a href="admin.php?delete=<?= $u['id'] ?>" class = "btn-wrn" onclick="return confirm('Hapus user ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
