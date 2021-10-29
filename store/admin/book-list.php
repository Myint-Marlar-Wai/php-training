<?php include("confs/auth.php") ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Book Store</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Book List</h1>
  <ul class="menu">
   <li><a href="book-list.php">Manage Books</a></li>
   <li><a href="cat-list.php">Manage Categories</a></li>
   <li><a href="logout.php">Logout</a></li>
 </ul>
 <?php
 include("confs/config.php");

 $result = mysqli_query($conn, "
   SELECT book.*, categories.name
   FROM book LEFT JOIN categories
   ON book.category_id = categories.id
   ORDER BY book.created_date DESC
   ");
   ?>
   <ul class="list">
     <?php while($row = mysqli_fetch_assoc($result)): ?>
       <li>
         <img src="covers/<?php echo $row['cover'] ?>"
         alt="" align="right" height="140">
         <b><?php echo $row['title'] ?></b>
         <i>by <?php echo $row['author'] ?></i>
         <small>(in <?php echo $row['name'] ?>)</small>
         <span>$<?php echo $row['price'] ?></span>
         <div><?php echo $row['summary'] ?></div>
         [<a href="book-del.php?id=<?php echo $row['id'] ?>" class="del">del</a>]
         [<a href="book-edit.php?id=<?php echo $row['id'] ?>">edit</a>]
       </li>
     <?php endwhile; ?>
   </ul>
   <a href="book-new.php" class="new">New Book</a>
 </body>
 </html>