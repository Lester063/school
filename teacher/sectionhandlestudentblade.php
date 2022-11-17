<?Php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['teacher_id'])){
	header('Location:../login/loginpage.php');
}

$teacher_firstname=$_SESSION['teacher_firstname'];
$teacher_id=$_SESSION['teacher_id'];
$schoolyear=$_SESSION['schoolyear'];




$subid=$_GET['subject_id'];
$getsection_id=$_GET['section_id'];
$sql_list="SELECT u.*, es.* FROM users u, enrolled_subject es WHERE u.student_number=es.student_number AND es.teacher_id=$teacher_id AND es.section_id='$getsection_id' AND es.subject_id='$subid' ORDER BY lastname ASC";
$result_list=mysqli_query($conn,$sql_list);

$section=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM section WHERE section_id=$getsection_id"));


$gsub=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM subject WHERE subject_id=$subid"));
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
          
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>View Sections Handle</title>
    
</head>
<body>
<?Php require_once('../includes/teachernavbar.php') ?>
<?Php require_once('uploadgradeForm.php') ?>
<div class="teacherwrapper"id="teacherwrapper">

<div class="container mt-5">

    <div class="col-sm-12" style="overflow:auto">
        <h3>ADVISORY</h3>
        <table>
<a href="sectionhandle.php">Back</a>
    <tr>
        <td colspan=8><b>List of Student - <?php echo $section['grade_year'].$section['section'].$gsub['subject']?><b>
        <button type="button" class="uploadButton"name="uploadButton"id="<?php echo $_GET['section_id']?>"onclick ="openUpload(<?php echo $_GET['section_id'] ?>)">Upload Grades</button>
        </td>
    </tr> 
    <tr>
        <td><b>Student Number<b></td>
        <td><b>NAMES<b></td>
        <td><b>First Grading<b></td>
        <td><b>Second Grading<b></td>
        <td><b>Third Grading<b></td>
        <td><b>Fourth Grading<b></td>
        <td><b>Average<b></td>
        <td><b>Remarks<b></td>

    </tr> 
<?php
    while($row=mysqli_fetch_assoc($result_list)){
        $average=($row['first_grading']+$row['second_grading']+$row['third_grading']+$row['fourth_grading'])/4;
        ?>
    <tr>
        <td><?php echo $row['student_number']?></td>
        <td width="300px"><?php echo $row['lastname'].', '.$row['firstname'].' '.$row['middlename']?></td>
        <td><?php echo $row['first_grading']?></td>
        <td><?php echo $row['second_grading']?></td>
        <td><?php echo $row['third_grading']?></td>
        <td><?php echo $row['fourth_grading']?></td>
        <td><b><?php echo $average?></b></td>
        <?php
        if($average<75 && $average!==0){
            echo '<td style="color:red">Failed</td>';
        }else if($average===0){
            echo '<td style="font-size:12px">Not yet posted</td>';
        }
        else{
            echo '<td style="color:green">Passed</td>';
        }

        ?>
    </tr>
<?php
    }

?>

</table>
    </div>


</div>

</div>
</body>
</html>