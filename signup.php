<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
   <header>
    <nav class="navbar">
            <div class="navbar-title">Blog</div>
            <div class="navbar-menu">
                <a href="login.php" class="navbar-link">Login</a>
            </div>
        </nav>
    
</header>
    <div class="container">
        <form class="signup-form" action="phpfunctions//userquery.php" method="POST">
            <h2>Sign Up</h2>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
             <div class="form-group">
                <label for="phone">Phone number:</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="submit">Sign Up</button>
            <div class="login-link">

            
            
            <?php 

            if(isset($_POST["submit"]))
            {
                if(isset($_POST["first_name"]) and isset($_POST["last_name"]) and isset($_POST["email"])and isset ( $_POST["phone"]) and isset($_POST["password"]))
                {
                    include_once("phpfunctions/userquery.php");
                    createuser($_POST["first_name"] and $_POST["last_name"] and $_POST["password"] and $_POST["email"] and $_POST["phone"]);
                
                }

            }
            ?>

     
          
        </form>
    </div>
</body>
</html>