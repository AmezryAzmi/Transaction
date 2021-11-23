<?php
include_once("../config.php");

$id = $_GET['id'];
$delete1 = mysqli_query($mysqli, "DELETE FROM transaksi WHERE id_user='$id'");
$delete = mysqli_query($mysqli, "DELETE FROM usher WHERE id_user='$id'");
header("location:../admin.php");
?>