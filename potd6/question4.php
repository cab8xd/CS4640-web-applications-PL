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
    <h3>Question 4: Choose a direction </h3>
       
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
      
      <!-- Notice that the names of all radio button must be the same to group them, i.e., only option can be selected
           What happen if the names are different ? -->
      <input type="radio" name="favorite_dir" value="Upsorn" checked> North <br />
      <input type="radio" name="favorite_dir" value="Upsorn P"> South <br />
      <input type="radio" name="favorite_dir" value="Upsorn Praphamontripong" > East <br />
      <input type="radio" name="favorite_dir" value="Upsorn Praphamontripong" > West <br />
      <input type="submit" value="Finish and logout" class="btn btn-light"  />   
    </form>
    <p/> Previous question: you answered <?php if (isset($_SESSION['youricecream'])) echo $_SESSION['youricecream']?>
 <?php
if (isset($_POST['favorite_dir']))
{
  $_SESSION['yourfavorite_dir'] = $_POST['favorite_dir'];
  header('Location: logout.php'); 
}
?>
    
    
</body>
</html>
