<?php
session_start();
include 'koneksi.php';

function rupiah(int $angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}
$grand_total = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['action']) && $_POST['action'] === 'kurang') {
        $id = $_POST['id'];


        $_SESSION['keranjang'][$id] -= 1;


        if ($_SESSION['keranjang'][$id] === 0) {
            unset($_SESSION['keranjang'][$id]);
        }

        header("Location: keranjang.php");
    }


    if (isset($_POST['action']) && $_POST['action'] === 'tambah') {
        $id = $_POST['id'];

        if (isset($_SESSION['keranjang'][$id])) {
            $_SESSION['keranjang'][$id] += 1;
        }

        header("Location: keranjang.php");
    }

    if (isset($_POST['action']) && $_POST['action'] === 'hapus') {
        $id = $_POST['id'];

        unset($_SESSION['keranjang'][$id]);


        header("Location: keranjang.php");
    }
    if (isset($_POST['action']) && $_POST['action'] === 'kosongkan') {

        unset($_SESSION['keranjang']);

        header("Location: keranjang.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
</head>

<body style="padding: 2rem;">
    <header style="display: flex; align-items:center; justify-content: space-between;">
        <h1>Toko Alat Tulis</h1>
        <a href="index.php">kembali</a>
    </header>
    <main>

        <h2>Keranjang</h2>
        <?php if (isset($pesan)): ?>
            <p style="color: green;"><?= $pesan; ?></p>
        <?php endif; ?>
        <table border="0" cellpadding="5">
            <tbody>
                <?php if (empty($_SESSION['keranjang'])): ?>
                    <tr>
                        <td colspan="5" align="center">Keranjang masih kosong.</td>
                    </tr>
                <?php else: ?>
                    <?php


                    foreach ($_SESSION['keranjang'] as $id => $qty):
                        $stmt = mysqli_prepare($conn, "SELECT nama, harga FROM barang WHERE id = ?");
                        mysqli_stmt_bind_param($stmt, "i", $id);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $data = mysqli_fetch_assoc($result);

                        if ($data):
                            $subtotal = $data['harga'] * $qty;
                            $grand_total += $subtotal;
                    ?>
                            <tr>
                                <td><?= htmlspecialchars($data['nama']); ?> <br> <?= rupiah($data['harga']); ?> x <?= $qty; ?> =
                                    <?= rupiah($subtotal); ?>
                                </td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                        <button type="submit" name="action" value="kurang">-</button>
                                    </form>
                                </td>
                                <td>
                                    <?= $qty; ?>

                                </td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                        <button type="submit" name="action" value="tambah">+</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                        <button type="submit" name="action" value="hapus">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        endif;
                    endforeach;
                    ?>
                    <tr>
                        <td colspan="3" align="right"><strong>Total:</strong></td>
                        <td colspan="2"><strong><?= rupiah($grand_total); ?></strong></td>
                    </tr>

                <?php endif; ?>

            </tbody>
        </table>
        <?php if (!empty($_SESSION['keranjang'])): ?>
            <form action="" method="POST">
                <button type="submit" name="action" value="kosongkan">Kosongkan keranjang</button>
            </form>
        <?php endif; ?>
    </main>

</body>

</html>