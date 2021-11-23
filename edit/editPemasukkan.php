<?php

include '../config.php';
 
session_start(); 
if($_SESSION['status'] !="login"){
	header("location:index.php");
}

$id_user=$_SESSION['id'];
$id_user=$id_user['id_user'];

if(isset($_POST['update']))
{
    if($_POST['saldo'] != "" && $_POST['keterangan'] != ""&& $_POST['tanggal'] != ""){
        $id = $_POST['id'];
        $saldo=$_POST['saldo'];
        $keterangan=$_POST['keterangan'];
        $tanggal=$_POST['tanggal'];

        $sql_saldo = mysqli_query($mysqli, "SELECT saldo_transaksi FROM transaksi WHERE id_user = '$id_user' ORDER BY saldo_transaksi DESC LIMIT 1");
        $saldo1 = mysqli_query($mysqli, "SELECT saldo_pemasukkan FROM pemasukkan WHERE id_pemasukkan='$id'");
        $id_pengeluaran = mysqli_query($mysqli, "SELECT id_pengeluaran FROM transaksi WHERE id_pemasukkan = '$id'");
        $saldo_sebelum = mysqli_fetch_assoc($saldo1);
        $saldo_transaksi = mysqli_fetch_assoc($sql_saldo);
        $id_pengeluaran = mysqli_fetch_assoc($id_pengeluaran);
        $saldo_sebelum = (int)$saldo_sebelum["saldo_pemasukkan"];
        if ($saldo_sebelum > (int)$saldo){
            $saldo_sementara = $saldo_sebelum - (int)$saldo;
            $saldo_akhir = (int)$saldo_transaksi["saldo_transaksi"] - (int)$saldo_sementara;
        }
        elseif($saldo_sebelum < (int)$saldo){
            $saldo_sementara = (int)$saldo - (int)$saldo_sebelum; 
            $saldo_akhir = (int)$saldo_transaksi["saldo_transaksi"] + (int)$saldo_sementara;
        }
        elseif($saldo_sebelum == (int)$saldo){
            $saldo_akhir = (int)$saldo_transaksi["saldo_transaksi"];
        }

        $result = mysqli_query($mysqli, "UPDATE pemasukkan SET saldo_pemasukkan='$saldo',ket_pemasukkan='$keterangan',tanggal_pemasukkan='$tanggal' WHERE id_pemasukkan=$id");
        $result = mysqli_query($mysqli, "UPDATE pengeluaran SET tanggal_transaksi='$tanggal',ket_pengeluaran='$keterangan' WHERE id_pengeluaran='".$id_pengeluaran["id_pengeluaran"]."'");
        $result = mysqli_query($mysqli, "UPDATE transaksi SET saldo_transaksi='$saldo_akhir',tanggal_transaksi='$tanggal' WHERE id_user = '$id_user' ORDER BY saldo_transaksi DESC LIMIT 1");

        header("Location: ../Income.php");
        }
    else{
        ?>
        <script>
        alert('Balance, Description and date must be filled!');
        </script>
        <?php 
    }
}
?>
<?php
    $id = $_GET['id'];

    $result = mysqli_query($mysqli, "SELECT * FROM pemasukkan WHERE
    id_pemasukkan=$id");

    while($pemasukkan = mysqli_fetch_array($result))
    {
    $saldo = $pemasukkan['saldo_pemasukkan'];
    $keterangan = $pemasukkan['ket_pemasukkan'];
    $tanggal = $pemasukkan['tanggal_pemasukkan'];
    }
?>
<html>
<head>
<title>Edit Pemasukkan</title>
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
            <li class="right-navbar"><a href="../Outcome.php">Expense</a></li>
            <li class="right-navbar"><a class="active" href="javascript:void(0)">Income</a></li>
            <li class="right-navbar"><a href="../Transaction.php">Transaction</a></li>
        </ul>
    </div>
    <div class="login">
        <div class="login-wrapper">
            <div class="container">
                <div class="header">
                    <h3>Add Income</h3>
                </div>
                <div class="content">
                    <form action="editPemasukkan.php" method="post" name="income" >
                    <table class="main-content">
                        <tr>
                            <td class="label"><label for="">Income</label></td>
                            <td><input type="text" name="saldo" placeholder="Income" value=<?php echo $saldo;?> autocomplete="off"></td>
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
</table>
</form>
</body>
</html>
