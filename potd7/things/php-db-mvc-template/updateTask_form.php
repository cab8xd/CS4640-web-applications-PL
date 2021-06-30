<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
  
  <title>PHP and database</title>    
</head>
<body>
  
  <div class="container">
  <h3>Update course information</h3>
  <br/>
  
  <form action="main.php" method="post">
   <div class="form-group">
      <label for="taskdesc">Task </label>
      <input type="text" name="taskdesc" class="form-control" name="desc" />
   </div>     
   <div class="form-group">
      <label for="duedate">Due date</label>  
      <input type="text" name="duedate" class="form-control" />
   </div>      
   <div class="form-group">
      <label for="priority">Priority</label>
      <select name="priority" class="form-control" >
         <option value=""></option>
         <option value="normal">
            Normal</option> 
         <option value="high">
            High</option>
      </select>
   </div>

   <input type="submit" value="Update" name="action"  class="btn btn-dark" title="Update task" />   
  </form>         
  </div>
</body>
</html>
