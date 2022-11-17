<?Php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['teacher_id'])){
	header('Location:../login/loginpage.php');
}

$teacher_firstname=$_SESSION['teacher_firstname'];
$teacher_id=$_SESSION['teacher_id'];
$schoolyear=$_SESSION['schoolyear'];


$sql_advisory="SELECT * FROM advisers WHERE adviser_id='$teacher_id' ORDER BY schoolyear_assign DESC";
$result_advisory = mysqli_query($conn, $sql_advisory);


$getSchoolyear=$_GET['schoolyear_assign'];
$sql_list="SELECT u.*, en.*,ad.* FROM users u, enrollment en, advisers ad WHERE ad.section_id=en.section_id AND u.student_number=en.student_number AND ad.adviser_id =$teacher_id AND en.schoolyear='$getSchoolyear' ORDER BY lastname";
$result_list=mysqli_query($conn,$sql_list);

$advisorysection=mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM advisers WHERE adviser_id=$teacher_id AND schoolyear_assign='$getSchoolyear'"));

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
    <title>View List</title>
    
</head>
<body>
<?Php require_once('../includes/teachernavbar.php') ?>
<?Php require_once('uploadgradeForm.php') ?>
<div class="teacherwrapper"id="teacherwrapper">
    <?php echo $advisorysection['yearsection_assign']?>
<div class="container mt-5">

    <div class="col-sm-12">
        <h3>ADVISORY</h3>
        <table>
            <tr>
                <th colspan=3 class="ddd"><b>Student Info<b></th>
            </tr> 
            <tr>
                <th>#</th>
                <td><b>SN<b></td>
                <td style="width:500px;"><b>NAME<b></td>
            </tr> 
                
            <?php 
                $c=0;
                while($row=mysqli_fetch_assoc($result_list)){
                    $c++;
            ?>
            <tr>
                <td><?php echo $c?>
                <td><?php echo $row['student_number']?></td>
                <td><?php echo $row['lastname'].', '.$row['firstname'].' '.$row['middlename']?></td>
            </tr>

            <?php
                }
            ?>
        </table>
    </div>


</div>
</div>
</body>
</html>