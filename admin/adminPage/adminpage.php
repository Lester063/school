<?Php
require_once('../../includes/connect.php');
session_start();
if(!isset($_SESSION['firstname'])){
	header('Location:../../login/loginpage.php');
}
$sql_user="SELECT * FROM `users`";
$result_user=mysqli_query($conn,$sql_user);

$sql_teacher="SELECT * FROM `teacher`";
$result_teacher=mysqli_query($conn,$sql_teacher);

$sql_section="SELECT * FROM `section` ORDER BY yearsection AND schoolyear ASC";
$result_section=mysqli_query($conn,$sql_section);

$sql_enrollment="SELECT * FROM `enrollment`";
$result_enrollment=mysqli_query($conn,$sql_enrollment);

$name=$_SESSION['firstname'];
$schoolyear=$_SESSION['schoolyear'];

$news=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM news"));

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="../../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <?Php require_once('../../includes/navbar.php') ?>

    <div class="wrap"id="wrap">
        <div class="container mt-5">
            <h1>Schoolyear: <?php echo $schoolyear?></h1>
            <!-- count students -->
            <div class="userBox"style="background-color:#111e6c">
                <?php
                $userCount = mysqli_num_rows(mysqli_query($conn,
                "SELECT * FROM users WHERE schoolyear='$schoolyear'"));

                $firstyearCount = mysqli_num_rows(mysqli_query($conn,
                "SELECT * FROM users WHERE year = '11' AND schoolyear = '$schoolyear'"));

                $secondyearCount = mysqli_num_rows(mysqli_query($conn,
                "SELECT * FROM users WHERE year = '12' AND schoolyear = '$schoolyear'"));

                $thirdyearCount = mysqli_num_rows(mysqli_query($conn,
                "SELECT * FROM users WHERE year = '3' AND schoolyear = '$schoolyear'"));

                $fourthyearCount = mysqli_num_rows(mysqli_query($conn,
                "SELECT * FROM users WHERE year = '4' AND schoolyear = '$schoolyear'"));
                ?>
                <b><?php echo 'Students: '.$userCount?></b><br>
                <hr>
                <b><?php echo 'First Year: '.$firstyearCount?></b><br>
                <b><?php echo 'Second Year: '.$secondyearCount?></b><br>
            </div>


        <div class="userBox"style="background-color:#1d2951">
            <?php
            $teacherCount = mysqli_num_rows(mysqli_query($conn,
            "SELECT * FROM teacher WHERE schoolyear = '$schoolyear'"));

            $mathDepartment = mysqli_num_rows(mysqli_query($conn,
            "SELECT * FROM teacher WHERE teacher_department = 'Math' AND schoolyear = '$schoolyear'"));

            $filipinoDepartment = mysqli_num_rows(mysqli_query($conn,
            "SELECT * FROM teacher WHERE teacher_department = 'Filipino' AND schoolyear = '$schoolyear'"));

            $scienceDepartment = mysqli_num_rows(mysqli_query($conn,
            "SELECT * FROM teacher WHERE teacher_department = 'Science' AND schoolyear = '$schoolyear'"));

            $apDepartment = mysqli_num_rows(mysqli_query($conn,
            "SELECT * FROM teacher WHERE teacher_department = 'AP' AND schoolyear = '$schoolyear'"));

            $englishDepartment = mysqli_num_rows(mysqli_query($conn,
            "SELECT * FROM teacher WHERE teacher_department = 'English' AND schoolyear = '$schoolyear'"));
            ?>
            <b><?php echo 'Teachers: '.$teacherCount?></b><br>
            <hr>
            <b><?php echo 'Math: '.$mathDepartment?></b><br>
            <b><?php echo 'Filipino: '.$filipinoDepartment?></b><br>
            <b><?php echo 'Science: '.$scienceDepartment?></b><br>
            <b><?php echo 'AP: '.$apDepartment?></b><br>
            <b><?php echo 'English: '.$englishDepartment?></b><br>
        </div>



        <div class="userBox"style="background-color:#003152">
            <?php
            $sections = mysqli_num_rows(mysqli_query($conn,
            "SELECT * FROM section WHERE schoolyear = '$schoolyear'"));
            
            ?>
            <b>Ongoing Sections</b><br>
            <b><?php echo 'Section: '.$sections?></b><br>
        </div>



        <div class="userBox"style="background-color:#0e4d92">
            <?php
            $enrollmentPending = mysqli_num_rows(mysqli_query($conn,
            "SELECT * FROM enrollment WHERE enrollment_status = 'PENDING' AND schoolyear = '$schoolyear'"));
            $enrollmentApproved = mysqli_num_rows(mysqli_query($conn,
            "SELECT * FROM enrollment WHERE enrollment_status = 'APPROVED' AND schoolyear = '$schoolyear'"));
            ?>
            <b>Enrolled Student</b>
            <b><?php echo 'APPROVED: '.$enrollmentApproved?></b><br>
            <b><?php echo 'PENDING: '.$enrollmentPending?></b><br>
        </div>

        <div class="userBox"style="background-color:#0e4d92">
            <?php
                $news = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM news"));
            ?>
            <b>NEWS</b>
            <b><?php echo $news?></b><br>
        </div>

        <div class="userBox"style="background-color:#008ecc">
            <?php
            $courses = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM courses"));
            ?>
            <b>Available Courses</b><br>
            <b><?php echo $courses?></b><br>
        </div>

        <div class="userBox"style="background-color:#008081">
            <?php
            $subjects = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM subject"));
            ?>
            <b>Subjects</b>
            <b><?php echo $subjects?></b><br>
        </div>

        


        </div>
    </div>

</body>

</html>