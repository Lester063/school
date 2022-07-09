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
            <p>Student</p>
            <input type="text"id="studentEmail" placeholder="Email" class="inputUsername"name="email">
			<b id="invalidEmail"style="color:red;font-size:10px;"></b>
            <input type="password" id="studentPassword"placeholder="Password" class="inputPassword"name="password">
			<b id="incorrectPassword"style="color:red;font-size:10px;"></b>
            <input type="submit"onclick="studentLogin()"name="login" value="Login"class="login-submitButton">
        </div>












    </div>

<script>

</script>
</body>

</html>