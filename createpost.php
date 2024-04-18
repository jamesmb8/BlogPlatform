<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
  // User is not logged in, redirect to login page
  header('Location: login.html');
  exit;
}

// If logged in, retrieve user information from session variables
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$first_name = $_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$email = $_SESSION['email'];
$phone = $_SESSION['phone'];

?>
<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Create Post</title>
  <link rel="stylesheet" href="css/createpost.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- FontAweome CDN Link for Icons -->
 
</head>

<body>
  <div class="container">
    <div class="wrapper">
      <section class="post">
        <header>Create Post</header>
        <form action="createdpostdb.php" method="POST">
          <div class="content">
          
            <div class="details">
              <p><?php echo $_SESSION['username']; ?></p>
              
            </div>
          </div>
          <textarea placeholder="What's on your mind," <?php echo $_SESSION['first_name']; ?> spellcheck="false" name="post_text" id="post_text"required></textarea>
         
          
          <button>Post</button>
        </form>
      
    </div>
  </div>

  
</body>

</html>