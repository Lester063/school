<?php
require_once('../../includes/connect.php');

if(isset($_POST["action"])){
    
    // Choose a function depends on value of $_POST["action"]
    if($_POST["action"] == "getDataTeacher"){
        getDataTeacher();
      
    }
    else if($_POST["action"] == "action_reassignTeacher"){
        if($_POST['new_teacher']!="no_select"){
            newTeacher();
        }
        else{
            echo 2;
        }
    }

    else if($_POST["action"] == "getDataAdviser"){
        getDataAdviser();
    
    }

    else if($_POST["action"] == "action_reassignAdviser"){
        if($_POST['new_adviser']!="no_select"){
            newAdviser();
        }
        else{
            echo 2;
        }
    }
    
    else if($_POST["action"]=="action_deleteEnrolled_student"){
        deleteEnrolled_student();
    }

    else if($_POST["action"]=="action_adminEnroll_student"){
        adminEnroll_student();
    }



}
else{
    echo 2;
}


function getDataTeacher(){
    global $conn;
    $query= "SELECT ss.*, su.*, se.* FROM section_subject ss, subject su, section se WHERE ss.subject_id=su.subject_id AND ss.section_id=se.section_id AND section_subjectId='".$_POST['section_subjectId']."'";
    $result_query =mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result_query);
    echo json_encode($row);
}

function newTeacher(){
    global $conn;
    $reid=$_POST['reassign_id'];

    $ss_newTeach="UPDATE section_subject SET 
    teacher_id='".$_POST['new_teacher']."'
    
    
    WHERE section_subjectId=".$_POST['reassign_id'];
    
    mysqli_query($conn,$ss_newTeach);


    $section_id=$_POST['section_id'];
    $teacher_id=$_POST['teacher_id'];

        $es_newTeach="UPDATE enrolled_subject SET 
        teacher_id='".$_POST['new_teacher']."'
        
        
        WHERE section_id=$section_id AND section_subjectId=".$_POST['reassign_id'];
        
        mysqli_query($conn,$es_newTeach);
    
    echo 1;

}

function getDataAdviser(){
    global $conn;
    $query= "SELECT ad.*, se.* FROM advisers ad, section se WHERE ad.section_id=se.section_id AND ad.section_id='".$_POST['section_id']."'";
    $result_query =mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result_query);
    echo json_encode($row);
}


function newAdviser(){
    global $conn;
    $nAd=$_POST['new_adviser'];
    $adv_sy=$_POST['adv_sy'];

    $ugcheckAdviser="SELECT * FROM advisers WHERE adviser_id=$nAd AND schoolyear_assign='$adv_sy'";
    $re_ugcheckAdviser=mysqli_query($conn,$ugcheckAdviser);

    $getSy="SELECT * FROM uploadgrades WHERE adviser_id='$nAd' AND section_id='".$_POST['adviser_section_id']."'";
    $re_getSy=mysqli_query($conn, $getSy);

    if(mysqli_num_rows($re_ugcheckAdviser)>0){
        echo 2;
    }
    else{
        $sql_newAdv="UPDATE advisers SET 
        adviser_id='".$_POST['new_adviser']."'
        WHERE section_id=".$_POST['adviser_section_id'];
        mysqli_query($conn,$sql_newAdv);


        $ug_newAdv="UPDATE enrolled_subject SET 
        advisers_id='".$_POST['new_adviser']."'
        WHERE section_id=".$_POST['adviser_section_id'];
        mysqli_query($conn,$ug_newAdv);
        echo 1;
    }


    

}

function deleteEnrolled_student(){
    global $conn;
    $student_id=$_POST['id'];
    $section_id=$_POST['section_id'];
    $getStudent_number=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE id=$student_id"));
    $student_number=$getStudent_number['student_number'];
    mysqli_query($conn, "DELETE FROM enrollment WHERE student_id = '$student_id' AND section_id='$section_id'");
    mysqli_query($conn, "DELETE FROM enrolled_subject WHERE student_number = '$student_number' AND section_id='$section_id'");
    echo 1;
}


function adminEnroll_student(){
    global $conn;
    $section_id=$_POST['section_id'];
    $yearsection=$_POST['yearsection'];
    $syear=$_POST['syear'];
    $student_id=$_POST['student_id'];
    $getstudentdata=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE id='$student_id'"));
    $student_number=$getstudentdata['student_number'];
    $fullname=$getstudentdata['firstname'].' '.$getstudentdata['middlename'].' '.$getstudentdata['lastname'];
    $email=$getstudentdata['email'];
    $admin_enroll="INSERT INTO enrollment (student_id,student_number, fullname, student_email, section_id,yearsection, enrollment_status, schoolyear)
    VALUES ('$student_id','$student_number','$fullname', '$email','$section_id','$yearsection','PENDING','$syear')";
    mysqli_query($conn, $admin_enroll);

    echo 1;
}
?>






