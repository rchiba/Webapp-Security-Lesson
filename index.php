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
        
        
        // initialize database button
        $("#initDB").click(function(){
            console.log('initialize database clicked');
            $.ajax({
                type: "get",
                dataType: "html",
                url: 'initDB.php',
                data: {},
                success: function(response) {
                    // alert(response);
                    var res;
                    var success='<div class="alert-message success"> <a class="close" href="#">x</a><p><strong>Success!</strong> Database populated.</p></div>';
                    var err='<div class="alert-message error"> <a class="close" href="#">x</a><p><strong>Error!</strong> '+response+'</p></div>';
                    
                    if(response.indexOf('success') != -1){
                        res = success;
                    } else{
                        res = err;
                    }
                    
                    $("#console").html(res);
                    
                    $(".alert-message").alert(); // close functionality added here
                    
                }
            });// END ajax
        });
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
    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#">catbook</a>
          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">Chat</a></li>
            <li><a href="#contact">Discover</a></li>
          </ul>
          <form action="checkLogin.php" class="pull-right" method="post">
            <a href="#" data-placement="below" rel="popover" data-content="Hmmm... I wonder if they're checking the input fields?" data-original-title="SQL Injection">
                <input class="input-small" type="text" placeholder="Username" name="username">
            </a>
            <a href="#" data-placement="below" rel="popover" data-content="Here are some examples of entries that might reveal interesting information: <br> hello" data-original-title="Examples">
            <input class="input-small" type="password" placeholder="Password" name="password">
            </a>
            <button class="btn" type="submit">Sign in</button>
          </form>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="content">
        <div class="page-header" style="margin-top:100px;">
          <h1><small></small></h1>
          <div id="console">
          <?php
            if(!empty($_GET["err"]) && $_GET["err"]=="badinput"){
                echo '<div class="alert-message error"> <a class="close" href="#">x</a><p><strong>Error!</strong> Wrong username or password!</p></div>';
            }
            if(!empty($_GET["err"]) && $_GET["err"]=="userAlreadyExists"){
                echo '<div class="alert-message error"> <a class="close" href="#">x</a><p><strong>Error!</strong> User already exists! Try a different username.</p></div>';
            }
            if(!empty($_GET["msg"]) && $_GET["msg"]=="logout"){
                // session_start();
                // session_destroy(); 
                echo '<div class="alert-message success"> <a class="close" href="#">x</a><p>You have been logged out.</p></div>';
            }
            if(!empty($_GET["msg"]) && $_GET["msg"]=="userCreated"){
                // session_start();
                // session_destroy(); 
                echo '<div class="alert-message success"> <a class="close" href="#">x</a><p>User '.$_GET["user"].'has been created.</p></div>';
            }
          ?>
          </div>
        </div>
        <div class="row">
          <div class="span12">
            <h2>catbook<small>, the social network for cats</small></h2>
            Welcome to catbook! The social network where cats can post updates on their favorite naptimes, catnip, and toaster strudel outfits. This mock social networking site will reveal the kinds of vulnerabilities that are common in poorly implemented web applications. Start by creating a few new kitties (users) in the form below. Then, log in as one of them.
            <br>
            <br>
            <form action="initDB.php" method="post" style="margin-left:-69px; margin-top:20px;">
                <fieldset>
                    <legend>Create a new kitty:</legend <br>
                    <div class="clearfix">
                        <label for="username">username</label>
                        <div class="input">
                            <input class="xlarge" id="newUsername" name="username" size="30" type="text">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="password">password</label>
                        <div class="input">
                            <input class="xlarge" id="newPassword" name="password" size="30" type="text">
                        </div>
                    </div>
                    <div class="clearfix">
                        <label for="initDB"></label>
                        <div class="input">
                            <button class="btn primary" id="initDB">Sign up</button>
                        </div>
                    </div>
                    
                </fieldset>
            </form>
            <br>
            
            <br>
            <br>
            <br>
            <img src="img/exploits_of_a_mom.png" />
          </div>
          <div class="span4">
            <h2>Types of Attacks Examined</h2>
            <ul>
                <li>SQL Injections</li>
                <li>Cross Site Scripting</li>
                <li>Something else</li>
            </ul>
          </div>
        </div>
      </div>

      <footer>
        <p>&copy; catbook 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
