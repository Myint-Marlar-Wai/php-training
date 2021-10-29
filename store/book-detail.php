<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Book Store</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Book Detail</h1>
  <?php
  include("admin/confs/config.php");
  $id = $_GET['id'];
  $book = mysqli_query($conn, "SELECT * FROM book WHERE id = $id");
  $row = mysqli_fetch_assoc($book);
  ?>
  <div class="detail">
    <a href="index.php" class="back">&laquo; Go Back</a>
    <div class="img-sec">
      <img src="admin/covers/<?php echo $row['cover'] ?>">
    </div>
    <h2><?php echo $row['title'] ?></h2>
    <i>by <?php echo $row['author'] ?></i>,
    <b>$<?php echo $row['price'] ?></b>
    <p><?php echo $row['summary'] ?></p>
 </div>
 <div class="footer">
   &copy; <?php echo date("Y") ?>. All right reserved.
 </div>

</body>
</html>