<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  
  <title>PHP State Maintenance (Session)</title>   
</head>
<body>

<?php session_start(); ?>    
  <div class="container">
    <div style="float:right; padding:30px;">    
      <form action="logout.php" method="get">
        <input type="submit" value="Log out" class="btn btn-dark" />
      </form>
    </div>    
    
    <h1>Welcome <font color="green" style="font-style:italic"><?php if (isset($_SESSION['user'])) echo $_SESSION['user']?></font> </h1>
    <h3>Question 3: Favorite ice cream?</h3>
       
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">      
      <input type="text" name="icecream" class="form-control" autofocus required /> <br />
      <input type="submit" value="Submit" class="btn btn-light"  />   
    </form>
    <p/> Previous question: you answered <?php if (isset($_SESSION['yourfavorite_instr'])) echo $_SESSION['yourfavorite_instr']?>
 <?php
if (isset($_POST['icecream']))
{
  $_SESSION['youricecream'] = $_POST['icecream'];
  header('Location: question4.php'); 
}
?>
    
    
</body>
</html>
