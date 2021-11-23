<?php
include_once("../config.php");

$id = $_GET['id'];
session_start();

$id_user=$_SESSION['id'];
$id_user=$id_user['id_user'];
$delete = mysqli_query($mysqli, "SELECT id_pemasukkan, id_pengeluaran FROM transaksi WHERE id_user = '$id_user' AND id_transaksi = '$id'");
$delete = mysqli_fetch_array($delete);

$result2 = mysqli_query($mysqli, "DELETE FROM transaksi WHERE id_pengeluaran = $delete[id_pengeluaran] AND id_pemasukkan = $delete[id_pemasukkan]");
$result = mysqli_query($mysqli, "DELETE FROM pemasukkan WHERE id_pemasukkan = $delete[id_pemasukkan]");
$result1 = mysqli_query($mysqli, "DELETE FROM pengeluaran WHERE id_pengeluaran = $delete[id_pengeluaran]");


header("Location:../Transaction.php");
?>
