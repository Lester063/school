<?Php
require_once('connect.php');
session_start();

if(!isset($_SESSION['firstname'])){
	header('Location:login.php');
}

$sql_section='SELECT * FROM section';
$result_section=mysqli_query($conn,$sql_section);

$sql_enrolled="SELECT * FROM enrollment where yearsection"=.'"A"';
$result_enrolled=mysqli_query($conn,$sql_enrolled);







?>
<html>
<head>

<link rel="stylesheet" href="../css/styles.css">
<script src="../js/js.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
      
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
		
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>View Students</title>

</head>
<body>
<div class="wrap"id="wrap">






<div class="viewstudentwrapper">
<?Php
while($row = mysqli_fetch_assoc($result_enrolled)){

?>

<table style="margin-top:20px;"name="<?Php echo $row['yearsection']?>">
<tr>
    <th colspan=2 style="background-color:#d2d2d2">FULL NAME</th>
</tr> 
<tr>
    <th><?Php echo $row['fullname']?></th>
</tr> 





<?php
}
?>

</table>





</div>

</body>
</html>