<?php
include '../config.php';
 
session_start(); 
if($_SESSION['status'] !="login"){
	header("location:index.php");
}

$id=$_SESSION['id'];
$id_user=$id['id_user'];

if(isset($_POST['update']))
{
    if($_POST['saldo'] != "" && $_POST['keterangan'] != ""&& $_POST['tanggal'] != ""){
    $id = $_POST['id'];
    $saldo=$_POST['saldo'];
    $keterangan=$_POST['keterangan'];
    $tanggal=$_POST['tanggal'];

    $sql_saldo = mysqli_query($mysqli, "SELECT saldo_transaksi FROM transaksi WHERE id_user='$id_user' ORDER BY saldo_transaksi DESC LIMIT 1");
    $saldo1 = mysqli_query($mysqli, "SELECT saldo_pengeluaran FROM pengeluaran WHERE id_pengeluaran='$id'");
    $id_pemasukkan = mysqli_query($mysqli, "SELECT id_pemasukkan FROM transaksi WHERE id_pengeluaran = '$id'");
    $saldo_sebelum = mysqli_fetch_assoc($saldo1);
    $saldo_transaksi = mysqli_fetch_assoc($sql_saldo);
    $id_pemasukkan = mysqli_fetch_assoc($id_pemasukkan);

    $saldo_sebelum = (int)$saldo_sebelum["saldo_pengeluaran"];
    if ($saldo_sebelum > (int)$saldo){
        $saldo_sementara = $saldo_sebelum - (int)$saldo;
        $saldo_akhir = (int)$saldo_transaksi["saldo_transaksi"] + (int)$saldo_sementara;
    }
    elseif($saldo_sebelum < (int)$saldo){
        $saldo_sementara = (int)$saldo - (int)$saldo_sebelum; 
        $saldo_akhir = (int)$saldo_transaksi["saldo_transaksi"] - (int)$saldo_sementara;
    }
    elseif($saldo_sebelum == (int)$saldo){
        $saldo_akhir = (int)$saldo_transaksi["saldo_transaksi"];
    }

    $result = mysqli_query($mysqli, "UPDATE pengeluaran SET saldo_pengeluaran='$saldo',ket_pengeluaran='$keterangan',tanggal_pengeluaran='$tanggal' WHERE id_pengeluaran=$id");
    $result = mysqli_query($mysqli, "UPDATE pemasukkan SET tanggal_transaksi='$tanggal',ket_pemasukkan='$keterangan' WHERE id_pemasukkan='".$id_pemasukkan["id_pemasukkan"]."'");
    $result = mysqli_query($mysqli, "UPDATE transaksi SET saldo_transaksi='$saldo_akhir',tanggal_transaksi='$tanggal' WHERE id_user = '$id_user' ORDER BY saldo_transaksi DESC LIMIT 1");

    header("Location: ../Outcome.php");
    }
    else{
        ?>
        <script>
        alert('Balance, Description and Date must be filled!');
        </script>
        <?php 
    }
}
?>
<?php

    $id = $_GET['id'];

    $result = mysqli_query($mysqli, "SELECT * FROM pengeluaran WHERE
    id_pengeluaran=$id");

    while($pengeluaran = mysqli_fetch_array($result))
    {
        $saldo = $pengeluaran['saldo_pengeluaran'];
        $keterangan = $pengeluaran['ket_pengeluaran'];
        $tanggal = $pengeluaran['tanggal_pengeluaran'];
    }
?>
<html>
<head>
    <title>Edit Pengeluaran</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-
    scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/e3004849c2.js" crossorigin="anonymous"></script>
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
            <li class="right-navbar"><a class="active" href="../Outcome.php">Expense</a></li>
            <li class="right-navbar"><a href="javascript:void(0)">Income</a></li>
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
                    <form action="editPengeluaran.php" method="post" name="income" >
                    <table class="main-content">
                        <tr>
                            <td class="label"><label for="">Expense</label></td>
                            <td><input type="text" name="saldo" placeholder="Expense" value=<?php echo $saldo;?> autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="">Description</label></td>
                            <td><input type="text" name="keterangan" placeholder="Username" value=<?php echo $keterangan;?> autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="">Date</label></td>
                            <td><input type="date" name="tanggal" placeholder="Date" value=<?php echo $tanggal;?>></td>
                        </tr>
                    </table>
                    <input type="hidden" name="id" value=<?php echo $_GET['id'];?>>
                    <input class="form_button" type="submit" name="update" value="Update"></input>
                    </form>
                </div>
            </div>
        </div> 
    </div>
</body>
</html>
