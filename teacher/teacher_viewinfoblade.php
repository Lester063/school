<?php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['teacher_id'])){
	header('Location:../login/loginpage.php');
}

$sqlget=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM teacher WHERE teacher_id=".$_SESSION['teacher_id']));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/js.js"></script>
    
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<?Php require_once('../includes/teachernavbar.php') ?>
<div class="teacherwrapper"id="teacherwrapper">
<div class="container mt-5">
    <div class="col-sm-6">
    <input type="hidden"id="teacher_id"value=<?php echo $_SESSION['teacher_id']?>>
        <table class="table">
            
            <tr>
                <td colspan=2>Information<a href="updatemyinfoBlade.php"class="bluewhiteButton text-decoration-none">Edit</a></td>
            </tr>
            <tr>
                <td>Full Name</td>
                <td><?php echo $sqlget['teacher_firstname'].' '.$sqlget['teacher_middlename'].' '.$sqlget['teacher_lastname']?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $sqlget['teacher_email']?></td>
            </tr>
            <tr>
                <td>Department</td>
                <td><?php echo $sqlget['teacher_department']?></td>
            </tr>
            <tr>
                <td>Rank</td>
                <td><?php echo $sqlget['teacher_rank']?></td>
            </tr>
            <tr>
                <td>Contact#</td>
                <td><?php echo $sqlget['teacher_contactnumber']?></td>
            </tr>
            <tr>
                <td>Schoolyear</td>
                <td><?php echo $sqlget['schoolyear']?></td>
            </tr>
        </table>

        
    </div>
</div>
</div>


</body>
</html>