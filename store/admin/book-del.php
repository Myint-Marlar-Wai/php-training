<?php
 include("confs/config.php");
 $id = $_GET['id'];
 $sql = "DELETE FROM book WHERE id = $id";
 mysqli_query($conn, $sql);
 header("location: book-list.php");
?>