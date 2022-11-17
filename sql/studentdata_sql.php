<?Php
require_once('../includes/connect.php');
session_start();
if(isset($_POST['action'])){
    if($_POST['action']=="action_addStudent"){
        addStudent();
    }
    else if($_POST['action']=="action_deleteStudent"){
        deleteStudent();
    }
    else if($_POST['action']=="action_getdataStudent"){
        getdata_editStudent();
    }
    else if($_POST['action']=="action_updateStudent"){
        updateStudent();
    }
    else if($_POST['action']=="action_studentActivation_toggle"){
        userActivation_toggle();
    }


}

function addStudent(){
    global $conn;
    if(!empty($_POST['firstname'] AND  $_POST['lastname'] AND $_POST['contact_number'] AND $_POST['year'])){	
		if(empty($_POST['middlename'])){
			$middlename=" ";
		}
		$admin_id=$_SESSION['admin_id'];
		$sql_admin=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM admin WHERE admin_id=$admin_id"));
		$schoolyear=$sql_admin['schoolyear'];

		$sql="SELECT * FROM users WHERE schoolyear_accepted='$schoolyear'";
		$result=mysqli_query($conn, $sql);
		$count=0;
		while($row=mysqli_fetch_assoc($result)){
			$count++;
		}
		$student_num=$count+1;
		$s=substr($schoolyear,2,2);
		$y=substr($schoolyear,7,8);
		$sy=$s.$y;

		$emailId=$y.$student_num;
		$firstname=substr($_POST['firstname'],0,1);
		$emailFullname=strtolower($firstname.'.'.$_POST['lastname']);
		$email=$emailFullname.$emailId.'@school.com';
		$firstname=$_POST['firstname'];
		$middlename=$_POST['middlename'];
		$lastname=$_POST['lastname'];
		$contact_number=$_POST['contact_number'];
		$year=$_POST['year'];
		$course=$_POST['course'];
		$userlevel="Student";
		$status="ACTIVATED";
		$password='qwerty123';

		$hashed_password=password_hash($password, PASSWORD_DEFAULT);



		$student_number=$sy.'-'.$student_num;

		
		$sql_user="INSERT INTO users (email, student_number,course, password, firstname, middlename, lastname, contact_number, userlevel, status, year, schoolyear, schoolyear_accepted)
		VALUES ('$email','$student_number','$course','$hashed_password','$firstname','$middlename','$lastname','$contact_number','$userlevel','$status','$year','$schoolyear', '$schoolyear')";
		mysqli_query($conn, $sql_user);

		$last_id = $conn->insert_id;
		$get_lastCreated=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE id='$last_id' ORDER BY id DESC LIMIT 1"));
		$theLastEmail=$get_lastCreated['email'];
		$student_number=$get_lastCreated['student_number'];
		echo "<table>
		<tr>
			<td>Email: </td>
			<td><b>$theLastEmail</b></td>
		</tr>
		<tr>
			<td>Student Number: </td>
			<td><b>$student_number</b></td>
		</tr>
		<tr>
			<td>Password: </td>
			<td><b>qwerty123</b></td>
		</tr>
		<tr>
			<td>Admin Contact #: </td>
			<td><b>09212483577</b></td>
		</tr>
	</table>";	
	}
	else{
		echo 2;
	}
}

function deleteStudent(){
    global $conn;
  
    $id = $_POST["id"];
  
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    echo 1;
}

function getdata_editStudent(){
    global $conn;
    $student_id=$_POST['student_id'];
    $query= "SELECT * FROM users WHERE id='$student_id'";
    $result =mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

function updateStudent(){
    global $conn;

    $sql_user="UPDATE `users` SET 
    `email`='".$_POST['email']."',
    `firstname`='".$_POST['firstname']."',
    `middlename`='".$_POST['middlename']."',
    `lastname`='".$_POST['lastname']."',
    `contact_number`='".$_POST['contact_number']."',
    `year`='".$_POST['year']."'


    WHERE id=".$_POST['student_id'];

    mysqli_query($conn,$sql_user);
    echo 1;
}

function userActivation_toggle(){
	global $conn;
	$student_id=$_POST['student_id'];
	$getStatus=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE id='$student_id'"));
	$status=$getStatus['status'];
	if($status=="ACTIVATED"){
		$deactivate="UPDATE users set status='DEACTIVATED' WHERE id='$student_id'";
		mysqli_query($conn,$deactivate);
		echo 1;
	}
	else{
		$activate="UPDATE users set status='ACTIVATED' WHERE id='$student_id'";
		mysqli_query($conn,$activate);
		echo 2;
	}
}



?>