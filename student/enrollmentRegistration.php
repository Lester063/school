<?Php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['id'])) {
	header('Location:../login/loginpage.php');
}
$firstname = $_SESSION['firstname'];
$middlename = $_SESSION['middlename'];
$lastname = $_SESSION['lastname'];
$year = $_SESSION['year'];
$student_id = $_SESSION['id'];
$student_number = $_SESSION['student_number'];

$enrollment_status = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM enrollment WHERE student_id = $student_id"));

$enrollment = "SELECT * FROM enrollment WHERE student_id = $student_id";

$enrolled = "SELECT * FROM enrollment WHERE student_id = $student_id";
$enrolled_result= mysqli_query($conn, $enrolled);

$sql_en = "SELECT en.*, s.* FROM enrollment en, section s WHERE en.section_id=s.section_id AND student_id='$student_id'";
$res_en = mysqli_query($conn, $sql_en);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel = "stylesheet" href = "../css/styles.css">
    <script src = "../js/js.js"></script>
    <script src = "http://code.jquery.com/jquery-1.9.1.min.js"></script>    
    <link href = "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel = "stylesheet"/>     
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel = "stylesheet">
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>View Registrations</title>
</head>
<body>
    <?Php require_once('../includes/loadingpage.php') ?>
    <?Php require_once('../includes/studentnavbar.php') ?>
    <div class = "studentwrapper"id = "studentwrapper">
        <div class = "container mt-5">
            <h3>VIEW REGISTRATIONS</h3>
            <div class = "col-sm-12">
            <?php
            date_default_timezone_set('Asia/Manila');
            $current=date('Y-m-d h:i:s');
            $date = mysqli_fetch_assoc(mysqli_query($conn, "SELECT start_date, end_date FROM section WHERE yearsection = $year"));
            if(mysqli_num_rows($res_en)<0) {
            ?>
            <?php
            }
            else if(mysqli_num_rows($res_en)>0) {
                $arr=[];
                while($enrolled = mysqli_fetch_assoc($res_en)) {
                    $enid = $enrolled['enrollment_id'];
            ?>
            <div class = "allRegistration-box"id = "allRegistration-box">
                <div class = "syTitle"onclick = "asd(<?php echo $enrolled['enrollment_id']?>)"><b><?php echo $enrolled['section_course'].$enrolled['yearsection']." SY:". $enrolled['schoolyear']?></b></div>
                <div id = "yourBox_<?php echo $enrolled['enrollment_id']?>">
                <table class = "<?php echo $enrolled['enrollment_id']?> allRegistration"id = "<?php echo $enrolled['enrollment_id']?>">
                    <tr>
                        <td><b>Subject</b></td>
                        <td><b>Class Code</b></td>
                        <td><b>Description</b></td>
                        <td><b>Teacher</b></td>
                    </tr>
                    <?php
                    $ss_data = mysqli_query($conn, "SELECT ens.*, sub.*, en.*,t.*,sec.* FROM enrolled_subject ens, subject sub, enrollment en, teacher t,section sec WHERE ens.section_id=sec.section_id AND ens.subject_id=sub.subject_id AND ens.enrollment_id=en.enrollment_id AND ens.teacher_id=t.teacher_id AND ens.enrollment_id = $enid");
                    $arr = mysqli_fetch_array($ss_data);
                    foreach($ss_data as $se_registration) {
                    ?>

                    <tr>
                        <td><?php echo $se_registration['subject']?></td>
                        <td><?php echo $se_registration['section_course'].$se_registration['yearsection'].strtoupper($se_registration['subject'])?></td>
                        <td><?php echo $se_registration['description']?></td>
                        <td><?php echo $se_registration['teacher_firstname'].' '.$se_registration['teacher_lastname']?></td>
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
</body>
</html>