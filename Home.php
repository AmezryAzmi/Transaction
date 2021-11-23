<?php 
include 'config.php';
session_start();

if($_SESSION['status'] !="login"){
	header("location:index.php");
}
$id=$_SESSION['id'];
$id=$id['id_user'];

$sql_saldo = mysqli_query($mysqli, "SELECT saldo_transaksi FROM transaksi WHERE id_user = '$id' ORDER BY saldo_transaksi DESC LIMIT 1");
$sql_saldo = mysqli_fetch_assoc($sql_saldo);
$saldo = $sql_saldo["saldo_transaksi"];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <script src="https://kit.fontawesome.com/e3004849c2.js" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a class="active" href="javascript:void(0)">Home</a></li>
            <li class="dropdown"><a href="javascript:void(0)"><i class="fas fa-user-alt"></i></a>
            <div class="dropdown-content">
                <a href="Profile.php">Profile</a>
                <a href="admin/logout.php">Logout</a>
            </div>
            </li>
            <li class="right-navbar"><a href="Outcome.php">Outcome</a></li>
            <li class="right-navbar"><a href="Income.php">Income</a></li>
            <li class="right-navbar"><a href="Transaction.php">Transaction</a></li>
        </ul>
    </div>    
    <div class="main-home">       
        <h2>BALANCE</h2>
        <p>Rp.<?php echo $saldo?></p>
    </div>
</body>
</html>