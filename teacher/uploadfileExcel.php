<?php
require_once('../includes/connect.php');

if(isset($_POST["import"])) {
    $teacher_id = $_POST['teacher_id'];
    $subject_id = $_POST['subject_id'];
    $section_id = $_POST['section_id'];
    $schoolyear = $_POST['schoolyear'];
    
    $fileName = $_FILES["excel"]["name"];
    $fileExtension = explode('.', $fileName);
    $fileExtension = strtolower(end($fileExtension));
    $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

    $targetDirectory = "uploads/" . $newFileName;
    move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

    error_reporting(0);
    ini_set('display_errors', 0);

    require('spreadsheet-reader/php-excel-reader/excel_reader2.php');
    require('spreadsheet-reader/SpreadsheetReader.php');

    $reader = new SpreadsheetReader($targetDirectory);

    $number=0;
    foreach($reader as $key => $row) {
        $number++;
        if($number>=3) {
            $student_number = $row[0];
            $first_grading = $row[1];
            $second_grading = $row[2];
            $third_grading = $row[3];
            $fourth_grading = $row[4];

            $sql = "SELECT * FROM enrolled_subject WHERE student_number = '$student_number' AND section_id = '$section_id'";
            $result=mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                $sql_section = "UPDATE enrolled_subject SET first_grading = $first_grading,
                second_grading = $second_grading,
                third_grading = $third_grading,
                fourth_grading = $fourth_grading
                WHERE student_number = '$student_number' AND section_id = '$section_id' AND subject_id = '$subject_id'";
                mysqli_query($conn,$sql_section);
            }
            else{
                echo
                "
                <script>
                alert('We successfully imported the data, but some of the student does not exist on the list of enrolled student, Please check your data.');
                document.location.href = 'sectionhandlestudentblade.php?section_id=$section_id&subject_id=$subject_id';
                </script>
                ";
            }
        }
    }

    echo
    "
    <script>
    alert('Succesfully Imported');
    document.location.href = 'sectionhandlestudentblade.php?section_id=$section_id&subject_id=$subject_id';
    </script>
    ";
}
else{
    echo
    "
    <script>
    alert('Failed to import');
    document.location.href = 'sectionhandlestudentblade.php?section_id=$section_id&subject_id=$subject_id';
    </script>
    ";
}

?>