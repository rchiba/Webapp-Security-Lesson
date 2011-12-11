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
$defaultUser='user';
$defaultPass='1234';
$sqlDrop="DROP TABLE IF EXISTS $tbl_name;";
$sqlCreateTable="Create Table $tbl_name(id INT(4) NOT NULL auto_increment, username VARCHAR(65) NOT NULL, pword VARCHAR(65) NOT NULL, PRIMARY KEY(id)) ENGINE=MyISAM;";
$sqlInsertEntry="INSERT INTO $tbl_name (username,pword) VALUES ('$defaultUser', $defaultPass);";
mysql_query($sqlDrop);
mysql_query($sqlCreateTable);
mysql_query($sqlInsertEntry);

$sqlSelect="SELECT * FROM $tbl_name WHERE username='$defaultUser' and pword='$defaultPass';";
$selectResult=mysql_query($sqlSelect);

// Mysql_num_row is counting table row
$count=mysql_num_rows($selectResult);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count!=1){
    echo "Count was ".$count." and command was ".$sql." and second command was ".$sql2;
}
else {
    echo "success";
}
?>