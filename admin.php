<?php
include 'config.php';
 
session_start(); 
if($_SESSION['status'] !="login"){
	header("location:index.php");
}


$user = mysqli_query($mysqli, "SELECT * FROM usher ORDER BY id_user DESC");

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
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/search.css">
    <script src="https://kit.fontawesome.com/e3004849c2.js" crossorigin="anonymous"></script>
    <title>Admin</title>
</head>
<body>
    <div class="navbar">
        <ul>
            <li><a href="admin.php">Home</a></li>
            <li class="dropdown"><a href="javascript:void(0)"><i class="fas fa-user-alt"></i></a>
            <div class="dropdown-content">
                <a href="Profile.php?id_user=<?php $id?>">Profile</a>
                <a href="admin/logout.php">Logout</a>
            </div>
            </li>
        </ul>
    </div>
    <div class="main">
        <div class="main-content">
            <div class="search">
                <form action="admin.php" method="post" name="search">
                    <table class="content_search">
                        <tr>
                            <td class="label"><label for="">Search :</label></td>
                            <td class="td"><input class="texts" type="text" name="search" autocomplete="off"></td>
                            <td class="td"><input class="searchs"type="submit" name="submit" value="GO!"></td>
                        </tr>
                    </table>
                </form>
                <?php
                if(isset($_POST['submit'])){
                    if($_POST['search']!=""){
                        $search = $_POST['search'];
                        include("config.php");
                        $result1 = mysqli_query($mysqli, "SELECT * FROM usher WHERE nama_user LIKE '%$search%' OR username_user LIKE '%$search%' ");
                        $result2 = mysqli_num_rows($result1);
                        if($result2>0){
                            ?>
                            <table class="content-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while($item = mysqli_fetch_assoc($result1)) {
                                        echo "<tr>";
                                        echo "<td>".$item['id_user']."</td>";
                                        echo "<td>".$item['nama_user']."</td>";
                                        echo "<td> ".$item['username_user']."</td>";
                                        echo "<td>
                                        <a href='./edit/editUser.php?id=$item[id_user]'><i class='far fa-edit'></i></a> |
                                        <a href='./delete/deleteUser.php?id=$item[id_user]'><i class='far fa-trash-alt'></i></a> 
                                        </td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php    
    
                        } 
                        else{
                            ?>
                            <script>
                            alert('Search Not Found');
                            </script>
                            <?php
                        } 
                    }
                    else{
                        ?>
                        <script>
                        alert('Search Must Be Filled!');
                        </script>
                        <?php
                    } 
                }
                ?>
            </div>
            <h2>User</h2>
            <table class="content-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            while($item = mysqli_fetch_assoc($user)) {
                echo "<tr>";
                echo "<td>".$item['id_user']."</td>";
                echo "<td>".$item['nama_user']."</td>";
                echo "<td> ".$item['username_user']."</td>";
                echo "<td>
                <a href='./edit/editUser.php?id=$item[id_user]'><i class='far fa-edit'></i></a> |
                <a href='./delete/deleteUser.php?id=$item[id_user]'><i class='far fa-trash-alt'></i></a> 
                </td></tr>";
            }
            ?>    
            </tbody>
            </table>
        </div>
    </div>    
</body>
</html>