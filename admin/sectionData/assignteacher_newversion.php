<?Php
require_once('../../includes/connect.php');
session_start();

$getSection_id=$_GET['section_id'];
$data_section=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM section WHERE section_id='$getSection_id'"));
$getSchoolyear=$data_section['schoolyear'];

$section_course=$data_section['section_course'];
$yearsection=$data_section['yearsection'];

$sql_new_assign="SELECT ss.*, s.* FROM section_subject ss, subject s WHERE ss.subject_id=s.subject_id AND section_id=$getSection_id";
$result_sql_new_assign=mysqli_query($conn,$sql_new_assign);

//check if this section has already teachers
$checkSection=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM section WHERE section_id=$getSection_id"));


$if_assign="SELECT ss.*, s.*,t.* FROM section_subject ss, subject s, teacher t WHERE t.teacher_id=ss.teacher_id AND ss.subject_id=s.subject_id AND section_id=$getSection_id";
$result_if_assign=mysqli_query($conn,$if_assign);

$listTeachers=mysqli_query($conn,"SELECT * FROM teacher");

$adviser=mysqli_fetch_array(mysqli_query($conn,"SELECT ad.*, t.* FROM advisers ad, teacher t WHERE t.teacher_id=ad.adviser_id AND section_id='$getSection_id' AND schoolyear_assign='$getSchoolyear'"));
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

$(document).on('submit','#new_assignTeachers',function(e){
  e.preventDefault();
  e.disabled = true;
  
  $.ajax({
    method:"POST",
    url: "../../sql/sectiondata_sql.php",
    cache:false,
    data:$(this).serialize(),
    success:function(response){
      if(response==0){
        message('success','Teachers assigned successfully.');
        $('#new_assignTeachers').find('select').val('');
      }
      else if(response==2){
        message('delete','The adviser you selected is already assigned to other section.');
      }
      else{
        message('delete',response);
      }
      
  
    }
  });
  });
</script>

<?Php require_once('../../includes/navbar.php') ?>
<?Php require_once('reassignedteacher.php') ?>
<div class="wrap"id="wrap">
<div class="container mt-5">
<div class="col-sm-12">
    <?php
    if($checkSection['assign_status']!="ASSIGNED"){
    ?>
    <h3>ASSIGN</h3>
    <h2><?php echo $data_section['section_course'].$data_section['yearsection']?> </h2>
    <form id="new_assignTeachers"method="POST">
    <table class="table">
        <tr>
            <td>Section</td>
            <td>Assign Teacher</td>
        </tr>
        <tr>
            <td><?php echo $data_section['section_course'].$data_section['yearsection']?></td>
            <td><select name="adviser_id">
                <option value="">SELECT ADVISER</option>
                <?php
                    foreach($listTeachers as $teach){
                ?>
                <option value="<?php echo $teach['teacher_id']?>"><?php echo $teach['teacher_firstname'].' '.$teach['teacher_middlename'].' '.$teach['teacher_lastname']?></option>
                <?php
                    }
                ?>
                </select>
            </td>
        </tr>
    </table>




    <table class="table">
        <tr>
            <td>##</td>
            <td>Subject ID</td>
            <td>Subject</td>
            <td>Assign Teacher</td>
        </tr>
       
            <input type="hidden" name="action"value="action_assignTeacher">
        <input type="hidden"value=<?php echo $getSection_id?> name="section_id">
        <input type="hidden"value=<?php echo $data_section['yearsection']?> name="yearsection">
        <input type="hidden"value=<?php echo $data_section['schoolyear']?> name="schoolyear">
        <?php
        $sqlteachers=mysqli_query($conn,"SELECT * FROM teacher");
        $c=0;
        while($row_newAssign=mysqli_fetch_array($result_sql_new_assign)){
        $c++;
        ?>
        <tr>
            <td><?php echo $c ?></td>
            <td><?php echo $row_newAssign['subject_id']?></td>
            <td><?php echo $row_newAssign['subject']?></td>
            <td>
                <select name="teacher[]"required="">
                    <option value="">SELECT TEACHER</option>
                    <?php foreach($sqlteachers as $teacher){
                        ?>
                    <option value="<?php echo $teacher['teacher_id']?>"><?php echo $teacher['teacher_firstname'].' '.$teacher['teacher_middlename'].' '.$teacher['teacher_lastname']?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <button type="submit"class="bluewhiteButton"onclick="confirm('Are you sure?')">Assign</button>
    </form>
    <?php
    }else{

    
    ?>

    <h3><?php echo $section_course.$yearsection?></h3>
    <h3>Re-assign</h3>
    <table class="table">
        <tr>
            <td>Section</td>
            <td>Assign Adviser</td>
        </tr>
        <tr>
            <td><?php echo $adviser['section_id']?></td>
            <td><?php echo $adviser['teacher_lastname'].', '.$adviser['teacher_firstname'].' '.$adviser['teacher_middlename']?></td>
            <td><button type="button" class="editsectionbutton"name="editbuttonsection"id="<?php echo $getSection_id?>" onclick = "reAdviser(<?php echo $getSection_id; ?>);">Re-assigned</button></td> 
        </tr>
    </table>
    <table class="table">
        <tr>
            <td>##</td>
            <td>Subject ID</td>
            <td>Subject</td>
            <td>Assign Teacher</td>
        </tr>
        <input type="hidden"value=<?php echo $getSection_id?> name="section_id">
        <input type="hidden"value=<?php echo $data_section['yearsection']?> name="yearsection">
        <?php
        $sqlteachers=mysqli_query($conn,"SELECT * FROM teacher");
        $c=0;
        while($row_result_if_assign=mysqli_fetch_array($result_if_assign)){
        $c++;
        ?>
        <tr>
            <td><?php echo $c ?></td>
            <td><?php echo $row_result_if_assign['subject_id']?></td>
            <td><?php echo $row_result_if_assign['subject']?></td>
            <td><?php echo $row_result_if_assign['teacher_id'].': '.$row_result_if_assign['teacher_lastname'].', '.$row_result_if_assign['teacher_firstname'].' '.$row_result_if_assign['teacher_middlename']?></td>
            <td><button type="button" class="editsectionbutton"name="editbuttonsection"id="<?php echo $row['section_subjectId'];?>" onclick = "reAssigned(<?php echo $row_result_if_assign['section_subjectId']; ?>);">Re-assigned</button></td> 
        </tr>
        <?php
        }
        ?>
    </table>













    <?php
    }
    ?>
    </div>
    </div>
</div>


</body>
</html>