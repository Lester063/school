<?Php
session_start();



if($_SESSION['userlevel']=='ADMIN'){
	header('Location:../admin/adminPage/adminpage.php');
}
else if($_SESSION['teacher_userlevel']=='TEACHER'){
	header('Location:../teacher/teacherpage.php');
}
else{
	header('Location:../student/studentpage.php');
}



?>
