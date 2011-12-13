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
$defaultUser=$_POST["username"];
$defaultPass=$_POST["password"];
$sqlDrop="DROP TABLE IF EXISTS $tbl_name;";
$sqlCreateTable="Create Table $tbl_name(id INT(4) NOT NULL auto_increment, username VARCHAR(65) NOT NULL, pword VARCHAR(65) NOT NULL, creditcard VARCHAR(65) NOT NULL, PRIMARY KEY(id)) ENGINE=MyISAM;";
$sqlCreatePostTable="Create Table $tbl_namePosts(id INT(4) NOT NULL auto_increment, username VARCHAR(65) NOT NULL, post VARCHAR(300) NOT NULL, time timestamp NULL, PRIMARY KEY(id)) ENGINE=MyISAM;";
$sqlInsertEntry="INSERT INTO $tbl_name (username,pword,creditcard) VALUES ('$defaultUser', '$defaultPass', '12341234');";

// mysql_query($sqlDrop);
// create both tables in case they are not created already
mysql_query($sqlCreateTable);
mysql_query($sqlCreatePostTable);

$sqlSelect="SELECT * FROM $tbl_name WHERE username='$defaultUser';";
$selectResult=mysql_query($sqlSelect);

$count=mysql_num_rows($selectResult);
if($count != 0){
    header("location:index.php?err=userAlreadyExists");
} else{
    // proceed by inserting new user
    echo "about to call ".$sqlInsertEntry;
    mysql_query($sqlInsertEntry);
    
    // see if the entry actually got saved
    $sqlSelect="SELECT * FROM $tbl_name WHERE username='$defaultUser' and pword='$defaultPass';";
    $selectResult=mysql_query($sqlSelect);
    $count=mysql_num_rows($selectResult);
    echo $selectResult;
    echo $sqlSelect;
    if($count==0){
        echo "Something went wrong.";
    } else{
        // password matches
        header("location:index.php?msg=userCreated&user=$defaultUser");
    }
    
}
?>