<?php
include 'koneksi.php';

// Ambil data yang ingin diupdate
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tabel_komentar WHERE id=$id";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
}

// Proses Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $cemilan_kesukaan = $_POST['cemilan_kesukaan'];

    $sql = "UPDATE tabel_komentar SET nama='$nama', alamat='$alamat', cemilan_kesukaan='$cemilan_kesukaan' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate.";
        header('Location: index.php');
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>
    <h2>Form Edit Data</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>" required><br>
        
        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" value="<?php echo $data['alamat']; ?>" required><br>
        
        <label for="cemilan_kesukaan">Cemilan Kesukaan:</label>
        <textarea name="cemilan_kesukaan" required><?php echo $data['cemilan_kesukaan']; ?></textarea><br>
        
        <input type="submit" name="update" value="Update Data">
    </form>
</body>
</html>
