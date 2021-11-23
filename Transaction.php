<?php
include_once("config.php");
session_start();
if($_SESSION['status'] !="login"){
	header("location:index.php");
}

$id=$_SESSION['id'];
$id=$id['id_user'];

$transaksi = mysqli_query($mysqli, "SELECT A.id_transaksi, A.saldo_transaksi,
A.tanggal_transaksi, B.saldo_pemasukkan, C.saldo_pengeluaran from transaksi A INNER JOIN pemasukkan B
ON A.id_pemasukkan = B.id_pemasukkan INNER JOIN pengeluaran C
ON A.id_pengeluaran = C.id_pengeluaran WHERE A.id_user ='$id' ORDER BY A.id_transaksi DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/table.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <script src="https://kit.fontawesome.com/e3004849c2.js" crossorigin="anonymous"></script>
    <title>Transaction</title>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="Home.php?id_user=<?php $id?>">Home</a></li>
            <li class="dropdown"><a href="javascript:void(0)"><i class="fas fa-user-alt"></i></a>
            <div class="dropdown-content">
                <a href="Profile.php?id_user=<?php $id?>">Profile</a>
                <a href="admin/logout.php">Logout</a>
            </div>
            </li>
            <li class="right-navbar"><a href="Outcome.php?id_user=<?php $id?>">Outcome</a></li>
            <li class="right-navbar"><a href="Income.php?id_user=<?php $id?>">Income</a></li>
            <li class="right-navbar"><a class="active" href="javascript:void(0)">Transaction</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="main-content">
            <h2>Transaction</h2>
            <table class="content-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Balance</th>
                    <th>Income</th>
                    <th>Outcome</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while($item = mysqli_fetch_array($transaksi)) {
                echo "<tr>";
                echo "<td>".$item['tanggal_transaksi']."</td>";
                echo "<td>".$item['saldo_transaksi']."</td>";
                echo "<td id='pemasukkan' class='pemasukkan' >+".$item['saldo_pemasukkan']."</td>";
                echo "<td id='pengeluaran' class='pengeluaran'>-".$item['saldo_pengeluaran']."</td>";
                echo "<td>
                <a href='./delete/deleteTransaksi.php?id=$item[id_transaksi]'><i class='far fa-trash-alt'></i></a> 
                </td></tr>";
            }
            ?>    
            </tbody>
            </table>
        </div>
    </div> 
    <!-- <script>
        function edit(){
            var pemasukkan = document.getElementById("pemasukkan").value;
		    var pengeluaran = document.getElementById("pengeluaran").value;
            if(pemasukkan == 0){
                location.replace("./edit/editPengeluaran.php?id=<?php $item['id_pengeluaran']?>&id_user=<?php $id?>");
            }
            if(pengeluaran == 0){
                location.replace("./edit/editPemasukkan.php?id=<?php $item['id_pemasukkan']?>&id_user=<?php $id?>");
            }
        }
    </script>    -->
</body>
</html>