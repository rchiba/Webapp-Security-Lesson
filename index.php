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
          <a class="brand" href="#">The Social Network</a>
          <ul class="nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">Chat</a></li>
            <li><a href="#contact">Discover</a></li>
          </ul>
          <form action="" class="pull-right">
            <a href="#" data-placement="below" rel="popover" data-content="Hmmm... I wonder if they're checking the input fields?" data-original-title="SQL Injection">
                <input class="input-small" type="text" placeholder="Username">
            </a>
            <a href="#" data-placement="below" rel="popover" data-content="Here are some examples of entries that might reveal interesting information: <br> hello" data-original-title="Examples">
            <input class="input-small" type="password" placeholder="Password">
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
          <div id="console"></div>
        </div>
        <div class="row">
          <div class="span12">
            <a href="#" data-placement="left" rel="popover" data-content="Along the way, these popovers will reveal hints as to what you can do here."data-original-title="Hints"><h2>The Social Network</h2></a>
            This mock social networking site will reveal the kinds of vulnerabilities that are common in poorly implemented web applications. 
            <br>
            <br>
            First, begin by creating the entires in the database for our example: <button class="btn primary" id="initDB">Initialize Database</button>
            
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
        <p>&copy; The Social Network 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
