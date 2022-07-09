<?Php
require_once('../../includes/connect.php');
require_once('../../pdflibrary/fpdf.php');

$id=$_GET['id'];
$sql_section="SELECT u.*, en.*, s.* FROM users u, enrollment en, section s
WHERE u.student_number=en.student_number AND s.section_id=en.section_id
AND u.id=$id";
$result_section=mysqli_query($conn,$sql_section);

$sql_getInfo="SELECT u.*, en.*, es.* FROM users u, enrollment en, enrolled_subject es
WHERE u.student_number=en.student_number AND u.student_number=es.student_number
AND u.id=$id";
$result=mysqli_query($conn,$sql_getInfo);

$student=mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM users WHERE id=$id"));

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',13);

$firstname=$student['firstname'];
$middlename=$student['middlename'];
$lastname=$student['lastname'];
$course=$student['course'];
  $pdf->Cell(15,10,"Name:");
  $pdf->Cell(100,10,$firstname." ".$middlename." ".$lastname);
  $pdf->Ln();
  $pdf->Cell(100,10,'Course:'.$course);
  $pdf->Ln();

while($row=mysqli_fetch_array($result_section)){
  $yearsection=$row['yearsection'];
  $section_course=$row['section_course'];
  $enrollment_id=$row['enrollment_id'];
  $schoolyear=$row['schoolyear'];
  $pdf->Cell(20,10,$section_course.$yearsection.' - '.$schoolyear);
  $pdf->Ln();
  $ss_data=mysqli_query($conn, "SELECT ens.*, sub.*, en.*,t.* FROM enrolled_subject ens, subject sub, enrollment en, teacher t WHERE ens.subject_id=sub.subject_id AND ens.enrollment_id=en.enrollment_id AND ens.teacher_id=t.teacher_id AND ens.enrollment_id=$enrollment_id");
  $arr=mysqli_fetch_array($ss_data);
  $pdf->Cell(60,10,"Subject");
  $pdf->Cell(20,10,"First");
  $pdf->Cell(20,10,"Second");
  $pdf->Cell(20,10,"Third");
  $pdf->Cell(20,10,"Fourth");
  $pdf->Cell(20,10,"Average");
  $pdf->Ln();
  foreach($ss_data as $se_student){
    $average=($se_student['first_grading']+$se_student['second_grading']+$se_student['third_grading']+$se_student['fourth_grading'])/4;
    $pdf->Cell(60,10,$se_student['subject']);
    $pdf->Cell(20,10,$se_student['first_grading']);
    $pdf->Cell(20,10,$se_student['second_grading']);
    $pdf->Cell(20,10,$se_student['third_grading']);
    $pdf->Cell(20,10,$se_student['fourth_grading']);
    $pdf->Cell(20,10,$average);
    $pdf->Ln();
  }
$pdf->Ln();
}
$pdf->Output();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
    <tr>
        <td>Subject</td>
        <?php

        ?>
    </tr>
</table>
</body>
</html>