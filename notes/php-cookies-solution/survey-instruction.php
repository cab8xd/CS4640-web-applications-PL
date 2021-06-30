<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  
  <title>PHP State Maintenance (Cookies)</title>    
    <style>
      a:hover { background-color:white; }
    </style>
</head>
<body>
    
<!--
Notice that we mixed PHP code and HTML code.
Although you can embed HTML code inside PHP code. 
In terms of performance, anything inside the PHP portion will be executed as script. 
Embedding HTML code which is static information causes the interpreter to execute static information
as script -- leading to unnecessary computation time. 

Good practice: try to separate HTML code from the PHP. The code may look strange, jumping in and out the PHP mode, 
but it yields better performance.    
 -->    
    
<?php
if (isset($_COOKIE['user']))
{
?>    
  <div class="container">
    <h1>Welcome, <font color="green" style="font-style:italic"><?php echo $_COOKIE['user']; ?></font></h1>
    <p>
      The purpose of this activity is
      to help you practice and experience state management mechanism in PHP.      		       
      You will use cookies to maintain information (i.e., state) among HTTP requests.
    </p>
    <p>
      To complete this activity, you will implement an online survey. 
      The survey consists of at least 4 questions, each of which is displayed on a separated screen.
      You are free to create any questions of your choices. 
      The only constraint is that the questions must be appropriate for college students and classroom environment.
    </p>
    <p>
      You may format the screens as you wish as long as you
      follow the usability guidelines from class. Get creative. 
      Feel free to add additional elements you feel should be included and have fun!
    </p>
    <p>
      Let's <a href="question1.php" title="This link does not work now. Question must be implemented">start the survey</a>.
      <br/><br/>
      Or <a href="logout.php">log out</a>.     
    </p>
<?php 

// Let's see what cookies have been set so far
   if (count($_COOKIE) > 0)
   {
	   //echo "So far, \$_COOKIES contains <font color=\"green\" style=\"font-style:italic\">";   
      echo '<dl>';
      foreach ($_COOKIE as $key => $value)
      {
         echo "<dt>Key: $key";
         echo "<dd>Value: $value";
      }
      echo '</dl><hr />';
      var_dump($_COOKIE);
   }
}
else   // not logged in yet
{   
	// Force login. It's always a good idea to force login in an app that requires user to login before using the services.
	// Check if the user has logged in.
	// One way is to ensure that username is stored in a cookies after succesful login.
	// If the username is not in $_COOKIE, redirect to the login page.
	
	// note: every component (.php) should check and force login
	// to ensure that a user does not jump in the middle of the app via a bookmark or url rewriting
	// and break the flow of execution of the app
  
   // Redirect to the login page
   header('Location: login.php');  // redirect to the login page
}
?>

 
  
</div>
  
  <br/>
</body>
</html>