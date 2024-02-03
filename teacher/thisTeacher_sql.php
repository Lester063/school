<?php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['teacher_id'])) {
	header('Location:../login/loginpage.php');
}

if(isset($_POST['action'])) {
    if($_POST['action'] == "teacher_changePassword") {
        teacher_changePassword();
    }
}

function teacher_changePassword() {
    global $conn;
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $verifynewPassword = $_POST['verifynewPassword'];
    $teacher_id = $_SESSION['teacher_id'];

    $sqlgetpassword = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM teacher WHERE teacher_id = '$teacher_id'"));
    $getoldPassword = $sqlgetpassword['teacher_password'];

    if(password_verify($oldPassword, $getoldPassword)) {
        $hashed_newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $change_password = "UPDATE teacher SET teacher_password = '$hashed_newPassword' WHERE teacher_id = '$teacher_id'";
        mysqli_query($conn, $change_password);
        echo 1;
    }
    else{
        echo 2;
    }
}

?>