<?php session_start(); ?>
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
        
        function getPosts(){
            $.ajax({
                type: "get",
                dataType: "html",
                url: 'getPost.php?username=<?php echo $_SESSION['username']; ?>',
                success: function(response) {
                    console.log(response);
                    // var res;
                    // var resType;
                    // if(response.indexOf("Error:") != -1){
                        // resType = "error";
                    // } else{
                        // resType = "success";
                    // }
                    // $("#posts").html('<div class="alert-message.block-message'+resType+'"> <a class="close" href="#">x</a>'+response+'</p></div>');
                    // $(".alert-message").alert(); // close functionality added here
                }
            });// END ajax
        }
        
        // initialize database button
        $("#postButton").click(function(){
            console.log('postButton clicked');
            $.ajax({
                type: "post",
                dataType: "html",
                url: 'insertPost.php?',
                data: {'post':$("#postInput").val(), 'username':'<?php echo $_SESSION['username']; ?>'},
                success: function(response) {
                    console.log(response);
                    // console.log($.parseJSON.parse(response));
                    var res;
                    var resType;
                    if(response.indexOf("Error:") != -1){
                        resType = "error";
                    } else{
                        resType = "success";
                    }
                    $("#postConsole").html('<div class="alert-message '+resType+'"> <a class="close" href="#">x</a>'+response+'</p></div>');
                    $(".alert-message").alert(); // close functionality added here
                    
                    // get posts and populate the post console
                    getPosts();
                    
                }
            });// END ajax
        });
        $('#topbar').dropdown(); // menu dropdown
        $(".alert-message").alert(); // close functionality added here
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
          <a class="brand" href="#">The Social Network</a>
          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">Chat</a></li>
            <li><a href="#contact">Discover</a></li>
          </ul>
          <ul class="nav secondary-nav">
            <li class="menu">
              <a href="#" class="menu"><?php echo $_SESSION['username']; ?></a>
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
        <div class="page-header" style="margin-top:100px;">
          <h1><small></small></h1>
          <div id="console"></div>
        </div>
        <div class="row">
          <div class="span5">
            <img src="img/"/>
            <br><br>
            <!-- profile information -->
            <table>
                <tbody>
                <tr>
                    <td>Name</td><td><?php echo $_SESSION['username'];?></td>
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
            <textarea class="xxlarge" id="postInput" name="postInput" rows="3" placeholder="Enter post here..."></textarea>
            <input type="submit" class="btn primary" value="Post" id="postButton" style="height:64px;">
            
            <div id="postContainer" style="width:540px; margin-top:10px;">
                <div id="postConsole"></div>
                <div id="posts"></div>
            </div>
            
          </div>
        </div>
      </div>

      <footer>
        <p>&copy; The Social Network 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
