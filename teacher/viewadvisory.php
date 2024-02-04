<?Php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['teacher_id'])) {
	header('Location:../login/loginpage.php');
}
$teacher_firstname = $_SESSION['teacher_firstname'];
$teacher_id = $_SESSION['teacher_id'];
$schoolyear = $_SESSION['schoolyear'];

$sql_advisory = "SELECT ad.*, sec.* FROM advisers ad, section sec WHERE ad.section_id = sec.section_id AND adviser_id = '$teacher_id' ORDER BY schoolyear_assign DESC";
$result_advisory = mysqli_query($conn, $sql_advisory);

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
    <title>View Sections</title>
</head>
<body>
    <?Php require_once('../includes/teachernavbar.php') ?>
    <?Php require_once('uploadgradeForm.php') ?>
    <div class="teacherwrapper"id="teacherwrapper">
        <div class="container mt-5">
            <div class="col-sm-12">
                <h3>ADVISORY</h3>
                <table>
                    <tr>
                        <td><b>Advisory Section<b></td>
                        <td><b>School Year</b></td>
                        <td><b>View</b></td>
                    </tr> 
                    <?Php
                    while($section_advisory = mysqli_fetch_assoc($result_advisory)) {
                        $section_id = $section_advisory['section_id'];
                        $schoolyear_assign = $section_advisory['schoolyear_assign'];
                        if($section_advisory['adviser_id'] == $teacher_id) {  
                    ?>
                    <tr>
                        <td style="width:300px;"><?Php echo $section_advisory['section_course'].$section_advisory['yearsection_assign']?></td>
                        <td><?Php echo $section_advisory['schoolyear_assign']?></td>
                        <td><a href="viewList.php?schoolyear_assign=<?php echo $section_advisory['schoolyear_assign']?>">View</a></td>
                    </tr>   
                    <?Php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>
</html>