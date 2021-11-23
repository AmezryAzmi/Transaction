<?php
include '../config.php';
 
session_start(); 
if($_SESSION['status'] !="login"){
	header("location:index.php");
}

if(isset($_POST['update']))
{
    if($_POST['nama'] != "" && $_POST['username'] != ""){
        $id = $_POST['id'];
        $nama=$_POST['nama'];
        $username=$_POST['username'];

        $edit = mysqli_query($mysqli, "UPDATE usher SET nama_user='$nama', username_user='$username' WHERE id_user = '$id'");
        header("location:../admin.php");
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

    $result = mysqli_query($mysqli, "SELECT * FROM usher WHERE
    id_user=$id");

    while($user = mysqli_fetch_array($result))
    {
    $nama = $user['nama_user'];
    $username = $user['username_user'];
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
        </ul>
    </div>
    <div class="login">
        <div class="login-wrapper">
            <div class="container">
                <div class="header">
                    <h3>Edit User</h3>
                </div>
                <div class="content">
                    <form action="editUser.php" method="post" name="income" >
                    <table class="main-content">
                        <tr>
                            <td class="label"><label for="">Nama</label></td>
                            <td><input type="text" name="nama" placeholder="Nama" value=<?php echo $nama;?> autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="">Username</label></td>
                            <td><input type="text" name="username" placeholder="Username" value=<?php echo $username;?> autocomplete="off"></td>
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