<?php
require_once('../../includes/connect.php');

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
    <table class="table mt-3" id="po">
        <tr>
            <th>#</th>
            <th>Subject</th>
            <th>Code</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        
        <?php 
        $getSubject="SELECT * FROM subject";
        $result_subject=mysqli_query($conn,$getSubject);
        $count=0;
        while($row=mysqli_fetch_array($result_subject)){
            $count++;
        ?>
        <tr id="<?php echo $row['subject_id']?>">
            <td><?php echo $count?></td>
            <td><?php echo $row['subject']?></td>
            <td><?php echo $row['subject_code']?></td>
            <td><?php echo $row['description']?></td>
            <td>
                <button onclick="confirm('are you sure?') && deleteSubject(<?php echo $row['subject_id']?>)"class="redblackButton">Delete</button>
                <button onclick="editSubject(<?php echo $row['subject_id']?>)"class="bluewhiteButton">Edit</button>
            </td>
        </tr>
        <?php
            }
        ?>
    </table>
</body>
</html>