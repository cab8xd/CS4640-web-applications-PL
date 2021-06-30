<?php
require('connectdb.php');
require('todo-db.php');

$action = "list_tasks";        // default action
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />  
  <title>PHP and database</title>    
  <style>
    label { width: 120px; }
    textarea { border:1px solid #ddd; }
  </style>
</head>
<body>
  
  <div class="container">
    <h1>My ToDo </h1>

<?php
$task_to_update = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
   include('addTask_form.php');
   echo "<hr/>";
   $tasks = getAllTasks();
   include('viewTask.php');        // default action
}
else if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
   if (!empty($_POST['action']) && ($_POST['action'] == 'Update'))
   {
      $task_to_update = getTaskInfo_by_id($_POST['task_id']);		
      include('updateTask_form.php');
      if (!empty($_POST['taskdesc']) && !empty($_POST['duedate']) && !empty($_POST['priority']))
      {
         updateTaskInfo($_POST['taskdesc'], $_POST['duedate'], $_POST['priority'], $_POST['task_id']);
         header("Location: main.php?action=list_tasks");
      }
   }
   else if (!empty($_POST['action']) && ($_POST['action'] == 'Add'))
   {
      if (!empty($_POST['taskdesc']) && !empty($_POST['duedate']) && !empty($_POST['priority']))
      {
         addTask($_POST['taskdesc'], $_POST['duedate'], $_POST['priority']);
         header("Location: main.php?action=list_tasks");
      }
   }
   else if (!empty($_POST['action']) && ($_POST['action'] == 'Delete'))
   {
      if (!empty($_POST['task_id']) )
      {
         deleteTask($_POST['task_id']);
         header("Location: main.php?action=list_tasks");
      }
   }
}
?>
      
  </div>
 
  
</body>
</html>
