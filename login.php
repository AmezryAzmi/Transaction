<?php 
include 'config.php';
 
$username = $_POST['username'];
$password = ($_POST['password']);
$password = md5($password);

$admin = mysqli_query($mysqli, "SELECT * FROM admins WHERE username_admin='$username' AND password_admin='$password'");
$login = mysqli_query($mysqli, "SELECT * FROM usher WHERE username_user='$username' AND password_user='$password'");
$id = mysqli_query($mysqli, "SELECT id_user FROM usher WHERE username_user='$username' AND password_user='$password'");
$id = mysqli_fetch_assoc($id);
$cek = mysqli_num_rows($login);
$admin = mysqli_num_rows($admin);

if ($admin>0){
	session_start();
	$_SESSION['id'] = $id;
	$_SESSION['status'] = "login";
	header("location:admin.php");
}
else{
	if($cek > 0){
		session_start();
		$_SESSION['id'] = $id;
		$_SESSION['status'] = "login";
		header("location:http://localhost/Transaksi/Home.php?id_user=$id[id_user]");
	}else{	
		echo '<script>alert("Wrong User Details")</script>';
	}
} 
?>