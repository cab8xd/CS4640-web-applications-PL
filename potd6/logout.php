<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  
  <title>PHP State Maintenance (Cookies)</title>    
</head>
<body>

<?php session_start(); ?>

  <div class="container">
    <h1>CS4640 Survey</h1>
    Successfully logged out 
  </div>
<!-- Two ways to remove: completely remove entire instance or remove each thing in that instance -->

<?php
if (count($_SESSION) > 0)
{
  foreach (($_SESSION) as $k => $v) // remove key-value pair from a session object (server)
  {
    unset($_SESSION[$k]);
    // but does not remove from cookie file 
  }
  session_destroy(); // completely remove instance 
  echo "sessionID = " . session_id() . "<br/>";

  // to COMPLETELY remove session ID -- you need to remove it from the COOKIE on client side. 
  // setcookie('PHPSESSION', "", time()-3600, "/"); // removes from the past...?
  // ID doesn't exist on server anymore, anyway so this isn't really necessary. 
}
?>


</body>
</html>
