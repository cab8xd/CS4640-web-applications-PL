<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  
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
    <h3>Question 1: What did you have for lunch?</h3>
       
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">      
      <input type="text" name="lunch" class="form-control" autofocus required /> <br />
      <input type="submit" value="Submit" class="btn btn-light"  />   
    </form>
  </div>
<?php 
}
else 
   header('Location: login.php');   // force login
?>

<?php 
if (isset($_POST['lunch']))
{
   // Set cookies 
   $yourlunch = $_POST['lunch'];
   setcookie('lunch', $yourlunch);
   
   // Then redirect to the next page
   header('Location: question2.php');
}
?>


</body>
</html>
