<?php include("confs/auth.php") ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Store Admin</title>
  <link rel="stylesheet" href="css/style.css">
  <style type="text/css">
  form label {
    display: block;
    margin-top: 8px;
  }
</style>
</head>
<body>
  <h1>New Category</h1>
  <ul class="menu">
   <li><a href="book-list.php">Manage Books</a></li>
   <li><a href="cat-list.php">Manage Categories</a></li>
   <li><a href="logout.php">Logout</a></li>
 </ul>
 <form action="cat-add.php" method="post">
   <label for="name">Category Name</label>
   <input type="text" name="name" id="name">

   <label for="remark">Remark</label>
   <textarea name="remark" id="remark"></textarea>

   <br><br>
   <input type="submit" value="Add Category">
 </form>

</body>
</html>