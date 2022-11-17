<?Php
require_once('../../includes/connect.php');
session_start();

if(!isset($_SESSION['firstname'])){
	header('Location:login.php');
}
//get data from admin to filter the list just this schoolyear
$admin=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM admin where admin_id=1"));
$adminsy=$admin['schoolyear'];

$student_number=$_GET['student_number'];
$student_schoolyear=$_GET['schoolyear'];

$getstudent=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM users WHERE student_number='$student_number'"));
$fullname=$getstudent['lastname'].', '.$getstudent['firstname'].' '.$getstudent['middlename'];

$getStudentEnrolled="SELECT es.*, sub.*,sec.* FROM enrolled_subject es, subject sub, section sec WHERE sec.section_id=es.section_id AND es.subject_id=sub.subject_id AND student_number='$student_number' AND es.schoolyear='$student_schoolyear'";
$result_getStudentEnrolled=mysqli_query($conn,$getStudentEnrolled);

$get_drop_data="SELECT ad.*, sub.*,sec.* FROM add_drop_subject ad, subject sub,section sec WHERE ad.subject_id=sub.subject_id AND ad.section_id=sec.section_id AND student_number='$student_number' AND ad.schoolyear='$student_schoolyear'";
$result_get_drop_data=mysqli_query($conn,$get_drop_data);

//get the enrollment_id
$getstudent_enId=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM enrollment WHERE student_number='$student_number' AND schoolyear='$student_schoolyear'"));
$student_eId=$getstudent_enId['enrollment_id'];

$getAll_subject="SELECT ss.*, sub.*, sec.*, t.* FROM section_subject ss, subject sub, section sec, teacher t WHERE ss.teacher_id=t.teacher_id AND ss.subject_id=sub.subject_id AND ss.section_id=sec.section_id AND sec.schoolyear='$student_schoolyear' ORDER BY section_subjectId ASC";
$result_getAll_subject=mysqli_query($conn,$getAll_subject);
?>
<html>
<head>
	<link rel="stylesheet" href="../../css/styles.css">
	<script src="../../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
	<title>View Enrolled</title>

</head>
<body>
<div class="messageTo"id="messageTo"></div>
<script>


</script>
<?Php require_once('../../includes/navbar.php') ?>
<div class="wrap"id="wrap">
<div class="container mt-5">
    <div class="col-sm-12"id="myDIV">
        <h3>Name: <?php echo $fullname?></h3>
        <h3>SY  :<?php echo $student_schoolyear?></h3>
        <h3>EID  :<?php echo $student_eId?></h3>
        <h5 class="mt-5">SUBJECT:</h5>
        <table class="table">
            <tr>
                <td>Enrolled Subject ID</td>
                <td>Subject ID</td>
                <td>Class Code</td>
                <td>Subject</td>
                <td>Action</td>
            </tr>
            <?php
            while($row=mysqli_fetch_array($result_getStudentEnrolled)){
            ?>
            <tr id="<?php echo $row['enrolled_subject_id']?>">
                <td><?php echo $row['enrolled_subject_id']?></td>
                <td><?php echo $row['subject_id']?></td>
                <td><?php echo $row['section_course'].$row['yearsection'].$row['subject']?></td>
                <td><?php echo $row['subject']?></td>
                <td><button onclick="confirm('are you sure?') && dropSubject(<?php echo $row['enrolled_subject_id']?>)"class="redblackButton">DROPPED</button></td>
            </tr>
            <?php
            }
            ?>
        </table>

        <h5 class="mt-5">DROPPED:</h5>
        <table class="table">
            <tr>
                <td>Enrolled Subject ID</td>
                <td>Subject ID</td>
                <td>Class Code</td>
                <td>Subject</td>
                <td>Action</td>
            </tr>
            <?php
            while($drop_row=mysqli_fetch_array($result_get_drop_data)){
            ?>
            <tr id="<?php echo $drop_row['enrolled_subject_id']?>">
                <td><?php echo $drop_row['enrolled_subject_id']?></td>
                <td><?php echo $drop_row['subject_id']?></td>
                <td><?php echo $drop_row['section_course'].$drop_row['yearsection'].$drop_row['subject']?></td>
                <td><?php echo $drop_row['subject']?></td>
                <td><button onclick="confirm('are you sure?') && addAgain_subject(<?php echo $drop_row['enrolled_subject_id']?>)"class="bluewhiteButton">ADD AGAIN</button></td>
            </tr>
            <?php
            }
            ?>
        </table>

        <h5 class="mt-5">ADD SUBJECT</h5>
        <input type="hidden"id="student_number"value="<?php echo $student_number?>">
        <input type="hidden"id="student_schoolyear"value="<?php echo $student_schoolyear?>">
        <input type="hidden"id="student_eId"value="<?php echo $student_eId?>">
        <table class="table">
            <tr>
                <td>Section Subject ID</td>
                <td>Section ID</td>
                <td>Class Code</td>
                <td>Subject ID</td>
                <td>Subject</td>
                <td>Teacher ID</td>
                <td>Action</td>
            </tr>
            <?php
            while($row_subject=mysqli_fetch_array($result_getAll_subject)){
            ?>
            
            <tr>
                <td><?php echo $row_subject['section_subjectId']?></td>
                <td><?php echo $row_subject['section_id']?></td>
                <td><?php echo $row_subject['section_course'].$row_subject['yearsection'].$row_subject['subject']?></td>
                <td><?php echo $row_subject['subject_id']?></td>
                <td><?php echo $row_subject['subject']?></td>
                <td><?php echo $row_subject['teacher_id']?></td>
                <td><button onclick="confirm('Are you sure?') && adddrop_addSubject(<?php echo $row_subject['section_subjectId']?>)"class="bluewhiteButton">Add</button></td>
            </tr>
            
            <?php
            }
            ?>
        </table>
 

	</div>
</div>
</div>

<script>

</script>

</body>
</html>