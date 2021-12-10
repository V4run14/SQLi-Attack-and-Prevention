<!DOCTYPE HTML>  
<html>
<head><title>Update Password</title>
<style>
body{ font-weight: bold;
      color: #232324;
}

div {margin-left: 50px;}
input {width: 13%; 
      height: 20px;
}
label{
    display: inline-block;
    text-align: left;
    width: 8%; 
    padding-bottom: 12px;
    vertical-align: top;
}
.submit{ color: white; margin-left: 100px;
        background-color: #439bd1;
        height: 40px; width: 250px;
}
</style>
</head>
<body>  
<div>
<h1>Update Password</h1>
<form method="POST" action="">  
  <label>Username </label> <input type="text" name="uname">
  <br><br>
  <label>Old Password </label>  <input type="text" name="opwd">
  <br><br>
  <label>New Password </label>  <input type="text" name="npwd">
  <br><br>
  <input type = "submit" name="submit" value="Update" class="submit">
</form>
</div>

<?php
if(isset($_POST["submit"])&& $_SERVER["REQUEST_METHOD"]=="POST") {

$conn = mysqli_connect("localhost", "root", "", "infosec");
if (!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

/* Vulnerable */
$uname = $_POST["uname"];
$oldpass = $_POST["opwd"];
$newpass = $_POST["npwd"];


/* Escape String 
$uname = mysqli_real_escape_string($conn, $_POST["uname"]);
$oldpass = mysqli_real_escape_string($conn, $_POST["opwd"]);
$newpass = mysqli_real_escape_string($conn, $_POST["npwd"]);*/


$sql="SELECT * FROM details where username='$uname' AND password='$oldpass'";
$check = $conn->query($sql);
if ($check->num_rows > 0){
    $sql2 = "UPDATE details SET password='$newpass' WHERE password='$oldpass'";
    //$sql2 = "UPDATE details SET password='varun1' WHERE password='varun123'";
    $result = mysqli_query($conn, $sql2);
    echo '<br><br><br>Password Updated!!';
}
else{
  echo '<br><br><h2>Wrong credentials</h2>';
}
}
?>
</body>
</html>