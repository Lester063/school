<?Php
require_once('../includes/connect.php');
session_start();

if($_SESSION['userlevel'] == 'Admin') {
    session_unset();
    session_destroy();
	header('Location:../login/loginadmin.php');
}
else if($_SESSION['teacher_userlevel'] == 'TEACHER') {
    session_unset();
    session_destroy();
	header('Location:../login/loginteacher.php');
}
else{
    session_unset();
    session_destroy();
	header('Location:../login/loginpage.php');
}

?>