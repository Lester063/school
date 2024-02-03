<?php
require_once('../includes/connect.php');
if(isset($_POST['action'])) {
    if($_POST['action'] == "action_drop") {
        dropSubject();
    }
    else if($_POST['action'] == "action_addAgain") {
        addAgain_subject();
    }
    else if($_POST['action'] == "action_adddrop_addSubject") {
        adddrop_addSubject();
    }
    else if($_POST['action'] == "action_approvedPending") {
        enrollment_status();
    }

}

function dropSubject() {
    global $conn;
    $es_id = $_POST['enrolled_subject_id'];

    $enrollment_subject_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM enrolled_subject WHERE enrolled_subject_id = $es_id"));
    //data
    $enrollment_id = $enrollment_subject_data['enrollment_id'];
    $section_id = $enrollment_subject_data['section_id'];
    $teacher_id = $enrollment_subject_data['teacher_id'];
    $student_number = $enrollment_subject_data['student_number'];
    $subject_id = $enrollment_subject_data['subject_id'];
    $schoolyear = $enrollment_subject_data['schoolyear'];
    $section_subjectId = $enrollment_subject_data['section_subjectId'];

    $drop_subject = "DELETE FROM enrolled_subject WHERE enrolled_subject_id = $es_id";
    mysqli_query($conn,$drop_subject);

    $transfer = "INSERT INTO add_drop_subject (enrolled_subject_id, enrollment_id, section_id,teacher_id,student_number,subject_id,schoolyear,section_subjectId)
    VALUES('$es_id','$enrollment_id','$section_id','$teacher_id','$student_number','$subject_id','$schoolyear','$section_subjectId')";
    mysqli_query($conn,$transfer);
    echo 1;
}

function addAgain_subject() {
    global $conn;
    $es_id = $_POST['enrolled_subject_id'];

    $add_drop_data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM add_drop_subject WHERE enrolled_subject_id= $es_id"));
    //data
    $enrollment_id = $add_drop_data['enrollment_id'];
    $section_id = $add_drop_data['section_id'];
    $teacher_id = $add_drop_data['teacher_id'];
    $student_number = $add_drop_data['student_number'];
    $subject_id = $add_drop_data['subject_id'];
    $schoolyear = $add_drop_data['schoolyear'];
    $section_subjectId = $add_drop_data['section_subjectId'];

    $sql_ss_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM section_subject WHERE section_subjectId = $section_subjectId" ));
    $getsubject_id = $sql_ss_data['subject_id'];

    $check_ifnot_addedAlready = "SELECT * FROM enrolled_subject WHERE subject_id='$getsubject_id' AND student_number = '$student_number' AND schoolyear = '$schoolyear'";
    $result_check = mysqli_query($conn, $check_ifnot_addedAlready);
    if(mysqli_num_rows($result_check) > 0) {
        echo "You have added this subject already.";
    }else{
        $add_drop_Drop = "DELETE FROM add_drop_subject WHERE enrolled_subject_id = $es_id";
        mysqli_query($conn,$add_drop_Drop);

        $transfer = "INSERT INTO enrolled_subject (enrolled_subject_id, enrollment_id, section_id,teacher_id,student_number,subject_id,schoolyear,section_subjectId)
        VALUES('$es_id','$enrollment_id','$section_id','$teacher_id','$student_number','$subject_id','$schoolyear','$section_subjectId')";
        mysqli_query($conn,$transfer);
        echo 1;
    }
}

