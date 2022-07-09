<?Php
require_once('../includes/connect.php');
session_start();

if(isset($_POST['action'])){
    if($_POST['action']=="student_login"){
        studentLogin();
    }
    else if($_POST['action']=="teacher_login"){
		teacherLogin();
    }




}
		

function studentLogin(){
    global $conn;
    $email=$_POST['email'];
	$password=$_POST['password'];
			$getdata=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM users WHERE email='$email'"));


			$sql_user="SELECT * FROM users WHERE email='$email'";
			$result_user=mysqli_query($conn,$sql_user);
	if(mysqli_num_rows($result_user)>0){
		if(password_verify($password, $getdata['password'])){

				while($row = mysqli_fetch_assoc($result_user)){
				$_SESSION['id'] = $row['id'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['firstname'] = $row['firstname'];
				$_SESSION['middlename'] = $row['middlename'];
				$_SESSION['lastname'] = $row['lastname'];
				$_SESSION['contact_number'] = $row['contact_number'];
				$_SESSION['year'] = $row['year'];
				$_SESSION['userlevel'] = $row['userlevel'];
				$_SESSION['status'] = $row['status'];
				$_SESSION['schoolyear'] = $row['schoolyear'];

				$_SESSION['student_number'] = $row['student_number'];
				$_SESSION['course'] = $row['course'];
				if($_SESSION['status']=='ACTIVATED'){
					echo 'log.php';
				}
				else{
					echo 4;
				}
			}
			
		

			
		}
			
		else{
			echo 1;
			
		}
	}
	else{
		echo 2;
	}
}


function teacherLogin(){
    global $conn;
    $email=$_POST['email'];
	$passwordko=$_POST['password'];
			$getdata_teacher=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM teacher WHERE teacher_email='$email'"));


			$sql_teacher="SELECT * FROM teacher WHERE teacher_email='$email'";
			$result_teacher=mysqli_query($conn,$sql_teacher);
	if(mysqli_num_rows($result_teacher)>0){
		if(password_verify($passwordko, $getdata_teacher['teacher_password'])){

			while($row = mysqli_fetch_assoc($result_teacher)){
				$_SESSION['teacher_id'] = $row['teacher_id'];
				$_SESSION['teacher_email'] = $row['teacher_email'];
				$_SESSION['teacher_password'] = $row['teacher_password'];
				$_SESSION['teacher_firstname'] = $row['teacher_firstname'];
				$_SESSION['teacher_middlename'] = $row['teacher_middlename'];
				$_SESSION['teacher_lastname'] = $row['teacher_lastname'];
				$_SESSION['teacher_contactnumber'] = $row['teacher_contactnumber'];
				$_SESSION['teacher_userlevel'] = $row['teacher_userlevel'];
                $_SESSION['teacher_department'] = $row['teacher_department'];
				$_SESSION['teacher_status'] = $row['teacher_status'];
				$_SESSION['teacher_rank'] = $row['teacher_rank'];


				$_SESSION['schoolyear'] = $row['schoolyear'];
				if($_SESSION['teacher_status']=='ACTIVATED'){
					echo 'log.php';
				}
				else{
					echo 4;
				}
			}
			
		

			
		}
		else{
			echo 1;
		}
	}
	else{
		echo 2;
	}
}



?>

