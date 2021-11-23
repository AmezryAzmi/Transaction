<?php 
include 'config.php';
session_start();

if($_SESSION['status'] !="login"){
	header("location:index.php");
}
$id=$_SESSION['id'];
$id=$id['id_user'];
$profile=mysqli_query($mysqli, "SELECT * FROM usher WHERE id_user =$id");
$profile = mysqli_fetch_array($profile);


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <div>
            <h2>Profile</h2>
            <form action="Profile.php" method="post" name="form1">
            <table>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" value="<?php echo $profile['nama_user'];?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo$profile['username_user'];?>" ></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" value="*****"></td>
                </tr>
                <tr>
                    <td>Edit</td>
                    <td><input type="submit" name="Submit" value="Edit"></td>
                </tr>
            </table>
            </form>
            <?php
            if(isset($_POST['Submit'])){
                $name = $_POST['nama'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $password = md5($password);
                include_once("config.php");
                $result = mysqli_query($mysqli, "UPDATE usher SET nama_user = '$nama',username = '$username', password_user = '$password' WHERE id_user = '$id'");        
            }
            ?>
        </div>
    </div>
</body>
</html>