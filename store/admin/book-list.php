<?php include("confs/auth.php") ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Book Store</title>
  <link rel="stylesheet" href="css/style.css">
  <!-- Web Font -->
  <script>
  (function(d) {
    var config = {
      kitId: 'ouh6knv',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f%7C%7Ca&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
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