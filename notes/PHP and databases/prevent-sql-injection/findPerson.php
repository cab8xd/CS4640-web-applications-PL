<?php 
require('connectdb.php');
require('person_db.php');

$array = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{	
   if (!empty($_POST['action']) && ($_POST['action'] == 'find')) 
   {
      try {
         $array = getPersonInfo($_POST['name']);
      } catch (Exception $e) { 
         echo $e->getMessage(); 	
      }
   }
}

?>




<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">      
  <title>DB interfacing</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="shortcut icon" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" type="image/ico" />  
</head>

<body>
<div class="container">

<h1>Find person's Info</h1>

<form name="mainForm" action="findPerson.php" method="post">
  <div class="form-group">
    Name:
    <input type="text" class="form-control" name="name" required />     
    <br/>
    <font size=-1>(Try to retrieve all persons instead of a particular one/name, using <code>" OR 1=1;</code> &nbsp;
    <br/>or combine the Person table with a table that has the same number of attributes 
    <code>" OR 1=1 UNION SELECT * FROM private;</code>)       
  </div>       
  <input type="submit" value="find" name="action" class="btn btn-dark" title="Find friend's info" />  
</form>  

  
<hr/>
<?php 
foreach ($array as $value): 
  echo "Name: " . $value[0] . "<br/>";
  echo "Email: " . $value[1] . "<br/>";
endforeach; 
?>
</table>
        
</div>    
</body>
</html>
  