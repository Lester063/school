<?Php
require_once('../includes/connect.php');
session_start();
if(isset($_POST['action'])) {
    if($_POST['action'] == "action_changePassword") {
        changePassword();
    }
    else if($_POST['action'] == "action_enrollStudent") {
        enrollStudent();
    }
}

function changePassword() {
    global $conn;
    $studentNumber = $_POST['studentNumber'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $verify_newPassword = $_POST['verify_newPassword'];
    $sqlgetpassword = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='$studentNumber'"));
    $get_oldPassword = $sqlgetpassword['password'];
    if(password_verify($oldPassword, $get_oldPassword)) {
        $hashed_newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $change_password = "UPDATE users SET password='$hashed_newPassword' WHERE id='$studentNumber'";
        mysqli_query($conn, $change_password);
        echo 1;
    }
    else{
        echo 2;
    }
}

function enrollStudent() {
    global $conn;
    $fullname = $_POST['fullname'];
    $schoolyear = $_POST['schoolyear'];
    $student_id = $_POST['student_id'];
    $enrollment_status = $_POST['enrollment_status'];
    $section_id = $_POST['section_id'];
    $email = $_POST['email'];
    $student_number = $_POST['student_number'];
    

    $student_qty = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM section WHERE section_id = '$section_id'"));
	$max_qty = mysqli_fetch_assoc(mysqli_query($conn, "SELECT max_qty FROM section WHERE section_id = '$section_id'"));
    $sql_check = mysqli_query($conn, "SELECT * FROM enrollment WHERE student_id = '".$_POST['student_id']."' AND schoolyear = '".$_POST['schoolyear']."'");

    $yearsection = $student_qty['yearsection'];
    if(mysqli_num_rows($sql_check)) {
		echo 1;
	}
	else if($student_qty['student_qty'] >= $student_qty['max_qty']) {
		echo 2;
	}
	else{
        $sql_enrollment = "INSERT INTO enrollment (student_id,student_number, fullname, student_email, section_id,yearsection, enrollment_status, schoolyear)
		VALUES ('$student_id','$student_number','$fullname', '$email','$section_id','$yearsection','$enrollment_status','$schoolyear')";
		mysqli_query($conn, $sql_enrollment);

		$sql_student_qty="UPDATE `section` SET student_qty=student_qty+1
		WHERE section_id='$section_id'";
		mysqli_query($conn,$sql_student_qty);

        echo 0;
    }
}
	
?>


