<?php
include '../config.php';
 
session_start();
if($_SESSION['status'] !="login"){
	header("location:index.php");
}

$id=$_SESSION['id'];
$id=$id['id_user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-
scale=1.0">
<link rel="stylesheet" href="../css/login.css">
<link rel="stylesheet" href="../css/navbar.css">
<link rel="stylesheet" href="../css/style.css">
<script src="https://kit.fontawesome.com/e3004849c2.js" crossorigin="anonymous"></script>

<title>Add Expense</title>
</head>
<body>
<div class="navbar">
        <ul>
			<li><a href="../Home.php">Home</a></li>
            <li class="dropdown"><a href="javascript:void(0)"><i class="fas fa-user-alt"></i></a>
            <div class="dropdown-content">
                <a href="../Profile.php">Profile</a>
                <a href="../admin/logout.php">Logout</a>
            </div>
            </li>
            <li class="right-navbar"><a class="active" href="javascript:void(0)">Expense</a></li>
            <li class="right-navbar"><a  href="../Income.php">Income</a></li>
            <li class="right-navbar"><a href="../Transaction.php">Transaction</a></li>
        </ul>
    </div>
    <div class="login">
        <div class="login-wrapper">
            <div class="container">
                <div class="header">
                    <h3>Add Expense</h3>
                </div>
                <div class="content">
                    <form action="addPengeluaran.php" method="post" name="income" >
                    <table class="main-content">
                        <tr>
                            <td class="label"><label for="">Expense Balance</label></td>
                            <td><input class="text" type="text" name="saldo" placeholder="Expense" id="username" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="">Description</label></td>
                            <td><input class="text" type="text" name="keterangan" placeholder="Description" id="username" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="">Date</label></td>
                            <td><input class="text" type="date" name="tanggal" placeholder="Date" id="password"></td>
                        </tr>
                    </table>
                    <input class="form_button " type="submit" name="Submit" value="Add"></input>
                    </form>
                </div>
            </div>
        </div> 
    </div>
<?php

// Check If form submitted, insert form data into users table.
if(isset($_POST['Submit'])) {
	$keterangan = $_POST['keterangan'];
	$saldo = $_POST['saldo'];
	$tanggal = $_POST['tanggal'];
	// include database connection file
	include_once("config.php");
	// Insert user data into table

	$result = mysqli_query($mysqli, "INSERT INTO pengeluaran(saldo_pengeluaran,tanggal_pengeluaran,ket_pengeluaran)
	VALUES('$saldo','$tanggal','$keterangan')");
	$result = mysqli_query($mysqli, "INSERT INTO pemasukkan(saldo_pemasukkan,tanggal_pemasukkan,ket_pemasukkan)
	VALUES('0','$tanggal','$keterangan')");

	$sql_id1 = mysqli_query($mysqli, "SELECT id_pemasukkan FROM pemasukkan ORDER BY id_pemasukkan DESC LIMIT 1");
	$sql_id2 = mysqli_query($mysqli, "SELECT id_pengeluaran FROM pengeluaran ORDER BY id_pengeluaran DESC LIMIT 1");
	$sql_saldo = mysqli_query($mysqli, "SELECT saldo_transaksi FROM transaksi WHERE id_user='$id' ORDER BY saldo_transaksi DESC LIMIT 1");
	$saldo_transaksi = mysqli_fetch_assoc($sql_saldo);
	$id_pemasukkan = mysqli_fetch_assoc($sql_id1);
	$id_pengeluaran = mysqli_fetch_assoc($sql_id2);

	$saldo_transaksis = (int)$saldo_transaksi["saldo_transaksi"] - (int)$saldo;

	$result2 = mysqli_query($mysqli, "INSERT INTO transaksi(saldo_transaksi,tanggal_transaksi,id_pemasukkan,id_pengeluaran,id_user)
	VALUES('$saldo_transaksis','$tanggal','".$id_pemasukkan["id_pemasukkan"]."','".$id_pengeluaran["id_pengeluaran"]."','$id')");
	// Show message when user added

	header("location:../Transaction.php");
}
?>
</body>
</html>