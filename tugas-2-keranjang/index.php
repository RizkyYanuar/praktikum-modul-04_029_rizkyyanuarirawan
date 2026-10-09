<?php
session_start();
include 'koneksi.php';
$query = mysqli_query($conn, "SELECT * FROM barang");

function rupiah(int $angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action']) && $_POST['action'] === 'tambahKeranjang') {
        $id = $_POST['id'];

        if (isset($_SESSION['keranjang'][$id])) {
            $_SESSION['keranjang'][$id] += 1;
        } else {
            $_SESSION['keranjang'][$id] = 1;
        }

        $pesan = "Produk berhasil ditambahkan!";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belanja</title>
</head>

<body style="padding: 2rem;">
    <header style="display: flex; align-items:center; justify-content: space-between;">
        <h1>Toko Alat Tulis</h1>
        <a href="keranjang.php">Keranjang (<?= (isset($_SESSION['keranjang'])) ? array_sum($_SESSION['keranjang']) : '0'
                                            ?>)</a>
    </header>
    <main>

        <h2>Daftar Barang</h2>
        <?php if (isset($pesan)): ?>
            <p style="color: green;"><?= $pesan; ?></p>
        <?php endif; ?>
        <table border="0" cellpadding="5">
            <?php
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <tr>
                    <td><?= htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?= htmlspecialchars(rupiah($data['harga']), ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>Stok: <?= htmlspecialchars($data['stok'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                        <form action="" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <button type="submit" name="action" value="tambahKeranjang">Masukkan Ke Krj</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </main>

</body>

</html>