<?Php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['teacher_id'])) {
	header('Location:../login/loginpage.php');
}
$teacher_firstname = $_SESSION['teacher_firstname'];
$teacher_id = $_SESSION['teacher_id'];

$ssy = $_SESSION['schoolyear'];

$section_handle = "SELECT su.*,ss.*, s.* FROM subject su, section_subject ss, section s
WHERE su.subject_id = ss.subject_id AND s.section_id = ss.section_id AND ss.teacher_id = '$teacher_id' ORDER BY s.schoolyear DESC, s.grade_year DESC, s.section ASC";
$result_handle = mysqli_query($conn, $section_handle);
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
    <div class="teacherwrapper"id="teacherwrapper">
        <div class="container mt-5">
            <div class="col-sm-12">
                <h3>SECTION HANDLE</h3>
                <table>
                    <tr>
                        <td><b>#<b></td>
                        <td><b>Section Handle<b></td>
                        <td><b>School Year</b></td>
                        <td><b>Subject</b></td>
                        <td><b>View</b></td>
                    </tr> 
                    <?Php
                    $count=0;
                    while($section_handle = mysqli_fetch_assoc($result_handle)) {
                        if($section_handle['teacher_id'] == $teacher_id) {
                            $count+=1;
                    ?>
                    <tr>
                        <td><?php echo $count?></td>

                        <td><?Php echo $section_handle['subject']?></td>
                        <td><?Php echo $section_handle['schoolyear']?></td>
                        <td><?Php echo $section_handle['section_course'].$section_handle['yearsection']?></td>
                        <td><a href="sectionhandlestudentblade.php?section_id=<?php echo $section_handle['section_id']?>&subject_id=<?php echo $section_handle['subject_id']?>">View</a></td>
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