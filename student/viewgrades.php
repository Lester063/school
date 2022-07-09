<?Php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['id'])){
	header('Location:../login/loginpage.php');
}
$firstname=$_SESSION['firstname'];
$middlename=$_SESSION['middlename'];
$lastname=$_SESSION['lastname'];
$year=$_SESSION['year'];
$student_id=$_SESSION['id'];
$student_number=$_SESSION['student_number'];


$enrollment_status = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM enrollment WHERE student_id = $student_id"));


$enrollment="SELECT * FROM enrollment WHERE student_id=$student_id";

$enrolled = "SELECT * FROM enrollment WHERE student_id = $student_id";
$enrolled_result= mysqli_query($conn, $enrolled);



$sql_en="SELECT en.*, s.* FROM enrollment en, section s WHERE en.section_id=s.section_id AND student_id='$student_id'";
$res_en=mysqli_query($conn,$sql_en);
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
          
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>View Grades</title>
    
</head>
<body>
<?Php require_once('../includes/loadingpage.php') ?>
<?Php require_once('../includes/studentnavbar.php') ?>
<div class="studentwrapper"id="studentwrapper">

<div class="container mt-5">
    <h3>VIEW GRADES</h3>
            <div class="col-sm-12">
                
<?php
if(mysqli_num_rows($res_en)<0){
?>
<h2>No Grades to View</h2>

<?php
}else if(mysqli_num_rows($res_en)>0){
    $arr=[];
    while($enrolled = mysqli_fetch_assoc($res_en)){
        $enid=$enrolled['enrollment_id'];


    ?>
    <div class="allRegistration-box"id="allRegistration-box">
        <div class="syTitle"onclick="asd(<?php echo $enrolled['enrollment_id']?>)"><b><?php echo $enrolled['section_course'].$enrolled['yearsection']." SY:". $enrolled['schoolyear']?></b></div>
        <div id="yourBox_<?php echo $enrolled['enrollment_id']?>">
        <table class="<?php echo $enrolled['enrollment_id']?> allRegistration"id="<?php echo $enrolled['enrollment_id']?>">
    
            <tr>
                <td><b>Subject</b></td>
                <td><b>Class Code</b></td>
                <td><b>Description</b></td>
                <td><b>First Grading</b></td>
                <td><b>Second Grading</b></td>
                <td><b>Third Grading</b></td>
                <td><b>Fourth Grading</b></td>
                <td><b>Average</b></td>
                <td><b>Remarks</b></td>
            </tr>
            <?php
            $ss_data=mysqli_query($conn, "SELECT ens.*, sub.*, en.*,t.*,sec.* FROM enrolled_subject ens, subject sub, enrollment en, teacher t,section sec WHERE ens.section_id=sec.section_id AND ens.subject_id=sub.subject_id AND ens.enrollment_id=en.enrollment_id AND ens.teacher_id=t.teacher_id AND ens.enrollment_id=$enid");
            $arr=mysqli_fetch_array($ss_data);
            foreach($ss_data as $se_student){
                $average=($se_student['first_grading']+$se_student['second_grading']+$se_student['third_grading']+$se_student['fourth_grading'])/4;
            ?>
            <tr>
                <td><?php echo $se_student['subject']?></td>
                <td><?php echo $se_student['section_course'].$se_student['yearsection'].strtoupper($se_student['subject'])?></td>
                <td><?php echo $se_student['description']?></td>
                <td><?php echo $se_student['first_grading']?></td>
                <td><?php echo $se_student['second_grading']?></td>
                <td><?php echo $se_student['third_grading']?></td>
                <td><?php echo $se_student['fourth_grading']?></td>
                <td><b><?php echo $average?></b></td>
                <?php
                if($average>=75){
                    echo "<td><b style='color:green'>Passed</b></td>";
                }else if($average<75 && $average!==0){
                    echo "<td><b style='color:red'>Failed</b></td>";
                }else{
                    echo "<td><b>Not yet posted</b></td>";
                }
                ?>
            </tr>
            <?php
            }
            ?>


        </table>
    </div>
</div>
 <?php   
}}?>
            </div>


    </div>



</div>

</script>
</body>
</html>