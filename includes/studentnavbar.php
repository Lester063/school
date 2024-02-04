<?Php
require_once('../includes/connect.php');
$firstname = $_SESSION['firstname'];
$year = $_SESSION['year'];
$student_id = $_SESSION['id'];
$student_number = $_SESSION['student_number'];
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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>View Sections</title>
</head>
<body>
    <div class="studentNavbar">
        <b>Welcome, <?Php echo $firstname?>!</b>
        <button type="submit"onclick="nav_rightSlide()"class="nav_rightSlide"id="nav_rightSlide"><i class="fa fa-bars" aria-hidden="true"></i></button>
    </div>

    <div class="student_sidebar"id="student_sidebar">
        <div class="link_sidebar"id="link_sidebar">
            <ul>
                <li><a href="viewenrollment.php"><b>ENROLLMENT</b></a></li>
                <li><a href="enrollmentRegistration.php"><b>MY REGISTRATION</b></a></li>
                <li> <a href="viewgrades.php"><b>GRADES</b></a></li>
                <a onclick="showhiddennavLink()"style="color:#c2c2c2;cursor:pointer"><b>PROFILE</b></a></li>
                <ul class="hiddenLink"id="hiddenLink">
                    <li><a href="viewmyprofile.php"><b>VIEW PROFILE</b></a></li>
                    <li><a href="studentpassword.php"><b>PASSWORD</b></a></li>
                </ul>
                <li> <a href="EHEHE.php"><b>EHEHE</b></a></li>
            </ul>
        </div>
        <div class="logout_sidebar"id="logout_sidebar">
            <p class="logout_asuser">Logged in as an Student</p>
            <a href="../login/logout.php"><b>Logout</b></a>
        </div>
    </div>
</body>
</html>