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
$schoolyear = $_SESSION['schoolyear'];
$email = $_SESSION['email'];
$student_number = $_SESSION['student_number'];

$myCourse = $_SESSION['course'];

$sql_section = "SELECT * FROM section WHERE grade_year = $year and schoolyear = '$schoolyear'AND section_course = '$myCourse' ORDER BY section ASC";
$result_section = mysqli_query($conn, $sql_section);
$rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM section WHERE grade_year = $year and schoolyear = '$schoolyear'"));
$enrollment_status =mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM enrollment WHERE student_id = $student_id AND schoolyear = '$schoolyear'"));

$section_time = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM section WHERE grade_year = $year"));

$enrolled = "SELECT * FROM enrollment WHERE student_id = '$student_id' AND schoolyear = '$schoolyear'";
$enrolled_result= mysqli_query($conn, $enrolled);

$section_sy = "SELECT * FROM section WHERE grade_year = $year and schoolyear = '$schoolyear' AND section_course = '$myCourse'";
$result_section_sy = mysqli_query($conn,$section_sy);

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
    <title>View Sections</title>
</head>
<body>
    <div class = "messageTo"id = "messageTo"></div>
    <?Php require_once('../includes/loadingpage.php') ?>
    <?Php require_once('../includes/studentnavbar.php') ?>
    <div class = "studentwrapper"id = "studentwrapper">
        <div class = "container mt-5">
            <h3>ENROLLMENT</h3>
            <div class = "col-sm-12">
                <b id = "enrollment-message"></b>
                <form id = "enrollmentForm"name = "enrollmentForm" method = "POST">
                    <input type = "hidden"id = "fullname"name = "fullname"value = "<?Php echo $firstname." "."$middlename"." ".$lastname?>">
                    <input type = "hidden" id = "email"name = "email"value = "<?Php echo $email?>">
                    <input type = "hidden" id = "student_id"name = "student_id"value = "<?Php echo $student_id?>">
                    <input type = "hidden" id = "enrollment_status"name = "enrollment_status"value = "PENDING">
                    <input type = "hidden" id = "student_number"name = "student_number"value = "<?php echo $student_number?>">
                    <input type = "hidden" id = "action"name = "action"value = "action_enrollStudent">
                    <?php
                    $projects=array();
                    date_default_timezone_set('Asia/Manila');
                    $current=date('Y-m-d H:i:s');
                    echo $current;
                    if(mysqli_num_rows($result_section_sy) >= 1) {
                        if(mysqli_num_rows($enrolled_result) <= 0) {
                            while($rowsection = mysqli_fetch_assoc($result_section)) {
                                $sec = $rowsection['section_id'];
                                $start = $rowsection['start_date'];
                                $end= $rowsection['end_date'];
                                if($current >= $start AND $current <= $end AND $rowsection['section_status'] == 'ONGOING') {
                    ?>
                    <table class = "sectiontable-enrollment"id = "sectiontable-enrollment">
                        <tr>
                            <th colspan=2><input type = "hidden"id = "schoolyear"name = "schoolyear"value = "<?Php echo $rowsection['schoolyear']?>"><?Php echo "SY:". $rowsection['schoolyear']?></th>
                        </tr>

                        <tr>
                            <td colspan=2><input type = "radio"id = "section_id"name = "section_id"value = "<?Php echo $rowsection['section_id']?>"><?Php echo $rowsection['section_course'].$rowsection['grade_year'].$rowsection['section']?></td>
                        </tr>

                        <tr>
                            <td colspan=2><b name = "student_qty"value = "<?Php echo $rowsection['student_qty']?>"><?Php echo $rowsection['student_qty']?></b>/<b name = "max_qty"value = "<?Php echo $rowsection['max_qty']?>"><?Php echo $rowsection['max_qty']?></b></td>
                        </tr>

                        <tr>
                            <td><b>Subject</b></td>
                            <td><b>Course Description</b></td>
                        <?php 
                        $sqlss = "SELECT ss.*, su.* FROM section_subject ss, subject su WHERE ss.subject_id=su.subject_id AND section_id = $sec";
                        $resss=mysqli_query($conn,$sqlss);
                        while($rowss=mysqli_fetch_assoc($resss)) {
                        ?>
                        </tr>
                            <td><?Php echo $rowss['subject']?></td>
                            <td><?Php echo $rowss['description']?></td>
                        </tr>

                        <?php
                        }
                        ?>
                    </table>
                    <?php
                    }
                    }
                    $btnCount=0;
                    if($btnCount <= 1 AND $current >= $start AND $current <= $end) {
                        $btnCount++;
                    ?>
                    <button type = "submit"name = "enrollbutton" id = "enrollbutton"class = "enrollbutton"onclick = "confirm('are you sure?') && enroll()">Enroll</button>
                    <?php
                    }
                    }
                    else if(mysqli_num_rows($enrolled_result) > 0 AND $current >= $rows['start_date'] AND $current <= $rows['end_date']) {
                        echo '<h3>Congrats, '.$enrollment_status['fullname'].'. Please wait for your registration approval.</h3>';
                        echo '<b>Status: '.$enrollment_status["enrollment_status"].'</b>';
                    }
                    }

                    else{
                        echo '<p>wait for your sections.</p>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</body>
</html>