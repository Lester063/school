<?Php
require_once('../../includes/connect.php');
session_start();

$getSection_id=$_GET['section_id'];
$sql="SELECT t.*, ss.*,  su.* FROM teacher t, section_subject ss, subject su
WHERE ss.teacher_id=t.teacher_id AND ss.subject_id=su.subject_id AND section_id='$getSection_id'";
$resultt=mysqli_query($conn,$sql);

$section=mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM section WHERE section_id='$getSection_id'"));

$sql_adv="SELECT ad.*, se.*, te.* FROM advisers ad, section se, teacher te WHERE ad.section_id=se.section_id AND te.teacher_id=ad.adviser_id AND ad.section_id='$getSection_id'";
$res_adv=mysqli_query($conn,$sql_adv);
?>
<!DOCTYPE html>
    <html>
    <head>
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="../../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
          
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
            
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <title>View Sections</title>
        
</head>
<body>
<div class="messageTo"id="messageTo"></div>
<script>


</script>

<?Php require_once('../../includes/navbar.php') ?>
<?Php require_once('reassignedteacher.php') ?>
<div class="wrap"id="wrap">
<div class="container mt-5">
<div class="col-sm-12">
<h3>ADVISORY</h3>
            <table class="table">
                <tr>
                    <th colspan=4><?php echo $section['grade_year'].$section['section'].' '.$section['schoolyear'].' '?>ADVISER</th>
                </tr>
                <tr>
                    <td><b>#</b></td>
                    <td><b>Adviser</b></td>
                    <td><b>Department</b></td>
                    <td><b>Reassigned</b></td>
                </tr>
                <?php
                $c=0;
                while($advRow=mysqli_fetch_assoc($res_adv)){
                $c++;
                
                ?>
                <tr>
                    <td><?php echo $c?></td>
                    <td><?php echo $advRow['teacher_lastname'].', '.$advRow['teacher_firstname'].' '.$advRow['teacher_middlename']?></td>
                    <td><?php echo $advRow['teacher_department']?></td>
                    <td><button type="button" class="editsectionbutton"name="editbuttonsection"id="<?php echo $advRow['section_id'];?>" onclick = "reAdviser(<?php echo $advRow['section_id']; ?>);">Re-assigned</button></td> 
                </tr>
                <?php
                }
                ?>
            </table>



            <table class="table">
                <tr>
                    <th colspan=5><?php echo $section['grade_year'].$section['section'].' '.$section['schoolyear'].' '?>ASSIGNED TEACHERS</th>
                </tr>
                <tr>
                    <td><b>#</b></td>
                    <td><b>Teacher</b></td>
                    <td><b>Subject</b></td>
                    <td><b>Description</b></td>
                    <td><b>Re-Assigned</b></td>
                </tr>
                <?php
                    $count=0;
                    while($row=mysqli_fetch_assoc($resultt)){
                        $count++;
                ?>
                <tr id="<?php echo $row['section_subjectId']?>">
                    <td><?php echo $count?></td>
                    <td><?php echo $row['teacher_lastname'].', '.$row['teacher_firstname'].' '.$row['teacher_middlename']?></td>
                    <td><?php echo $row['subject']?></td>
                    <td><?php echo $row['description']?></td>
                    <td><button type="button" class="editsectionbutton"name="editbuttonsection"id="<?php echo $row['section_subjectId'];?>" onclick = "reAssigned(<?php echo $row['section_subjectId']; ?>);">Re-assigned</button></td> 
                
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