function adddrop_addSubject() {
    global $conn;
    $section_subjectId = $_POST['section_subjectId'];
    $student_number = $_POST['student_number'];
    $student_schoolyear = $_POST['student_schoolyear'];
    $student_eId = $_POST['student_eId'];
    
    $sql_ss_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM section_subject WHERE section_subjectId = $section_subjectId" ));
    $getsubject_id = $sql_ss_data['subject_id'];

    $check_ifnot_addedAlready = "SELECT * FROM enrolled_subject WHERE subject_id = '$getsubject_id' AND student_number = '$student_number' AND schoolyear = '$student_schoolyear'";
    $result_check = mysqli_query($conn,$check_ifnot_addedAlready);

    if(mysqli_num_rows($result_check) > 0) {
        echo "You have added this subject already.";
    }
    else{
        if($sql_ss_data['teacher_id'] == "") {
            $section_id = $sql_ss_data['section_id'];
            $subject_id = $sql_ss_data['subject_id'];

            $sql_addSubject = "INSERT INTO enrolled_subject (enrollment_id, section_id, student_number, subject_id, schoolyear,section_subjectId)
            VALUES('$student_eId','$section_id','$student_number','$subject_id','$student_schoolyear','$section_subjectId')";
            mysqli_query($conn, $sql_addSubject);
            echo 1;
        }
        else{
            $section_id= $sql_ss_data['section_id'];
            $subject_id= $sql_ss_data['subject_id'];
            $teacher_id= $sql_ss_data['teacher_id'];
            $sql_addSubject = "INSERT INTO enrolled_subject (enrollment_id, section_id, teacher_id, student_number, subject_id, schoolyear,section_subjectId)
            VALUES('$student_eId','$section_id','$teacher_id','$student_number','$subject_id','$student_schoolyear','$section_subjectId')";
            mysqli_query($conn,$sql_addSubject);
            echo 2;
        }
    }
}

function enrollment_status() {
    global $conn;

    $enrollment_id = $_POST["enrollment_id"];
              
    $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT e.*, ss.* FROM enrollment e, section_subject ss 
    WHERE e.section_id=ss.section_id AND enrollment_id = $enrollment_id"));
    $s_fullname= $rows["fullname"];
    $user_email= $rows["student_email"];
    $schoolyear= $rows["schoolyear"];  
    $section_id= $rows["section_id"]; 
    $student_id= $rows['student_id'];
    $student_number= $rows['student_number'];

    $teacher_id= $rows['teacher_id'];
        
    $adviser_sql="SELECT * FROM section_subject WHERE section_id= $section_id";
    $adviser_result=mysqli_query($conn,$adviser_sql);
        
    $rows_adviser = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM section_subject WHERE section_id = $section_id"));
        
    if(mysqli_num_rows($adviser_result)<=0 && $rows["enrollment_status"] == "PENDING") {

        $enrollment_status="UPDATE `enrollment` SET 
        `enrollment_status`='APPROVED'
        WHERE enrollment_id=".$_POST['enrollment_id'];
                
        mysqli_query($conn,$enrollment_status);

        $ss_enrolled = "SELECT * FROM section_subject WHERE section_id = $section_id";
        $res_ssenrolled = mysqli_query($conn,$ss_enrolled);
        while($ssenrolled=mysqli_fetch_array($res_ssenrolled)) {
            $insert_student="INSERT INTO enrolled_subject (enrollment_id, section_id,student_number,schoolyear) 
            VALUES ('$enrollment_id','$section_id','$student_number','$schoolyear')";
            mysqli_query($conn,$insert_student);     
        }
        echo 5;
        }
        else if(mysqli_num_rows($adviser_result)>0 && $rows["enrollment_status"] == "PENDING") {
            $enrollment_status="UPDATE `enrollment` SET 
            `enrollment_status`='APPROVED'
            WHERE enrollment_id=".$_POST['enrollment_id'];      
            mysqli_query($conn,$enrollment_status);
        
            $ss_enrolled="SELECT * FROM section_subject WHERE section_id= $section_id";
            $res_ssenrolled=mysqli_query($conn,$ss_enrolled);
            while($ssenrolled=mysqli_fetch_array($res_ssenrolled)) {
                $subject_id= $ssenrolled['subject_id'];
                $teacher_id= $ssenrolled['teacher_id'];
                $section_subjectId= $ssenrolled['section_subjectId'];
                $insert_student="INSERT INTO enrolled_subject (enrollment_id, section_id, teacher_id,student_number,subject_id, schoolyear,section_subjectId) 
                VALUES ('$enrollment_id','$section_id','$teacher_id','$student_number','$subject_id','$schoolyear','$section_subjectId')";
                mysqli_query($conn,$insert_student);  
            }
            echo 1;
        }
        else{
            $enrollment_status="UPDATE `enrollment` SET 
            `enrollment_status`='PENDING'
            WHERE enrollment_id=".$_POST['enrollment_id'];
            mysqli_query($conn,$enrollment_status);

            mysqli_query($conn, "DELETE FROM enrolled_subject WHERE enrollment_id = $enrollment_id");
            echo 0;   
        }
}

?>