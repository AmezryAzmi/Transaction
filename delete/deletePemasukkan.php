<?php

include_once("../config.php");

$id = $_GET['id'];
session_start();


$id_user=$_SESSION['id'];
$id_user=$id_user['id_user'];
$pengeluaran = mysqli_query($mysqli, "SELECT id_pengeluaran FROM transaksi WHERE id_user = '$id_user' AND id_pemasukkan = '$id'");
$pengeluaran = mysqli_fetch_assoc($pengeluaran);
$pengeluaran = $pengeluaran["id_pengeluaran"];

$result2 = mysqli_query($mysqli, "DELETE FROM transaksi WHERE id_pengeluaran = '$pengeluaran' AND id_pemasukkan = '$pemasukkan'");
$result = mysqli_query($mysqli, "DELETE FROM pemasukkan WHERE id_pemasukkan = '$id'");
$result1 = mysqli_query($mysqli, "DELETE FROM pengeluaran WHERE id_pengeluaran = '$pengeluaran'");


header("Location:../Transaction.php");
?>
