<?php
include 'koneksi.php';

// Proses Create (Tambah Data)
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $cemilan_kesukaan = $_POST['cemilan_kesukaan'];

    $sql = "INSERT INTO tabel_komentar (nama, alamat, cemilan_kesukaan) VALUES ('$nama', '$alamat', '$cemilan_kesukaan')";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Proses Delete
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $sql = "DELETE FROM tabel_komentar WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus.";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Ambil data untuk ditampilkan
$sql = "SELECT * FROM tabel_komentar";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Tsabitah Dhimas Juliant</title>
    <style>
        /* Reset margin dan padding untuk elemen umum */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            padding: 20px;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        /* Styling untuk Form Input */
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        /* Styling Tabel */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #2c3e50;
            color: #fff;
        }

        tr:hover {
            background-color: #ecf0f1;
        }

        /* Styling Tombol Tambah Data */
        button {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }

        button:hover {
            background-color: #27ae60;
        }

        /* Responsif - jika layar kecil */
        @media (max-width: 768px) {
            table, form {
                width: 100%;
                margin: 0;
            }

            button {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>
<body>

    <h2>Data yang Tersimpan</h2>

    <!-- Tombol untuk menambahkan data -->
    <button onclick="document.getElementById('formTambah').style.display='block'">Tambah Data</button>

    <!-- Form untuk tambah data -->
    <div id="formTambah" style="display:none;">
        <h2>Form Input Data</h2>
        <form action="index.php" method="POST">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required><br>
            
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" required><br>
            
            <label for="cemilan_kesukaan">Cemilan Kesukaan:</label>
            <textarea name="cemilan_kesukaan" required></textarea><br>
            
            <input type="submit" name="submit" value="Tambah Data">
        </form>
    </div>

    <!-- Tabel untuk menampilkan data -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Cemilan Kesukaan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['alamat'] . "</td>";
                    echo "<td>" . $row['cemilan_kesukaan'] . "</td>";
                    echo "<td><a href='?delete_id=" . $row['id'] . "'>Hapus</a> | <a href='update.php?id=" . $row['id'] . "'>Edit</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data.</td></tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>
