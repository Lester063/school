<?Php
require_once('../includes/connect.php');
session_start();
if(!isset($_SESSION['firstname'])){
	header('Location:loginpage.php');
}
$sql_user="SELECT * FROM `users`";
$result_user=mysqli_query($conn,$sql_user);

$name=$_SESSION['firstname'];
$id=$_SESSION['id'];


if(isset($_POST['submit'])){

$cht = "qr";

$chs = "300x300";

$chl = urlencode("student.php/id=$id");


$choe = "UTF-8";

$qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=' . $chl . '&choe=' . $choe;



}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/styles.css">
<script src="https://raw.githubusercontent.com/mebjas/html5-qrcode/master/minified/html5-qrcode.min.js"></script>
  <script src="html5-qrcode-demo.js"></script>
</head>
<body>
<form action="student.php" method="POST">
<input type="text" value="<?Php echo $_SESSION['id']?>">
<button type="submit"name="submit"class="submit"id="submit">QR</button>
</form>


<img class="qwe"src="<?php echo $qrcode ?>" alt="My QR code"id="qrid<?Php echo $id?>">

<input type="text" id="qrdata">


</body>



<script>

$('.qwe').addEventListener("scan",function(){
    alert("wqewqe");
});
</script>
</html>