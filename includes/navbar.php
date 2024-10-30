<?Php

$firstname=$_SESSION['firstname'];

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>View Sections</title>
</head>
<body>
    <div class="studentNavbar">
        <b>Welcome, <?Php echo $firstname?>!</b>
        <button type="submit"onclick="adminnav_rightSlide()"class="nav_rightSlide"id="adminnav_rightSlide"><i class="fa fa-bars" aria-hidden="true"></i></button>
    </div>

    <div class="student_sidebar"id="admin_sidebar">
        <div class="link_sidebar"id="adminlink_sidebar">
        <ul>
            <li><a href="../adminPage/adminpage.php">DASHBOARD</a></li>
            <li><a href="../studentData/viewstudent.php">VIEW STUDENTS</a></li>
            <li><a href="../teacherData/viewteacher.php">VIEW TEACHERS</a></li>
            <li><a onclick="subjectCoursenav()"style="color:#c2c2c2;cursor:pointer">SUBJECT/COURSE</a></li>
                    <ul class="hiddenLink"id="subjectCourse">
                        <li><a href="../subjects/viewsubjects.php"><b>VIEW SUBJECT</b></a></li>
                        <li><a href="../subjects/viewcourse.php"><b>VIEW COURSE</b></a></li>
                    </ul>
             <li><a href="../sectionData/viewsections.php">VIEW SECTIONS</a></li>
             <li><a href="../enrolledstudentData/viewenrolled.php">VIEW ENROLLED</a></li>
             <li><a href="../news/addnewsblade.php">ADD NEWS</a></li>
             <li><a href="../news/viewnews.php">VIEW NEWS</a></li>
             <li><a href="../adminPage/admininfo.php"><i class='fas fa-edit' style='font-size:24px'></i>PROFILE</a></li>
            </div>
            <div class="logout_sidebar"id="adminlogout_sidebar">
                <p class="logout_asuser">Logged in as an Admin</p>
                <a href="../../login/logout.php">LOGOUT</a>
            </div>
        </div>
</body>
</html>