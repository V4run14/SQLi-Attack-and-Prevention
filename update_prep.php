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

$sql="SELECT * FROM details where username='$uname' AND password='$oldpass'";
$check = $conn->query($sql);
if ($check->num_rows > 0){
    $sql2 = "UPDATE details SET password=? WHERE username=? AND password=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql2)){
        echo '<br><br><h2>SQL Error</h2>';
    }else {
        mysqli_stmt_bind_param($stmt, "sss", $newpass, $uname, $oldpass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        echo '<br><br><br>Password Updated!!';
    }
}else{
  echo '<br><br><h2>Wrong credentials</h2>';
}
}
?>
</body>
</html>