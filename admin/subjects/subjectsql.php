<?php
require_once('../../includes/connect.php');

if(isset($_POST['action'])) {
    if($_POST['action'] == "action_addSubject") {
        addSubject();
    }
    else if($_POST['action'] == "deleteSubject") {
        deleteSubject();
    }
    else if($_POST['action'] == "action_addCourse") {
        addnewCourse();
    }
    else if($_POST['action'] == "action_deleteCourse") {
        deleteCourse();
    }

}

function addSubject() {
    global $conn;

    $newSubject = $_POST['newSubject'];
    $subjectCode = $_POST['subjectCode'];
    $description = $_POST['description'];
    $sqlcheck = "SELECT * FROM `subject` WHERE subject_code = '$subjectCode'";
    $rescheck = mysqli_query($conn, $sqlcheck);
    if(mysqli_num_rows($rescheck) > 0) {
        echo 0;
    }
    else{
        $sql_add = "INSERT INTO `subject` (subject, subject_code, description) VALUES ('$newSubject','$subjectCode', '$description')";
        mysqli_query($conn, $sql_add);
        $getIt = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM subject ORDER BY subject_id DESC"));
        echo "<tr class='message-wrap'><td>".'##'."</td>"."<td>".$getIt['subject']."</td>"."<td>".$getIt['subject_code']."</td>"."<td>".$getIt['description']
        ."<td>###### ####</td>"
        ."</td></tr>";
    }
}

function deleteSubject() {
    global $conn;
    $subject_id = $_POST['subject_id'];
    $subjectDelete = "DELETE FROM subject WHERE subject_id = $subject_id";
    mysqli_query($conn, $subjectDelete);
    echo 1;
}

function addnewCourse() {
    global $conn;

    $newCourse = $_POST['newCourse'];
    $courseDescription = $_POST['courseDescription'];
    $sqlcheck = "SELECT * FROM `courses` WHERE course_name='$newCourse'";
    $rescheck = mysqli_query($conn, $sqlcheck);
    if(mysqli_num_rows($rescheck) > 0) {
        echo 1;
    }
    else{
        $sql_add = "INSERT INTO `courses` (course_name, course_description) VALUES ('$newCourse', '$courseDescription')";
        mysqli_query($conn, $sql_add);
        $getIt = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM courses ORDER BY course_id DESC"));
        echo "<tr class='message-wrap'><td>".'#'."</td>"."<td>".$getIt['course_name']."</td>"."<td>".$getIt['course_description']
        ."</td></tr>";
    }
}

function deleteCourse() {
    global $conn;
    $course_id = $_POST['course_id'];
    $getName = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM courses WHERE course_id = '$course_id'"));
    $coursename = $getName['course_name'];
    $courseDelete = "DELETE FROM courses WHERE course_id = $course_id";
    mysqli_query($conn, $courseDelete);
    echo $coursename;
}
?>