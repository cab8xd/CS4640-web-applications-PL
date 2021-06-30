<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">
  <title>PHP State Maintenance (Cookies)</title>    
</head>
<body>

<?php
if (isset($_COOKIE['user']))
{ 
?>       
  <div class="container">
    <div style="float:right; padding:30px;">    
      <form action="logout.php" method="get">
        <input type="submit" value="Log out" class="btn btn-dark" />
      </form>
    </div>    
    
    <h1>Welcome <font color="green" style="font-style:italic"><?php echo $_COOKIE['user'] ?></font> </h1>
    <h3>Question 2: [True or False] State maintenance with Cookies is secure?</h3>
       
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">      
      <!-- Notice that the names of all radio button must be the same to group them, i.e., only option can be selected
           What happen if the names are different ? -->
      <input type="radio" name="cookies_secure" value="true" checked> True<br />
      <input type="radio" name="cookies_secure" value="false"> False <br />
      <input type="submit" value="Submit" class="btn btn-light"  />   
    </form>
    <br/>
    Previous question: you answered <font color="green" style="font-style:italic"><?php echo $_COOKIE['lunch'] ?></font>

  </div>
<?php 
}
else 
   header('Location: login.php');    // force login
?>


<?php 
if (isset($_POST['cookies_secure']))
{
   $cookies_secure = $_POST['cookies_secure'];      // retrieve value for cookies_secure from the form submission 
   setcookie('cookies_secure', $cookies_secure);    // set cookies
      
   header('Location: question3.php');               // then redirect to the next page
}
?>

</body>
</html>
