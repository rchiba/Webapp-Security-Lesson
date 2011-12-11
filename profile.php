<?php 
    require 'config.php';

    session_start(); 
    $localName = "";
    
    // takes care of empty param case
    if(empty($_GET['username'])){
        $localName = $_SESSION['username'];
    } else{
        $localName = $_GET['username'];
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ITP 425 Final Project</title>
    <meta name="description" content="Demonstrates security vulnerabilities in web applications using examples in a fake social networking site.">
    <meta name="author" content="Ryo Chiba">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-twipsy.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-alerts.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <!-- Le js -->
    <script>
    $(document).ready(function() {
        // enables popovers
        $(function () {
          $("a[rel=popover]")
            .popover({
              offset: 10
            })
            .click(function(e) {
              e.preventDefault();
            })
        })
        
        // a possible vulnerability by exposing this globally
        function getPosts(){
            $.ajax({
                type: "get",
                dataType: "html",
                url: 'getPost.php?username=<?php echo $localName; ?>',
                success: function(response) {
                    console.log(response);
                    var jsonRes = JSON.parse(response);
                    var resType = 'success';
                    var html = "";
                    for(var i=0; i < jsonRes.length; i++){
                        var post = jsonRes[i].post;
                        var time = jsonRes[i].time;
                        html += '<div class="alert-message block-message '+resType+'"><p>'+post+' <br><i>written at '+time+'</i></p></div>'
                        
                    }
                    $("#posts").html(html);
                }
            });// END ajax
        }
        
        /*var*/ insertPost = function(){
            $.ajax({
                type: "post",
                dataType: "html",
                url: 'insertPost.php?',
                data: {'post':$("#postInput").val(), 'username':'<?php echo $localName; ?>'},
                success: function(response) {
                    $("#postInput").val(""); // clear the postInput
                    // console.log($.parseJSON.parse(response));
                    var res;
                    if(response.indexOf("Error:") != -1){
                        $("#postConsole").html('<div class="alert-message error"> <a class="close" href="#">x</a>'+response+'</p></div>');
                        $(".alert-message").alert(); // close functionality added here
                    }
                    // get posts and populate the post console
                    getPosts();
                    
                }
            });// END ajax
        };
        
        // initialize database button
        $("#postButton").click(insertPost);
        $('#topbar').dropdown(); // menu dropdown
        $(".alert-message").alert(); // close functionality added here
        getPosts(); // populate the posts on load of page
      });// END document.ready
      </script>
      
      
    
    <!-- Le styles -->
    <link href="bootstrap.min.css" rel="stylesheet">
    

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>

  <body>
    <div class="topbar" data-dropdown="dropdown">
      <div class="fill">
        <div class="container">
          <a class="brand" href="profile.php?username=<?php echo $_SESSION['username']?>">catbook</a>
          <ul class="nav">
            <li><a href="profile.php?username=<?php echo $_SESSION['username']?>">Home</a></li>
            <?php
                // insert links to everyone
                // Connect to server and select databse.
                mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
                mysql_select_db("$db_name")or die("cannot select DB");
                
                // query posts
                $sqlSelect="SELECT username FROM $tbl_name;";
                $selectResult=mysql_query($sqlSelect);

                if(!$selectResult){
                    echo "Could not successfully run $sqlSelect";
                    exit;
                } 

                if(mysql_num_rows($selectResult) == 0){
                    echo "No posts found.";
                    exit;
                }

                $jsonRes = "";
                // create the array of json objects
                while ($row = mysql_fetch_assoc($selectResult)) {
                    $active="";
                    if($row["username"] == $localName){$active = "class='active'";};
                    $jsonRes .= '<li '.$active.'><a href="profile.php?username='.$row["username"].'">'.$row["username"].'</a></li>';
                }
                echo $jsonRes;
            
            ?>
          </ul>
          <ul class="nav secondary-nav">
            <li class="menu">
              <a href="#" class="menu">Logged in as <?php echo $_SESSION['username']; // always show session's username ?></a>
              <ul class="menu-dropdown">
                <li><a href="#">Settings</a></li>
                <li><a href="#">Help</a></li>
                <li class="divider"></li>
                <li><a href="index.php?msg=logout">Logout</a></li>
              </ul>
            </li>
          </ul>
          
        </div>
      </div>
    </div>

    <div class="container">

      <div class="content">
        <div class="page-header" style="margin-top:70px;">
          <h1><?php echo $localName;?>'s<small> catbook</small></h1>
          <div id="console"></div>
        </div>
        <div class="row">
          <div class="span5">
            <img src="img/cat<?php echo abs(hexdec(substr(sha1($localName), 0, 10))%10)+1?>.jpg" style="width:280px"/>
            <br><br>
            <!-- profile information -->
            <table>
                <tbody>
                <tr>
                    <td>Name</td><td><?php echo $localName;?></td>
                </tr>
                <tr>
                    <td>Age</td><td>21</td>
                </tr>
                <tr>
                    <td>Birthday</td><td>April 22</td>
                </tr>
                <tr>
                    <td>Sign</td><td>Taurus</td>
                </tr>
                </tbody>
            </table>
          </div>
          
          <div class="span11">
            <?php
            // only show the post box when on own profiile page
            if($_SESSION['username'] == $localName){
                echo '
                <textarea class="xxlarge" id="postInput" name="postInput" rows="3" placeholder="Enter post here..."></textarea>
                <input type="submit" class="btn primary" value="Post" id="postButton" style="height:64px;">
                ';
            }
            ?>
            
            <div id="postContainer" style="width:540px; margin-top:10px;">
                <div id="postConsole"></div>
                <div id="posts"></div>
            </div>
            
          </div>
          
        </div>
      </div>

      <footer>
        <p>&copy; catbook 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
