<?Php
require_once('../includes/connect.php');
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/styles.css">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="../js/js.js"></script>
</head>
<body>
    <div class="container">
        <div class="loginBox">
            <p>Teacher</p>
            <input type="text" id="teacherEmail"placeholder="Email" class="inputUsername"name="teacher_email">
			<b id="teacher_invalidEmail"></b>
            <input type="password" id="teacherPassword"placeholder="Password" class="inputPassword"name="teacher_password">
			<b id="teacher_incorrectPassword"></b>
            <input type="submit"onclick="teacherLogin()"name="login" value="Login"class="login-submitButton">
        </div>
    </div>
</body>
</html>