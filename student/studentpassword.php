<?Php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['id'])) {
	header('Location:../login/loginpage.php');
}

?>

<html>
<head>
<link rel="stylesheet" href="../css/styles.css">
    <script src="../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="">
        <?Php require_once('../includes/studentnavbar.php') ?>
        <div class="studentwrapper"id="studentwrapper">
            <div class="container mt-5">
            <h3>CHANGE PASSWORD</h3>

            <input type="hidden"id="studentNumber"value="<?php echo $_SESSION['id']?>"placeholder="Old Password">
            <div class="row">
                <div class="col-sm-7 mt-4">
                <input type="password" name="oldPassword"id="oldPassword"placeholder="Old Password"class="form-control"><br>
                <input type="password" name="newPassword"id="newPassword"placeholder="New Password"class="form-control"><b style="font-size:12px"id="new_compareMessage"></b><br>
                <input type="password" name="verify_newPassword"id="verify_newPassword"placeholder="Verify New Password"class="form-control"><b style="font-size:12px" id="verify_compareMessage"></b><br>
                </div>
            </div>
            <button type="button" class="bluewhiteButton mt-3"id="changePassword"onclick="confirm('Are you sure?') && changePassword()">Change Password</button>
        </div>
    </div>

<script>
function changePassword() {

    var studentNumber = document.getElementById('studentNumber').value;
    var oldPassword = document.getElementById('oldPassword').value;
    var newPassword = document.getElementById('newPassword').value;
    var verify_newPassword = document.getElementById('verify_newPassword').value;
    var x = oldPassword.length;
    if(newPassword != verify_newPassword) {
        alert('New password does not matched');
    }
    else{
        $.ajax({
        method:"POST",
        url:"student_sql.php",
        data:{
            studentNumber:studentNumber,
            oldPassword:oldPassword,
            newPassword:newPassword,
            verify_newPassword:verify_newPassword,
            action: "action_changePassword",
        },
        success:function(response) {
            if(response==1) {
                alert('Changed Password Successfully');
                $('#studentwrapper').find('input').val('');
                
            }else{
                alert('response');
            }
        }
    })
    }
}

$(document).on('keyup','#newPassword',function() {
    var newPassword=document.getElementById('newPassword').value;
    var verify_newPassword=document.getElementById('verify_newPassword').value;
    if(newPassword==verify_newPassword) {
        document.getElementById('new_compareMessage').style.color="black";
        document.getElementById('new_compareMessage').innerHTML="Password matched";
        document.getElementById('verify_compareMessage').style.color="black";
        document.getElementById('verify_compareMessage').innerHTML="Password matched";
    }else{
        document.getElementById('new_compareMessage').style.color="red";
        document.getElementById('new_compareMessage').innerHTML="Password not matched";
        document.getElementById('verify_compareMessage').style.color="red";
        document.getElementById('verify_compareMessage').innerHTML="Password not matched";
    }
})

$(document).on('keyup','#verify_newPassword',function() {
    var newPassword=document.getElementById('newPassword').value;
    var verify_newPassword=document.getElementById('verify_newPassword').value;
    if(newPassword==verify_newPassword) {
        document.getElementById('new_compareMessage').style.color="black";
        document.getElementById('new_compareMessage').innerHTML="Password matched";
        document.getElementById('verify_compareMessage').style.color="black";
        document.getElementById('verify_compareMessage').innerHTML="Password matched";
    }else{
        document.getElementById('new_compareMessage').style.color="red";
        document.getElementById('new_compareMessage').innerHTML="Password not matched";
        document.getElementById('verify_compareMessage').style.color="red";
        document.getElementById('verify_compareMessage').innerHTML="Password not matched";
    }
})
</script>
</body>
</html>