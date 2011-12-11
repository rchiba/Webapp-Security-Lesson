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
$post=$_POST['post'];

// insert post into posts db
$mysqldate = date( 'Y-m-d H:i:s');
$sqlInsertEntry="INSERT INTO $tbl_namePosts (username,post,time) VALUES ('$username', '$post', '$mysqldate');";
mysql_query($sqlInsertEntry);

// query posts
$sqlSelect="SELECT post FROM $tbl_namePosts WHERE username='$username' AND post='$post';";
$selectResult=mysql_query($sqlSelect);

if(!$selectResult){
    echo "Error: Could not successfully run $sqlSelect";
    exit;
} 

if(mysql_num_rows($selectResult) == 0){
    echo "Error: Post failed to upload. Insert was $sqlInsertEntry and Query was $sqlSelect";
    exit;
}

echo "Success";
?>