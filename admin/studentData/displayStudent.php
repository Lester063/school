<?Php
require_once('../../includes/connect.php');

if(isset($_POST['action'])=="search_students"){
    $student_year=$_POST['selectedYear'];
    $searchStudent=$_POST['searchStudent'];
    $sql_user="SELECT * FROM users WHERE userlevel ='Student'
    AND
    lastname LIKE '%".$searchStudent."%'
    AND
    year LIKE '%".$student_year."%'
    ";
    $result_user=mysqli_query($conn,$sql_user);
    if($student_year=="all"){
        $sql_user="SELECT * FROM users WHERE userlevel ='Student'
        AND lastname LIKE '%".$searchStudent."%'

        ";
        $result_user=mysqli_query($conn,$sql_user);
    }
}







?>

<table class="table" id="myTable">

    <tr>
        <td colspan=10 style="text-align:center;background-color:#349beb;font-size:30px"><b>STUDENTS</b></td>
    </tr>
    <tr>
        <td><b>SN</b></td>
        <td style="width:200px;"><b>Email</b></td>
        <td style="width:280px;"><b>Full Name</b></td>
        <td><b>Year</b></td>
        <td><b>Status</b></th>
        <td><b>Action</b></td>
        <td><b>View</b></td>
    </tr>
<?Php
while($row = mysqli_fetch_assoc($result_user)){
	$id=$row['id'];
?>

<tr class="asd"id="<?Php echo $row['id'];?>">
	<td><?Php echo $row['student_number'];?></td>
	<td><?Php echo $row['email'];?></td>
	<td><?Php echo $row['lastname'].", ". $row['firstname']. " ".$row['middlename'];?></td>
	<td><?Php echo $row['year'];?></td>
	<td>
        <?php 
            if($row['status']=='ACTIVATED'){
        ?>
        <button class="bluewhitebutton"onclick="confirm('Are you sure?') && userActivate(<?Php echo $row['id'];?>)"id="<?Php echo "btn.".$row['id'];?>"><?Php echo $row['status'];?></button>
        <?php
            }else{
        ?>
 <button class="redblackButton"onclick="confirm('Are you sure?') && userActivate(<?Php echo $row['id'];?>)"id="<?Php echo "btn.".$row['id'];?>"><?Php echo $row['status'];?></button>
        <?php
            }
        ?>
    </td>
    
	
	<td>
		<button type="button" class="deletebutton"name="button" onclick = "confirm('Are you sure ?') && deletedata(<?php echo $row['id']; ?>);">Delete</button>
		<button type="button" class="editbutton"name="editbutton"id="<?php echo $row['id'];?>" onclick = "editdata(<?php echo $row['id']; ?>);">Edit Data</button>
	</td>
    <td><a href="studentdata_pdf.php?id=<?php echo $row['id']?>">View</a></td>
	</tr>
<?Php
}
?>
</table>
