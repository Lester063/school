<?Php
require_once('../../includes/connect.php');
$admin = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM admin where admin_id=1"));
$adminsy = $admin['schoolyear'];

if(isset($_POST['action']) == "search_please"){
    $selectedStatus = $_POST['selectedStatus'];
    $data = "SELECT s.* , u.*, e.* FROM section s, users u, enrollment e
    WHERE s.section_id = e.section_id  AND u.id = e.student_id AND enrollment_status = '$selectedStatus' AND e.schoolyear = '$adminsy' ORDER BY e.schoolyear DESC";
    $resultData = mysqli_query($conn, $data);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
				
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <title>Document</title>
</head>
<body>
    <table class="table"id="myTable">
        <tr style="background-color:#349beb;font-size:30px">
            <td>FULLNAME</td>
            <td>Schoolyear</td>
            <td>Yearsection</td>
            <td>View</td>
            <td>Status</td>
        </tr>
        <?Php
        while($row=mysqli_fetch_array($resultData)) //for the first query
            {
                $sec=$row['section_id'];
                $enrollment_id=$row['enrollment_id'];
                $sql_ifApproved=mysqli_query($conn, "SELECT * FROM enrolled_subject WHERE enrollment_id=$enrollment_id");
                $sql_ifAssigned=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM section WHERE section_id=$sec"));
        ?>

        <tr id="<?php echo $row['enrollment_id']?>">
            <td style="width:400px;"><?php echo $row['lastname'].', '.$row['firstname'].' '.$row['middlename']?></td>
            <td style="width:100px;"><?php echo $row['schoolyear']?></td>
            <td style="width:100px;"><?php echo $row['section_course'].$row['yearsection']?></td>
            <td style="width:100px;">
                <a href="viewstudent_enrolledsubject.php?student_number=<?php echo $row['student_number']?>&&schoolyear=<?php echo $row['schoolyear']?>">
                    ADD/DROP
                </a>
            </td>
            <?php
                $adv = "SELECT * FROM section_subject WHERE section_id = $sec";
                $resAdv = mysqli_query($conn, $adv);
                if($sql_ifAssigned['assign_status'] == "ASSIGNED" && mysqli_num_rows($sql_ifApproved) <= 0) {
            ?>
                <td style="width:100px;">
                    <button type="submit" class="approved"name="approved"value="APPROVED"id="<?php echo $row['enrollment_id'];?>" 
                    onclick = "confirm('are you sure?') && approved(<?php echo $row['enrollment_id']; ?>);"><?Php echo $row['enrollment_status']?></button>
                </td>
            <?php
                }
                else if(mysqli_num_rows($sql_ifApproved) > 0) {
            ?>
                <td style="width:100px;">
                    <button disabled type="submit" class="approved"name="approved"value="APPROVED"id="<?php echo $row['enrollment_id'];?>" 
                    onclick = "confirm('are you sure?') && approved(<?php echo $row['enrollment_id']; ?>);"><i class="fa fa-ban" aria-hidden="true"style="color:red"></i><?Php echo $row['enrollment_status']?>
                    </button>
                </td>
            <?php      
                }
                else {
            ?>
                <td style="width:100px;"><button type="submit" class="approved"><i class="fa fa-ban" aria-hidden="true"style="color:red"></i>Assign</button></td>
            <?php
                }
            ?>
        </tr>
        <?php
        }
        ?>  
    </table>
</body>
</html>