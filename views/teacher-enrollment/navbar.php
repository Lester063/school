<?Php
require_once('../includes/connect.php');

$firstname=$_SESSION['firstname'];
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/styles.css">
<script src="../js/js.js"></script>

</head>
<body>
<div class="adminNav" id="adminNav">
<input type="button" onclick="closenav()"class="closenav"value="X"id="closenav">
<input type="button" onclick="opennav()"class="opennav"value="O"id="opennav">
<div class="profile">
<div class="imgbox"><img src="../profile.png"></div>
<b><?Php echo $firstname ?></b>
</div>
<ul>
  <li><a href="viewstudent.php">VIEW STUDENTS</a></li>
  <li><a href="viewteacher.php">VIEW TEACHERS</a></li>
  <li><a href="addsectionForm.php">ADD SECTION</a></li>
  <li><a href="viewsections.php">VIEW SECTIONS</a></li>
  <li><a href="viewenrolled.php">VIEW ENROLLED</a></li>
</ul>
<div class="logoutButton"id="logoutButton"><a href="logout.php">LOGOUT</a></div>
</div>

<script>

</script>
</body>

</html>