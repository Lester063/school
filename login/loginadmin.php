<?Php
require_once('../includes/connect.php');
session_start();

if(isset($_POST['login'])) {
	$sql_user="SELECT * FROM `admin` WHERE email='".$_POST['email']."' 
			AND password = '".$_POST['password']."' ";
			$result_user=mysqli_query($conn,$sql_user);
			
			if(mysqli_num_rows($result_user)>0) {
				while($row = mysqli_fetch_assoc($result_user)) {
					$_SESSION['admin_id'] = $row['admin_id'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['password'] = $row['password'];
					$_SESSION['firstname'] = $row['firstname'];
					$_SESSION['middlename'] = $row['middlename'];
					$_SESSION['lastname'] = $row['lastname'];
					$_SESSION['userlevel'] = $row['userlevel'];
					$_SESSION['schoolyear'] = $row['schoolyear'];  
				}
				header('Location:../admin/adminPage/adminpage.php');
			}
			else{
				echo "<script>alert('Invalid User!')</script>";
			}
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <div class="container">
		<form action="loginadmin.php" method="POSt">
			<div class="loginBox"style="border:1px solid #000;border-radius:5px;">
				<p>Admin</p>
				<input type="text" placeholder="Email" class="inputUsername"name="email">
				<input type="password" placeholder="Password" class="inputPassword"name="password">
				<input type="submit"name="login" value="Login"class="login-submitButton">
			</div>
		</form>
    </div>
</body>
</html>