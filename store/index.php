<?php
session_start();
include("admin/confs/config.php");
// $cart = 0;
// if(isset($_SESSION['cart'])) {
//  foreach($_SESSION['cart'] as $qty) {
//    $cart += $qty;
//  }
// }
if(isset($_GET['cat'])) {
 $cat_id = $_GET['cat'];
 $book = mysqli_query($conn, "SELECT * FROM book WHERE category_id =
  $cat_id");
} else {
  $book = mysqli_query($conn, "SELECT * FROM book");
}
$cats = mysqli_query($conn, "SELECT * FROM categories");
?>
<!doctype html>
  <html>
  <head>
   <title>Book Store</title>
   <link rel="stylesheet" href="css/style.css">
 </head>
 <body>
   <h1>Book Store</h1>
   <div class="sidebar">
     <ul class="cats">
       <li>
         <b><a href="index.php">All Categories</a></b>
       </li>
       <?php while($row = mysqli_fetch_assoc($cats)): ?>
         <li>
           <a href="index.php?cat=<?php echo $row['id'] ?>">
             <?php echo $row['name'] ?>
           </a>
         </li>
       <?php endwhile; ?>
     </ul>
   </div>
   <div class="main">
    <ul class="books">
      <?php while($row = mysqli_fetch_assoc($book)): ?>
         <li>
           <img src="admin/covers/<?php echo $row['cover'] ?>" height="150">
           <b>
             <a href="book-detail.php?id=<?php echo $row['id'] ?>">
               <?php echo $row['title'] ?>
             </a>
           </b>
           <i>$<?php echo $row['price'] ?></i>
           </li>
         <?php endwhile; ?>
       </ul>
     </div>
     <div class="footer">
       &copy; <?php echo date("Y") ?>. All right reserved.
     </div>
   </body>
   </html>