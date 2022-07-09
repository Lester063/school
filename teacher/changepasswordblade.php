<?php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['teacher_id'])){
	header('Location:../login/loginpage.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/js.js"></script>
    
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?Php require_once('../includes/teachernavbar.php') ?>
<div class="teacherwrapper"id="teacherwrapper">
<div class="container mt-5">
    <div class="col-sm-6">
        <h1>Change Password</h1>
        <input type="hidden"id="teacher_id"value=<?php echo $_SESSION['teacher_id']?>>
        <input type="password"class="form-control mt-2" id="teacher_oldPassword"placeholder="Old Password">

        <input type="password"class="form-control mt-2" id="teacher_newPassword"placeholder="New Password">
        <b id="teacher_new_compareMessage"style="font-size:12px"></b>
        <input type="password"class="form-control mt-2" id="teacher_verifynewPassword"placeholder="Verify New Password">
        <b id="teacher_verify_compareMessage"style="font-size:12px"></b></br>
        <button id="teacher_changePassword"class="bluewhiteButton mt-2">Change</button>
        
    </div>
</div>
</div>


</body>
</html>