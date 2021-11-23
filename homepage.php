<?php
// Create database connection using config file
include_once("config.php");
// Fetch data
$pemasukkan = mysqli_query($mysqli, "SELECT * FROM pemasukkan WHERE
is_delete=0 ORDER BY id_pemasukkan DESC");
$pengeluaran = mysqli_query($mysqli, "SELECT * FROM pengeluaran WHERE
is_delete=0 ORDER BY id_pengeluaran DESC");
$transaksi = mysqli_query($mysqli, "SELECT A.id_transaksi, A.saldo_transaksi,
A.tanggal_transaksi, B.saldo_pemasukkan, C.saldo_pengeluaran from transaksi A INNER JOIN pemasukkan B
ON A.id_pemasukkan = B.id_pemasukkan INNER JOIN pengeluaran C
ON A.id_pengeluaran = C.id_pengeluaran WHERE A.is_delete =0 ORDER BY A.id_transaksi DESC");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">

      <title>Homepage</title>

    </head>
    <body>
        <h1>Kelompok 03</h1>
        <h3>Tabel Pemasukkan</h3>
        <table width='80%' border=1>
          <a href="addPemasukkan.php">Tambah Pemasukkan</a>
          <a class = "restore" href="deletedPemasukkan.php">Deleted Items</a>
          <tr>
            <th>Id</th>
            <th>Pemasukkkan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
    <?php
    while($item = mysqli_fetch_array($pemasukkan)) {
      echo "<tr>";
      echo "<td>".$item['id_pemasukkan']."</td>";
      echo "<td>".$item['saldo_pemasukkan']."</td>";
      echo "<td>".$item['tanggal_pemasukkan']."</td>";
      echo "<td>
      <a href='editPemasukkan.php?id=$item[id_pemasukkan]'>Edit</a> |
      <a href='deleteMinuman.php?id=$item[id_pemasukkan]'>Delete</a> |
      <a href='deleteMinuman.php?id=$item[id_pemasukkan]'>Details</a>
      </td></tr>";
  }

    ?>
    </table>
    <h3>Tabel pengeluaran</h3>
    <table width='80%' border=1>
      <a href="addPengeluaran.php">Tambah Pengeluaran</a>
      <a class = "restore" href="addPengeluaran.php">Deleted Items</a>
    <tr>
      <th>Id</th>
      <th>Pengeluaran</th>
      <th>Tanggal</th>
      <th>Aksi</th>
    </tr>
      <?php
      while($item = mysqli_fetch_array($pengeluaran)) {
        echo "<tr>";
        echo "<td>".$item['id_pengeluaran']."</td>";
        echo "<td>".$item['saldo_pengeluaran']."</td>";
        echo "<td>".$item['tanggal_pengeluaran']."</td>";
        echo "<td>
        <a href='editMinuman.php?id=$item[id_pengeluaran]'>Edit</a> |
        <a href='deleteMinuman.php?id=$item[id_pengeluaran]'>Delete</a> |
        <a href='deleteMinuman.php?id=$item[id_pengeluaran]'>Details</a>
        </td></tr>";
      }
      ?>
    </table>
    <h3>Tabel Transaksi</h3>
    <table width='80%' border=1>
      <tr>
        <th>Id</th>
        <th>Saldo</th>
        <th>Pemasukkan</th>
        <th>Pengeluaran</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
      <?php
      while($item = mysqli_fetch_array($transaksi)) {
        echo "<tr>";
        echo "<td>".$item['id_transaksi']."</td>";
        echo "<td>".$item['saldo_transaksi']."</td>";
        echo "<td>".$item['saldo_pemasukkan']."</td>";
        echo "<td>".$item['saldo_pengeluaran']."</td>";
        echo "<td>".$item['tanggal_transaksi']."</td>";
        echo "<td>
        <a  href='deletePaket.php?id=$item[id_transaksi]'>Delete</a></td></tr>";
  }
  ?>
  </table>
  </body>
</html>
