
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
    
    <title>Document</title>
</head>
<body>
    <div class="login">
        <div class="login-wrapper">
            <div class="container">
                <div class="header">
                    <h3>LOGIN</h3>
                </div>
                <div class="content">
                    <form action="login.php" method="post" id="formLogin">
                        <table class="main-content">
                        <tr>
                            <td><label for="">Username</label></td>
                            <td><input class="text" type="text" name="username" placeholder="Username" id="username" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td><label for="">Password</label></td>
                            <td><input class="text"type="password" name="password" placeholder="Password" id="password"></td>
                        </tr>
                    </table>    
                    <button class="form_button" type="button" name="Submit" onclick="return validasi(this)">Login</button>
                    </form>
                </div>
                <div class="signup">
                    <p>Don't Have Account? </p><a href="Registration.php"> Sign Up Here..</a>
                </div>
            </div>
        </div> 
    </div>  
    
    <script type="text/javascript">
        function validasi(e) {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;		
            if (username != "" && password!="") {
                document.getElementById("formLogin").submit();
                return true;
            }else{
                alert('Username and Password must be filled!');
                return false;
            }
        }
    </script>
</body>

</html>
