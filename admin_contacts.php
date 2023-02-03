<?php
require_once "connection.php";

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
     mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
    //$delete_wishlist = mysqli_query($conn,"DELETE FROM `wishlist` WHERE pid = '$delete_id'");
    //$delete_cart = mysqli_query($conn,"DELETE FROM `cart` WHERE pid = '$delete_id'");
    header('location: admin_contacts.php');

 }; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
     <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="admin_style.css">

</head>
<body>
<?php include 'admin_header.php'; ?>
<section class="messages">

<h1 class="title">messages</h1>

<div class="box-container">
<?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
   ?>
      <div class="box">
      <p> user id : <span><?= $fetch_message['user_id']; ?></span> </p>
      <p> name : <span><?= $fetch_message['name']; ?></span> </p>
      <p> number : <span><?= $fetch_message['number']; ?></span> </p>
      <p> email : <span><?= $fetch_message['email']; ?></span> </p>
      <p> message : <span><?= $fetch_message['message']; ?></span> </p>
      <a href="admin_contacts.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
   </div>
   <?php
     }
    }else{
        echo '<p class="empty">no orders placed yet!</p>';
    }

   ?>

</div>

</section>  
</body>
</html>