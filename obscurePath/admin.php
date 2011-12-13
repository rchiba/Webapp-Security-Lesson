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
    <link href="../js/prettify.css" rel="stylesheet">
    
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap-modal.js"></script>
    <script src="../js/bootstrap-twipsy.js"></script>
    <script src="../js/bootstrap-popover.js"></script>
    <script src="../js/bootstrap-alerts.js"></script>
    <script src="../js/prettify.js"></script>
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
        
        // user search
        $('#userSearchBtn').click(function(e){
            $.ajax({
                type: "post",
                dataType: "html",
                url: '../getUser.php',
                data: {"username":$('#userSearch').val()},
                success: function(response) {
                    // alert(response);
                    var res='<div class="alert-message block-message info"><p>'+response+'</p></div>';
                    $("#userSearchConsole").html(res);
                    
                }
            });// END ajax
        });
        
        // reset button
        $('#reset').click(function(e){
            $.ajax({
                type: "get",
                dataType: "html",
                url: '../resetDB.php',
                data: {},
                success: function(response) {
                    // alert(response);
                    var res='<div class="alert-message block-message error"><p>'+response+'</p></div>';
                    
                    $("#resetConsole").html(res);
                    
                }
            });// END ajax
        });
        
        
      });// END document.ready
      </script>
      
      
    
    <!-- Le styles -->
    <link href="../bootstrap.min.css" rel="stylesheet">
    <style>
        hr{
            border-bottom:1px solid #ccc;
        }
    </style>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>

  <body onload="prettyPrint()">
    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#">catbook&#8482</a>
          <ul class="nav">
          </ul>
        </div>
      </div>
    </div>

    <div class="container" style="width:580px;">

      <div class="content">
        <div class="page-header" style="margin-top:100px;">
          <h1><small></small></h1>
          <div id="console">
          </div>
        </div>
        <div class="row">
          <div class="span10">
            <h2>catbook<small> administrative webpanel</small></h2>
            Welcome to the administrative webpanel. 
           
            <hr>
            <h3>Search users<small> Note: How could we get the passwords for all the users?</small></h3>
        
                <div class="clearfix">
                    <label for="userSearch">username</label>
                    <div class="input">
                        <input class="xlarge" id="userSearch" name="userSearch" size="30" type="text">
                        <button class="btn primary" value="search" id="userSearchBtn">search</button>
                    </div>
                </div>
           <br>
            <div id="userSearchConsole">
            <!-- user search output gets printed here -->
            </div>
            <hr>
            <h3>Reset DB (drops and recreates tables)</h3>
                <button class="btn danger" id="reset">Reset</button>
                <div id="resetConsole"></div>
            </div>
        </div>
      </div>

      <footer>
        <p>&copy; catbook&#8482 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
