<?Php
require_once('../../includes/connect.php');
session_start();

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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <title>View Sections</title>
</head>
<body>
    <div class="deletemessage"id="deletemessage"></div>
    <?Php require_once('../../includes/navbar.php') ?>
    <div class="wrap"id="wrap">
        <div class="container mt-5">
            <div class="col-sm-12">
                <input type="text" name="newSubject" id="newSubject" placeholder="Enter new Subject Name" required="">
                <input type="text" name="subjectCode" id="subjectCode" placeholder="Enter Subject Code"required="">
                <input type="text" name="description" id="description" placeholder="Enter Subject Description"required="">
                <button type="button"class="bluewhiteButton"id="addSubject_button"onclick="addSubject_button()">Add</button><br>
                </div> <!-- need to check -->
            </div>

            <div class="col-sm-12">
                <?Php require_once('display_subject.php') ?>
            </div>
        </div>
    </div>
</body>
</html>