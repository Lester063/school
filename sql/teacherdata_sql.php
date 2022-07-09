<?Php
require_once('../includes/connect.php');
session_start();
if(isset($_POST['action'])){
    if($_POST['action']=="action_addTeacher"){
        addTeacher();
    }
    else if($_POST['action']=="action_deleteTeacher"){
        deleteTeacher();
    }
    else if($_POST['action']=="action_getData_Edit"){
        getData_editTeacher();
    }
    else if($_POST['action']=="action_updateTeacherdata"){
        updateTeacherdata();
    }



}

function addTeacher(){
    global $conn;
    if(!empty($_POST['teacher_firstname'] AND  
	$_POST['teacher_lastname'] AND $_POST['teacher_contactnumber'] AND $_POST['teacher_userlevel']  AND $_POST['teacher_rank'])){	
		if(empty($_POST['teacher_middlename'])){
			$middlename=" ";
		}
        
		$emailFullname=strtolower($_POST['teacher_firstname'].$_POST['teacher_lastname']);
		$teacher_email=$emailFullname.'@school.com';

		$teacher_firstname=$_POST['teacher_firstname'];
		$teacher_middlename=$_POST['teacher_middlename'];
		$teacher_lastname=$_POST['teacher_lastname'];
		$teacher_contactnumber=$_POST['teacher_contactnumber'];
		$teacher_userlevel=$_POST['teacher_userlevel'];
        $teacher_department=$_POST['teacher_department'];
		$teacher_status='ACTIVATED';
        $schoolyear=$_SESSION['schoolyear'];
		$teacher_rank=$_POST['teacher_rank'];

        $teacher_password='qwerty123';
        $hashed_password=password_hash($teacher_password, PASSWORD_DEFAULT);

		
		$sql_user="INSERT INTO teacher (teacher_email, teacher_firstname, teacher_middlename, teacher_lastname, teacher_contactnumber, teacher_userlevel,teacher_department, teacher_password, teacher_rank, teacher_status, schoolyear)
		VALUES ('$teacher_email','$teacher_firstname','$teacher_middlename','$teacher_lastname','$teacher_contactnumber','$teacher_userlevel','$teacher_department','$hashed_password', '$teacher_rank','$teacher_status','$schoolyear')";
		mysqli_query($conn, $sql_user);
		
        $last_id = $conn->insert_id;
		$get_lastCreated=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM teacher WHERE teacher_id='$last_id' ORDER BY teacher_id DESC LIMIT 1"));
		$theLastEmail=$get_lastCreated['teacher_email'];
		echo "<table>
		<tr>
			<td>Email: </td>
			<td><b>$theLastEmail</b></td>
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

function deleteTeacher(){
    global $conn;
  
    $teacher_id = $_POST["teacher_id"];
  
    $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM teacher WHERE teacher_id = $teacher_id"));
    
   
  
    mysqli_query($conn, "DELETE FROM teacher WHERE teacher_id = $teacher_id");
    echo 1;

}

function getData_editTeacher(){
    global $conn;
    $teacher_id=$_POST['teacher_id'];
    $query= "SELECT * FROM teacher WHERE teacher_id='$teacher_id'";
    $result =mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

function updateTeacherdata(){
    global $conn;
    $sql_user="UPDATE `teacher` SET 
    `teacher_email`='".$_POST['teacher_email']."',
    `teacher_firstname`='".$_POST['teacher_firstname']."',
    `teacher_middlename`='".$_POST['teacher_middlename']."',
    `teacher_lastname`='".$_POST['teacher_lastname']."',
    `teacher_contactnumber`='".$_POST['teacher_contactnumber']."',
    `teacher_rank`='".$_POST['teacher_rank']."',
    `teacher_department`='".$_POST['teacher_department']."'


    WHERE teacher_id=".$_POST['teacher_id'];

    mysqli_query($conn,$sql_user);
    echo 1;
}	

?>

