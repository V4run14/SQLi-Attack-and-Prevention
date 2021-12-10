<!DOCTYPE HTML>  
<html>
<head><title>SQLi</title>
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
table{
      border-collapse: collapse;
      font-size: 20px;
}
th{
    background-color: black;
    color: white;
}

</style>
</head>
<body>  
<div>
<h1>Login Gateway</h1>
<form method="POST" action="">  
  <label>Username </label> <input type="text" name="uname">
  <br><br>
  <label>Password </label>  <input type="text" name="pwd">
  <br><br>
  <input type = "submit" name="submit" value="Log In" class="submit">
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
$pass = $_POST["pwd"]; 

$sql="SELECT * FROM details where username=? AND password=? ";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    echo '<br><br><h2>SQL Statement Failed</h2>';
}else {
    mysqli_stmt_bind_param($stmt, "ss", $uname, $pass);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($result->num_rows > 0) {
        echo '<br><br><br>';
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Username</th>";
        echo "<th>Password</th>";
        echo "<th>Salary</th>";
        echo "<th>Phone</th>";
        echo "</tr>";
          while($row = mysqli_fetch_row($result)) {
              echo "<tr>";
              $i=0;
              while($i<5){
                echo "<td>" . $row[$i] . "</td>";
                $i = $i + 1;
              }
              echo "</tr>";
          }
          echo "</table>";
      }
      else{
        echo '<br><br><h2>Wrong credentials</h2>';
        }
    }
}
?>
</body>
</html>