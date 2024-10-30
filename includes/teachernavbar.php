<?Php
require_once('../includes/connect.php');
$firstname = $_SESSION['teacher_firstname'];
$teacher_id = $_SESSION['teacher_id'];

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
    <title>View Sections</title>

    <style>
        .teacherNavbar{
            width:100%;
            padding:20px;
            font-size:20px;
            color:#fff;
            background-color:#383735;
            z-index:1;
        }
        .teacherNavbar a{
            color:#fff;
            text-decoration:none;
            float:right;
            padding:0px 0px 0px 25px;
        }
    </style>
</head>
<body>
    <div class="studentNavbar">
        <b>Welcome, <?Php echo $firstname." ".$teacher_id?>!</b>
        <button type="submit"class="nav_rightSlide"id="teachernav_rightSlide"><i class="fa fa-bars" aria-hidden="true"></i></button>
    </div>

    <div class="student_sidebar"id="teacher_sidebar">
        <div class="link_sidebar"id="tlink_sidebar">
            <ul>
                <li><a href="sectionhandle.php"><b>Section Handle</b></a></li>
                <li><a href="viewadvisory.php"><b>MY ADVISORY</b></a></li>
                <li><a onclick="showhiddennavLink()"style="color:#c2c2c2;cursor:pointer"><b>PROFILE</b></a></li>
                <ul class="hiddenLink"id="hiddenLink">
                    <li><a href="teacher_viewinfoblade.php"><b>VIEW PROFILE</b></a></li>
                    <li><a href="changepasswordblade.php"><b>PASSWORD</b></a></li>
                </ul>
            </ul>
        </div>

        <div class="logout_sidebar"id="tlogout_sidebar">
            <p class="logout_asuser">Logged in as a Teacher</p>
            <a href="../login/logout.php"><b>Logout</b></a>
        </div>
    </div>
</body>
</html>