<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
  
  <title>PHP and MySQL database</title>    
</head>
<body>
  
  <div class="container">
    <h1>PHP and MySQL database</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
      <input type="submit" name="btnaction" value="create" class="btn btn-light" />
      <input type="submit" name="btnaction" value="insert" class="btn btn-light" />   
      <input type="submit" name="btnaction" value="select" class="btn btn-light" />
      <input type="submit" name="btnaction" value="update" class="btn btn-light" />
      <input type="submit" name="btnaction" value="delete" class="btn btn-light" />
      <input type="submit" name="btnaction" value="drop" class="btn btn-light" />            
    </form>


<?php
require('connect-db.php');

// require: if a required file is not found, require() produces a fatal error, the rest of the script won't run
// include: if a required file is not found, include() throws a warning, the rest of the script will run
?>

<?php // form handling if button is clicked and its resulting action. 
if (isset($_GET['btnaction']))
{	
   try 
   { 	
      switch ($_GET['btnaction']) 
      {
         case 'create': createTable(); break;
         case 'insert': insertData();  break;
         case 'select': selectData();  break;
         case 'update': updateData();  break;
         case 'delete': deleteData();  break;
         case 'drop':   dropTable();   break;      
      }
   }
   catch (Exception $e)       // handle any type of exception
   {
      $error_message = $e->getMessage();
      echo "<p>Error message: $error_message </p>";
   }   
}
?>

<?php 
/*************************/
/** create table **/
function createTable()
{
 // pto instance available as long as program is running. 
    global $db; // link to db instance outside of function. 
    $query = "CREATE TABLE courses (
                course_ID VARCHAR(8) PRIMARY KEY,
                course_desc VARCHAR(225) NOT NULL)";// column name - datatype(memory sz)
    $statement = $db->prepare($query); // compiles string query into executable version. 
    $statement->execute();

    $statement->closeCursor(); // when done, release instance so other queries can use this insteance. saves space. 
}
?>

<?php 
/*************************/
/** drop table **/
function dropTable()
{
    global $db; // link to db instance outside of function. 
    $query = "DROP TABLE courses";// column name - datatype(memory sz)
    
    $statement = $db->prepare($query); // compiles string query into executable version. 
    $statement->execute();

    $statement->closeCursor(); // when done, release instance so other queries can use this insteance. saves space. 
}
?>

<?php 
/*************************/
/** insert data **/
function insertData()
{
    global $db; // link to db instance outside of function.

    // $course_id_form = 'cs1110'; // retrieving form. 
    // $course_desc_form = 'Intro';
    
    // makes sure this table already exists so row can be added. 
    $query = "INSERT TABLE courses (
                course_ID,
                course_desc)
                VALUES ('cs4640','webPL')";
    // $query = "INSERT TABLE courses (
    //     course_ID,
    //     course_desc)
    //     VALUES (:course_id, :course_desc)";
    $statement = $db->prepare($query); // compiles string query into executable version. 
    // $statement->bindValue(':course_id', $course_id_form);, etc...
    $statement->execute();

    $statement->closeCursor(); // when done, release instance so other queries can use this insteance. saves space. 
}
?>

<?php  
/*************************/
/** get data **/
function selectData()
{
    global $db; // link to db instance outside of function. 
    $query = "SELECT * FROM courses";// column name - datatype(memory sz)
    
    $statement = $db->prepare($query); // compiles string query into executable version. 
    $statement->execute();

    $results = $statement->fetchAll(); // get arrays of all rows. 
    // fetch() returns an array of one row. 

    $statement->closeCursor(); // when done, release instance so other queries can use this insteance. saves space. 

    foreach ($results as $result){
        echo $result['course_id'] . ":" . $result['course_desc'] . "<br/>";
    }
}
?>

<?php
/*************************/
/** update data **/
function updateData()
{
    global $db; // link to db instance outside of function. 
    $query = "UPDATE TABLE courses SET course_desc 'new webPL' WHERE course_id = cs4640.";
    
    $statement = $db->prepare($query); // compiles string query into executable version. 
    $statement->execute();

    $statement->closeCursor(); // when done, release instance so other queries can use this insteance. saves space. 
}
?>

<?php
/*************************/
/** delete data **/
function deleteData()
{
    global $db; // link to db instance outside of function. 
    $query = "DELETE TABLE courses";// column name - datatype(memory sz)
    
    $statement = $db->prepare($query); // compiles string query into executable version. 
    $statement->execute();

    $statement->closeCursor(); // when done, release instance so other queries can use this insteance. saves space. 
}
?>

  </div>
</body>
</html>