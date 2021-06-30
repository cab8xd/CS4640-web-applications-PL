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

<?php 
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
    // require('connect-db.php');
    global $db;

   $query = "CREATE TABLE courses (
             courseID VARCHAR(8) PRIMARY KEY,
             course_desc VARCHAR(255) NOT NULL )";
//    $query = "CREATE TABLE courses (
//              courseID VARCHAR(8),
//              course_desc VARCHAR(20) NOT NULL )";
   $statement = $db->prepare($query);
   $statement->execute();   
   $statement->closeCursor();
}
?>

<?php 
/*************************/
/** drop table **/
function dropTable()
{
   // require('connect-db.php');
   global $db;

//    $query = "DROP TABLE `web4640`.`courses`";
   $query = "DROP TABLE courses";

   $statement = $db->prepare($query);
   $statement->execute();   
   $statement->closeCursor();
}
?>

<?php 
/*************************/
/** insert data **/
function insertData()
{
   // require('connect-db.php');
   global $db;
	
   $course_id = "id1";
   $course_desc = "inserted_course_desc";
   
   $query = "INSERT INTO courses (courseID, course_desc) VALUES (:course_id, :course_desc)";
   $statement = $db->prepare($query);
   $statement->bindValue(':course_id', $course_id);
   $statement->bindValue(':course_desc', $course_desc);
   $statement->execute();
   $statement->closeCursor();
}
?>

<?php  
/*************************/
/** get data **/
function selectData()
{
   // require('connect-db.php');     // require connect-db.php to establish a connection to db, resulting in PDO instance
   // If require connect-db.php here, will get local scope PDO (i.e., $db from connect-db.php)

   // If connect db at the file level, not function level, and plan to use the share PDO instance,
   // make PDO instance global (i.e, $db here refers to $db in connect-db.php that is required outside this function's scope)
   global $db;                       // PDO instance        

   // To prepare a SQL statement, use the prepare() method of the PDO object
   //    syntax:   prepare(sql_statement)

   // To execute a SQL statement, use the bindValue() method of the PDO statement object
   // to bind the specified value to the specified param in the prepared statement 
   //    syntax:   bindValue(param, value)
   // then use the execute() method to execute the prepared statement

   // Execute a SQL statement that doesn't have params
   // $query = "CREATE TABLE `web4640`.`course_info` ( `courseID` VARCHAR(8) NOT NULL , `course_desc` VARCHAR(20) NOT NULL )";
   // $query = "select * from mytable";
   $query = "select * from courses";
   $statement = $db->prepare($query); 
   $statement->execute();

   // fetchAll() returns an array for all of the rows in the result set
   $results = $statement->fetchAll();

   // closes the cursor and frees the connection to the server so other SQL statements may be issued 
   $statement->closecursor();

   foreach ($results as $result)
   {	
      echo $result['courseID'] . ":" . $result['course_desc'] . "<br/>";
   }


   // Execute a SQL statement that has a param, use a colon followed by a param name
//    $someid = "id1";
//    $query = "select * from courses where test_id = :someid";
//    $statement = $db->prepare($query);
//    $statement->bindValue(':someid', $someid);
//    $statement->execute();

//    // fetchAll() returns an array for all of the rows in the result set
//    $results = $statement->fetchAll();

//    // closes the cursor and frees the connection to the server so other SQL statements may be issued
//    $statement->closecursor();

//    foreach ($results as $result)
//    {
//       echo "select a row where courseID=id1 --->" . $result['courseID'] . ":" . $result['course_desc'] . "<br/>";
//    }

// a SELECT statement returns a result set in the PDOStatement object 
}
?>

<?php
/*************************/
/** update data **/
function updateData()
{
   // require('connect-db.php');
   global $db;
	
   $course_id = "id1";
   $course_desc = "updated_from_updateData";

   $query = "UPDATE courses SET course_desc=:course_desc WHERE courseID=:course_id";
//   $query = "UPDATE courses SET course_desc='another-course' WHERE courseID='id1'";    // update the record that has courseID matched
//   $query = "UPDATE courses SET course_desc=:course_desc";       // update every record in the table
   $statement = $db->prepare($query);
   if (!$statement) 
   {
      print_r( $db->errorInfo() );   // Use this for debugging only, don't put this on production site
                                     // It contains the actual table and column names. Thus, they are visible to users (possible security attack)                                           
   }   
   
   $statement->bindValue(':course_id', $course_id);
   $statement->bindValue(':course_desc', $course_desc);
   $result = $statement->execute();
   if ( !$result ) 
   {
      print_r( $statement->errorInfo() );
      exit;
   }   
   $statement->closeCursor();   
}
?>

<?php
/*************************/
/** delete data **/
function deleteData()
{
	// require('connect-db.php');
	global $db;
	
	$course_id = "id1";
	
	$query = "DELETE FROM courses WHERE courseID=:id";
	$statement = $db->prepare($query);
	$statement->bindValue(':id', $course_id);
	$statement->execute();
	$statement->closeCursor();
}
?>


  </div>
</body>
</html>
