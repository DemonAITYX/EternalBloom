<?php
session_start();
require 'koneksi.php';

if(!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true){
    header("Location: index.php");
    exit;
}

if(!isset($_GET['id'])){
    die("ID barang tidak ditemukan");
}

$id = intval($_GET['id']);

$data = $conn->query("SELECT * FROM hampers WHERE id = $id")->fetch_assoc();

if(isset($_POST['submit'])){
    $nama  = $_POST['jenis'];
    $harga = intval($_POST['harga']);
    $stok  = intval($_POST['stok']);

    if (!empty($_FILES['gambar']['name'])) {

        $filename = time() . "_" . $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/" . $filename);

        $stmt = $conn->prepare("UPDATE hampers SET jenis=?, harga=?, stok=?, gambar=? WHERE id=?");
        $stmt->bind_param("siisi", $nama, $harga, $stok, $filename, $id);

    } else {

        $stmt = $conn->prepare("UPDATE hampers SET jenis=?, harga=?, stok=? WHERE id=?");
        $stmt->bind_param("siii", $nama, $harga, $stok, $id);

    }

    $stmt->execute();
    header("Location: admin_barang.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>

<style>
    body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(#0b1b38, rgb(20, 20, 20));
        padding: 30px;
        color: #000;
        
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    h2 {
        font-size: 30px;
        color: #D4AF37;
        font-weight: 600;
        margin-bottom: 20px;
        margin-left: 3rem;
        text-align: center;
    }

    .wrapper {
        width: 100%;
        max-width: 450px;
    }

    form {
        background: #D4AF37;
        padding: 30px;
        border-radius: 12px;
        width: 100%;
        color: white;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.25);
    }

    form input[type="text"],
    form input[type="number"],
    form input[type="file"] {
        width: 100%;
        padding: 12px;
        margin-top: 6px;
        margin-bottom: 20px;
        margin-left:-10px;
        border-radius: 8px;
        border: none;
        background: #f8fafc;
    }

    button {
        background: #0b1b38;
        color: white;
        border: none;
        padding: 12px 18px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        transition: .2s ease;
    }

    button:hover {
        background: #0369a1;
    }

</style>

</head>
<body>

<div class="wrapper">

<h2>Edit Barang</h2>

<form method="post" enctype="multipart/form-data">

    Nama: <br>
    <input type="text" name="jenis" value="<?= htmlspecialchars($data['jenis']) ?>" required>

    Harga: <br>
    <input type="number" name="harga" value="<?= $data['harga'] ?>" required>

    Stok: <br>
    <input type="number" name="stok" value="<?= $data['stok'] ?>" required>

    Gambar Baru (opsional): <br>
    <input type="file" name="gambar">

    <button type="submit" name="submit">Update</button>
</form>

</div>

</body>
</html>
