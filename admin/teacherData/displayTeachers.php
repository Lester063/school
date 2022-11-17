<?php
require_once('../../includes/connect.php');
if(isset($_POST['action'])=="search"){
    $se=$_POST['selectedDepartment'];
    $tr=$_POST['selectedTeacher_rank'];
	$st=$_POST['searchTeacher'];
	$sql_teacher="SELECT * FROM teacher WHERE 
    teacher_department LIKE '%".$se."%'
	AND
	teacher_lastname LIKE '%".$st."%'
	AND
	teacher_rank LIKE '%".$tr."%'";
	$result_teacher = mysqli_query($conn, $sql_teacher);
    if($se=='all'){
        $sql_teacher="SELECT * FROM teacher WHERE 
		teacher_lastname LIKE '%".$st."%'
		AND
		teacher_rank LIKE '%".$tr."%'";
        $result_teacher=mysqli_query($conn,$sql_teacher);
    }
}
else{
    $sql_teacher='SELECT * FROM teacher';
	$result_teacher=mysqli_query($conn,$sql_teacher);
}

?>
<table class="table" id="myTable">

<tr>
<td colspan=9 style="text-align:center;background-color:#349beb;font-size:30px"><b>TEACHER</b></td>
</tr>
<tr>
<td>ID</td>
<td style="width:200px;">Email</td>
<td style="width:280px;">Full Name</td>
<td>Department</td>
<td>Rank</td>
<td colspan=2>Action</td>
</tr>
<?Php
while($row = mysqli_fetch_assoc($result_teacher)){
	$teacher_id=$row['teacher_id'];
?>
<tr class="asd"id="<?Php echo $row['teacher_id'];?>">
	<td><?Php echo $row['teacher_id'];?></td>
	<td><?Php echo $row['teacher_email'];?></td>
	<td><?Php echo $row['teacher_lastname'].", ". $row['teacher_firstname']. " ".$row['teacher_middlename'];?></td>
	<td><?Php echo $row['teacher_department'];?></td>
	<td><?Php echo $row['teacher_rank'];?></td>
	
	<td>
		<button type="button" class="deletebutton"name="button" onclick = "confirm('Are you sure ?') && deleteTeacher(<?php echo $row['teacher_id']; ?>);">Delete</button>
		<button type="button" class="editteacher"name="editteacher"id="<?php echo $row['teacher_id'];?>" onclick = "editteacher(<?php echo $row['teacher_id']; ?>);">Edit Data</button>
	</td>

</tr>
<?Php
}
?>
</table>