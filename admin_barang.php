<?php
session_start();
require 'koneksi.php';

if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true){
    header("Location: index.php");
    exit;
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM hampers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin_barang.php");
    exit;
}

$barang = $conn->query("SELECT * FROM hampers ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Barang</title>
    <style>
        body 
        { 
            font-family: cinzel; 
            background:#070c72 ; 
            padding: 20px; 
        }

        h2 
        { 
            color: #D4AF37; 
            margin-left: 38rem;
            font-size: 30px;
        }

        table 
        { 
            width: 100%; 
            border-collapse: collapse;
             background: #1e293b; 
             color: white; 
             border-radius: 12px; 
             overflow: hidden; 
            }

        th
         { 
            background: #0284c7;
             padding: 12px; 
             text-align: left; 
            }

        td 
        { 
            padding: 12px; 
            border-bottom: 1px solid #444; 
        }

        tr:hover td 
        {
             color: #D4AF37; 
            }

        a.btn 
        {
             padding: 6px 12px; 
             border-radius: 5px; 
             color: white; 
            }

        .edit 
        { 
            background: green; 
            text-decoration: none;
        }

        .hapus 
        { 
            background: #ef4444; 
            text-decoration: none;
        }

        .logout 
        { 
            float: right; 
            background: #ef4444; 
            padding: 8px 12px; 
            border-radius: 5px;
            color: white; 
            text-decoration: none;
            margin-bottom: 8px;
            }
    </style>
</head>
<body>

<h2>Kelola Data Barang</h2>
<a href="logout.php" class="logout">Logout</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Gambar</th>
        <th>Aksi</th>
    </tr>

    <?php while ($b = $barang->fetch_assoc()): ?>
    <tr>
        <td><?= $b['id'] ?></td>
        <td><?= htmlspecialchars($b['jenis']) ?></td>
        <td>Rp <?= number_format($b['harga'], 0, ',', '.') ?></td>
        <td><?= $b['stok'] ?></td>
        <td><img src="<?= htmlspecialchars($b['gambar']) ?>" width="80"></td>
        <td>
            <a href="edit_barang.php?id=<?= $b['id'] ?>" class="btn edit">Edit</a>
            <a href="admin_barang.php?delete=<?= $b['id'] ?>" class="btn hapus" onclick="return confirm('Yakin hapus barang ini?')">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
