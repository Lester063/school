<?Php
require_once('../../includes/connect.php');
session_start();
if(!isset($_SESSION['firstname'])){
	header('Location:../../login/loginpage.php');
}


$name=$_SESSION['firstname'];
$admin_id=$_SESSION['admin_id'];
$sql="SELECT * FROM `admin` WHERE admin_id=$admin_id";
$result=mysqli_query($conn, $sql);
$admin_sql=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_id=$admin_id"));

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="../js/javascript.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="messageTo"id="messageTo"></div>
    <?Php require_once('../../includes/navbar.php') ?>
    <?Php require_once('updateadminform.php') ?>

    <div class="wrap"id="wrap">
        
        <div class="container mt-5">
	    <div class="col-sm-7">
            <table class="myTable">
                <tr>
                    <td colspan=2>PROFILE
                        <button type="button" class="adminEdit bluewhiteButton" name="nimal" 
                        id="<?php echo $_SESSION['admin_id'] ?>"onclick="adminEditForm(<?php echo $admin_id?>)">
                        Edit Data</button>
                    </td>
                </tr>

                <tr>
                    <td>Firstname</td>
                    <td><?Php echo $admin_sql['firstname']?></td>
                </tr>

                <tr>
                    <td>Middle Name</td>
                    <td><?Php echo $admin_sql['middlename']?></td>
                </tr>

                <tr>
                    <td>Last Name</td>
                    <td><?Php echo $admin_sql['lastname']?></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td><?Php echo $admin_sql['email']?></td>
                </tr>
                
                <tr>
                    <td>Schoolyear</td>
                    <td><?Php echo $admin_sql['schoolyear']?></td>
                </tr>
            </table>
        </div>
        </div>
    </div>

</body>

</html>