
<?php
require_once('../../includes/connect.php');

$sql = "SELECT * FROM teacher";
$sqlnewteacher = mysqli_query($conn, $sql);

$sqll = "SELECT * FROM teacher";
$sqlnewteacherr = mysqli_query($conn,$sqll);
?>
<html>
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../../css/styles.css">
    <script src="../../js/js.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>     
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>EDIT User</title>
</head>
<body>
    <script>
        $(document).on('click','.closebutton-addstudent',function(){
            document.getElementById('reassignedTeacher').style.display="none";
            window.location="assignteacher_newversion.php?section_id=<?php echo $_GET['section_id']?>";
        })
    </script>

<!-- reassign teachers -->
    <div class="reassignedTeacher"id="reassignedTeacher">
        <a href="javascript:void(0)"class="closebutton-addstudent">&times;</a>
        <div class="error"><b id="error"></b></div>

        <div class="addstudent-box">
            <form id="new_reassignteacher"name="updatesectionForm"method="POST"class="updatesectionForm">
                <table class="addData-table">
                    <td><b id="section"></b></td>
                    <input type="hidden" name="reassign_id"id="reassign_id"required="">
                    <input type="hidden" name="section_id"id="section_id"required="">
                    <input type="hidden" name="teacher_id"id="teacher_id"required="">

                    <tr>
                        <td><label>Assign New Teacher</label></td>
                        <td>
                            <select name="new_teacher"id="new_teacher"required="">
                                <option value="no_select">SELECT</option>
                                <?php while($row=mysqli_fetch_array($sqlnewteacher)){?>
                                <option value="<?php echo $row['teacher_id']?>"><?php echo "ID:".$row['teacher_id']." ".$row['teacher_firstname'].' '.$row['teacher_lastname']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <button type="submit" name="submit-reassignedTeacher"class="bluewhiteButton submit-reassignedTeacher"id="submit-reassignedTeacher"onclick="submit_reassignTeacher()">UPDATE</button>
            </form>
        </div>
    </div>

    <!-- reassign adviser -->
    <div class="reassignedTeacher"id="reassignedAdviser">
        <a href="javascript:void(0)"class="closebutton-addstudent"onclick="closebutton_editviews('editsection')">&times;</a>
        <div class="addstudent-box">
            <form id="reassignedAdviser"name="updatesectionForm"method="POST"class="updatesectionForm">
                <table class="addData-table">
                    <tr>
                        <td><b>REASSIGNED ADVISER</b></td>
                        <input type="hidden" id="advsy">
                    </tr>
                    <input type="hidden"name="adviser_section_id"id="adviser_section_id"required="">

                    <tr>
                        <td><label>Assign New Adviser</label></td>
                        <td><select name="new_adviser"id="new_adviser"required="">
                                <option value="no_select">SELECT</option>
                                <?php while($rowd=mysqli_fetch_array($sqlnewteacherr)){?>
                                <option value="<?php echo $rowd['teacher_id']?>"><?php echo "ID:".$rowd['teacher_id']." ".$rowd['teacher_firstname'].' '.$rowd['teacher_lastname']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <button type="submit" name="submit-reassignedTeacher"class="bluewhiteButton submit-reassignedTeacher"id="submit-reassignedAdviser">UPDATE</button>
            </form>
        </div>
    </div>
</body>
</html>
