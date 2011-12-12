<?php
require 'config.php';

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// username and password sent from form 
$myusername=$_POST['username']; 
$mypassword=$_POST['password'];

// To protect MySQL injection (more detail about MySQL injection)
// $myusername = stripslashes($myusername);
// $mypassword = stripslashes($mypassword);
// $myusername = mysql_real_escape_string($myusername);
// $mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and pword='$mypassword'";
$result=mysql_query($sql);

$count=0;
// Mysql_num_row is counting table row
if($result){
    $count=mysql_num_rows($result);
} 
// If result matched $myusername and $mypassword, table row must be 1 row

if($count>0){
    // Register $myusername, $mypassword and redirect to file "login_success.php"
    session_start();
    $_SESSION['username']=$myusername;
    $_SESSION['password']=$mypassword; 
    header("location:profile.php?username=".$_SESSION['username']);
}
else {
    $res = "Wrong Username or Password. Query was $sql";
    header("location:index.php?err=$res");
}
?>