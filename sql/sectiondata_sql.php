<?Php
require_once('../includes/connect.php');
session_start();
if(isset($_POST['action'])){
    if($_POST['action']=="action_addSection"){
        addSection();
    }
    else if($_POST['action']=="action_deleteSection"){
        deleteSection();
    }
    else if($_POST['action']=="action_getsectionData"){
        getsectionData();
    }
    else if($_POST['action']=="action_updateSection"){
        updateSection();
    }
    else if($_POST['action']=="action_assignTeacher"){
        assignTeacher();
    }
    else if($_POST["action"] == "action_reassignTeacher"){
        if($_POST['new_teacher']!="no_select"){
            newTeacher();
        }
        else{
            echo 2;
        }
    }
    else if($_POST["action"]=="action_adminEnroll_student"){
        adminEnroll_student();
    }
    else if($_POST["action"]=="action_deleteEnrolled_student"){
        deleteEnrolled_student();
    }
    else if($_POST["action"] == "getDataTeacher"){
        getDataTeacher();
    }
    else if($_POST["action"] == "action_getDataAdviser"){
        getDataAdviser();
    }
    else if($_POST["action"] == "action_reassignAdviser"){
        newAdviser();
    }
}

function addSection(){
    global $conn;

    if(!empty($_POST['schoolyear'] AND $_POST['grade_year']AND $_POST['section'] AND $_POST['max_qty'] 
    AND $_POST['start_date'] AND $_POST['end_date'])){	

    $schoolyear=$_POST['schoolyear'];
    $grade_year=$_POST['grade_year'];
    $section=$_POST['section'];
    $yearsection=$_POST['grade_year'].$_POST['section'];
    $start_date=$_POST['start_date'];
    $end_date=$_POST['end_date'];
    $max_qty=$_POST['max_qty'];

    $section_status="ONGOING";

    $section_course=$_POST['section_course'];
    
    $sql_sectionCheck=mysqli_query($conn,"SELECT * FROM section WHERE section_course='$section_course' AND yearsection='$yearsection' AND schoolyear='$schoolyear'");
    
    if(mysqli_num_rows($sql_sectionCheck)>0){
        echo "Section is existed in database.";
    }
    else{
    
    $sql_section="INSERT INTO section (schoolyear, grade_year, section,section_course, yearsection, start_date, end_date,max_qty, section_status)
    VALUES ('$schoolyear','$grade_year','$section','$section_course','$yearsection','$start_date','$end_date','$max_qty','$section_status')";
    mysqli_query($conn, $sql_section);
    $last_id = $conn->insert_id;
    foreach($_POST['section_subject'] as $section_subject) {
        $sql_sec_subject="INSERT INTO section_subject (section_id, subject_id, section_course)
        VALUES ('$last_id','$section_subject','$section_course')";
        mysqli_query($conn, $sql_sec_subject);
    }
    echo 0;
}
}
else{
    echo 1;
}

}



function deleteSection(){
    global $conn;
  
    $section_id = $_POST["section_id"];
  
    $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM section WHERE section_id = $section_id"));
    
    mysqli_query($conn, "DELETE FROM section WHERE section_id = $section_id");
    echo 1;

}

function getsectionData(){
    global $conn;
    $section_id=$_POST['section_id'];
    $query= "SELECT * FROM section WHERE section_id='$section_id'";
    $result =mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}

function updateSection(){
    global $conn;

    $sql_section="UPDATE section SET 
    schoolyear='".$_POST['editsection_schoolyear']."',
    yearsection='".$_POST['editsection_yearsection']."',
    section_course='".$_POST['get_section_course']."',
    max_qty='".$_POST['editsection_qty']."'


    WHERE section_id=".$_POST['editsection_id'];

    mysqli_query($conn,$sql_section);
    echo 1;
}

function assignTeacher(){
    global $conn;

    $section_id=$_POST['section_id'];
    $teacher=$_POST['teacher'];
    $adviser_id=$_POST['adviser_id'];
    $yearsection=$_POST['yearsection'];
    $schoolyear=$_POST['schoolyear'];

    $adviserCheck="SELECT * FROM advisers WHERE adviser_id='$adviser_id' AND schoolyear_assign='$schoolyear'";
    $result_check=mysqli_query($conn,$adviserCheck);
    if(mysqli_num_rows($result_check)>0){
        echo 2;
    }else{
    $assignAdviser="INSERT INTO advisers (section_id, adviser_id,yearsection_assign,schoolyear_assign) 
    VALUES('$section_id','$adviser_id','$yearsection','$schoolyear')";
    mysqli_query($conn,$assignAdviser);

    $assign_status = "UPDATE section SET assign_status ='ASSIGNED', adviser='$adviser_id'
    WHERE section_id =$section_id";
    $resultassign_status = mysqli_query($conn,$assign_status);


    $sql_ss="SELECT * FROM section_subject WHERE section_id=$section_id";
    $res_ss=mysqli_query($conn,$sql_ss);
    
        $i=0;
        $row_ss=mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM section_subject WHERE section_id=$section_id"));
        while($rowss=mysqli_fetch_array($res_ss)){
            
                $query2 = "UPDATE section_subject SET teacher_id =
                $teacher[$i], adviser_id='$adviser_id'
                
                WHERE section_subjectId =" .$rowss['section_subjectId'];
                $result2 = mysqli_query($conn,$query2);
                $i++;
            
        }

        echo 0;

    }
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

function getDataTeacher(){
    global $conn;
    $query= "SELECT ss.*, su.*, se.* FROM section_subject ss, subject su, section se WHERE ss.subject_id=su.subject_id AND ss.section_id=se.section_id AND section_subjectId='".$_POST['section_subjectId']."'";
    $result_query =mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result_query);
    echo json_encode($row);
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

        $ss_sql="UPDATE section_subject SET 
        adviser_id='".$_POST['new_adviser']."'
        WHERE section_id=".$_POST['adviser_section_id'];
        mysqli_query($conn,$ss_sql);


        echo 1;
    }


    

}
?>