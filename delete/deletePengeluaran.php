<?php
include_once("../config.php");

$id = $_GET['id'];
session_start();

$id_user=$_SESSION['id'];
$id_user=$id_user['id_user'];
$pemasukkan = mysqli_query($mysqli, "SELECT id_pemasukkan FROM transaksi WHERE id_user = '$id_user' AND id_pengeluaran = '$id'");
$pemasukkan = mysqli_fetch_assoc($pemasukkan);
$pemasukkan = $pemasukkan["id_pemasukkan"];

$result2 = mysqli_query($mysqli, "DELETE FROM transaksi WHERE id_pengeluaran = '$id' AND id_pemasukkan = '$pemasukkan'");
$result = mysqli_query($mysqli, "DELETE FROM pemasukkan WHERE id_pemasukkan = '$pemasukkan'");
$result1 = mysqli_query($mysqli, "DELETE FROM pengeluaran WHERE id_pengeluaran = '$id'");


header("Location:../Transaction.php");
?>


