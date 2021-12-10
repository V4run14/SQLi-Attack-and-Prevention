<!DOCTYPE HTML>  
<html>
<head><title>UNION</title>
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
<?php
$uname = $pass = "";
$conn = mysqli_connect("localhost", "root", "", "infosec");
$query1 = mysqli_query($conn, "SELECT * FROM details;");
$query2 = mysqli_query($conn, "SELECT * FROM employee;");

?>
<div>
<h1>Login Gateway</h1>
<form name = "getdetails" method="get" action="">  
  <label>Username </label> <input type="text" name="uname">
  <br><br>
  <label>Password </label>  <input type="text" name="pwd">
  <br><br>
  <input type = "submit" name="submit" value="Log In" class="submit">
</form>
</div>

<?php
//if(isset($_GET["submit"])&& $_SERVER["REQUEST_METHOD"]=="GET") {
$uname = $_GET["uname"];
$pass = $_GET["pwd"];
$sql="SELECT * FROM details where username='".$uname."'";
$result = mysqli_query($conn, $sql);



while($row = mysqli_fetch_assoc($result)) {
  if($pass == $row["password"]){
          echo print_r($row). "<br>";
  }
  else{
          echo '<h2>Wrong credentials</h2>';
  }
}
//}
?>
</body>
</html>