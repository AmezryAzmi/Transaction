<?php
include 'config.php';
 
session_start();
 
if($_SESSION['status'] !="login"){
	header("location:index.php");
}

$id=$_SESSION['id'];
$id=$id['id_user'];

$pemasukkan = mysqli_query($mysqli, "SELECT A.tanggal_transaksi, B.saldo_pemasukkan, B.ket_pemasukkan, B.id_pemasukkan FROM transaksi A INNER JOIN pemasukkan B ON A.id_pemasukkan = B.id_pemasukkan WHERE A.id_user = '$id' AND NOT B.saldo_pemasukkan ='0' ORDER BY B.saldo_pemasukkan DESC");
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
            <li><a href="Home.php">Home</a></li>
            <li class="dropdown"><a href="javascript:void(0)"><i class="fas fa-user-alt"></i></a>
            <div class="dropdown-content">
                <a href="Profile.php">Profile</a>
                <a href="admin/logout.php">Logout</a>
            </div>
            </li>
            <li class="right-navbar"><a href="Outcome.php">Outcome</a></li>
            <li class="right-navbar"><a class="active" href="javascript:void(0)">Income</a></li>
            <li class="right-navbar"><a href="Transaction.php">Transaction</a></li>
        </ul>
    </div>
    <div class="main">
        <div class="main-content">
            <h2>Income</h2>
            <div>    
                <table class="content-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Income</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while($item = mysqli_fetch_array($pemasukkan)) {
                    echo "<tr>";
                    echo "<td>".$item['tanggal_transaksi']."</td>";
                    echo "<td class='pemasukkan'>+".$item['saldo_pemasukkan']."</td>";
                    echo "<td>".$item['ket_pemasukkan']."</td>";
                    echo "<td>
                    <a href='./edit/editPemasukkan.php?id=$item[id_pemasukkan]'><i class='far fa-edit'></i></a> |
                    <a href='./delete/deletePemasukkan.php?id=$item[id_pemasukkan]'><i class='far fa-trash-alt'></i></a> 
                    </td></tr>";
                }
                ?>    
                </tbody>
                </table>
                <a class="button-income" href="./add/addPemasukkan.php"><i class="fas fa-plus"></i></a><br>
            </div>
        </div>
    </div>    
</body>
</html>