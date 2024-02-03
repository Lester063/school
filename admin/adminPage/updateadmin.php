<?php
require_once('../../includes/connect.php');

$admin_schoolyear = $_POST['admin_schoolyear'];
$sql_admin = "UPDATE `admin` SET 
`email`='".$_POST['admin_email']."',
`firstname`='".$_POST['admin_firstname']."',
`middlename`='".$_POST['admin_middlename']."',
`lastname`='".$_POST['admin_lastname']."',
`schoolyear`='".$_POST['admin_schoolyear']."'

WHERE admin_id=".$_POST['admin_id'];

mysqli_query($conn,$sql_admin);



$sql_user = "SELECT id FROM users";
$sql_result = mysqli_query($conn,$sql_user);
while($row = mysqli_fetch_assoc($sql_result)){
    mysqli_query($conn,"UPDATE users SET schoolyear = '$admin_schoolyear' WHERE id = ".$row['id']);
}

$sql_teacher = "SELECT teacher_id FROM teacher";
$teacher_result = mysqli_query($conn,$sql_teacher);
while($teacher = mysqli_fetch_assoc($teacher_result)){
    mysqli_query($conn,"UPDATE teacher SET schoolyear='$admin_schoolyear' WHERE teacher_id=".$teacher['teacher_id']);
}
echo 1;



?>

