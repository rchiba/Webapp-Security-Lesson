<?php
require 'config.php';

// Connect to server and select databse.
$link = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");



// To protect MySQL injection (more detail about MySQL injection)
// $myusername = stripslashes($myusername);
// $mypassword = stripslashes($mypassword);
// $myusername = mysql_real_escape_string($myusername);
// $mypassword = mysql_real_escape_string($mypassword);
// CREATE TABLE `members` (
// `id` int(4) NOT NULL auto_increment,
// `username` varchar(65) NOT NULL default '',
// `password` varchar(65) NOT NULL default '',
// PRIMARY KEY (`id`)
// ) TYPE=MyISAM AUTO_INCREMENT=2 ;

// INSERT INTO `members` VALUES (1, 'john', '1234');
$username=$_POST['username'];

// query posts
$sqlSelect="SELECT username FROM $tbl_name WHERE username='$username';";
$selectResult=mysql_query($sqlSelect);

if(!$selectResult){
    echo "Could not successfully run $sqlSelect";
    exit;
} 

if(mysql_num_rows($selectResult) == 0){
    echo "No users found that match $username.";
    exit;
}

// create the array of json objects
$jsonRes = "";
$jsonRes.='';
while ($row = mysql_fetch_assoc($selectResult)) {
    $pword="####"; // if the user can get the query to get the pword, then it will print
    if(!empty($row["pword"])){
        $pword = $row["pword"];
    }

    $jsonRes.="Yes, user ".$row["username"]." exists.<br>";
}
$jsonRes = substr($jsonRes, 0, strlen($jsonRes)-1); // get rid of that last comma
$jsonRes.='';
echo $jsonRes;
?>