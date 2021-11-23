<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="login">
        <div class="login-wrapper">
            <div class="container">
                <div class="header">
                    <h3>Sign Up</h3>
                </div>
                <div class="content">
                    <form action="Registration.php" method="post" name="login" >
                    <table class="main-content">
                        <tr>
                            <td><label for="">Name</label></td>
                            <td><input class="text" type="text" name="name" placeholder="Name" id="nama" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td><label for="">Username</label></td>
                            <td><input class="text" type="text" name="username" placeholder="Username" id="username" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td><label for="">Password</label></td>
                            <td><input class="text" type="password" name="password" placeholder="Password" id="password"></td>
                        </tr>
                    </table>
                    <input class="form_button" type="submit" name="Submit" value="Sign Up"></input>
                    </form>
                </div>
                <div class="signup">
                <p>Already Have Account? </p><a href="index.php"> Sign In Here..</a>
                </div> 
            </div>
        </div> 
    </div>
   <!--  <script type="text/javascript">
	function validasi() {
        var nama = document.getElementById("nama").valur;
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;		
		if (username != "" && password!="" && nama !="") {
			return true;
		}else{
			alert('Username and Password must be filled!');
			return false;
		}
	}
    </script> -->
    <?php
    if(isset($_POST['Submit'])){
        if($_POST['name'] != "" && $_POST['username'] != ""&& $_POST['password'] != ""){
            $nama = $_POST['name'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password = md5($password);
            
            include_once("config.php");
    
            $result = mysqli_query($mysqli, "INSERT INTO usher(nama_user,username_user,password_user) VALUES ('$nama','$username','$password')");
            $id_user = mysqli_query($mysqli, "SELECT id_user FROM usher WHERE nama_user = '$nama' AND username_user='$username'");
            $id_user = mysqli_fetch_assoc($id_user);

            $result = mysqli_query($mysqli, "INSERT INTO transaksi(saldo_transaksi,tanggal_transaksi,id_pemasukkan,id_pengeluaran,id_user) VALUES ('0','1111-11-11','1','1','".$id_user["id_user"]."')");
            
            ?>
            <script>
            alert('Account Created');
            </script>
            <?php
            header("location:index.php");   
        }
        else{
            ?>
            <script>
            alert('Nama, Username and Password must be filled!');
            </script>
            <?php
        }
    }   
    ?>
</body>
</html>