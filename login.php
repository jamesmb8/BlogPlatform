<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
         <nav class="navbar">
            <div class="navbar-title">Blog</div>
            <div class="navbar-menu">
                <a href="signup.php" class="navbar-link">Sign up</a>
            </div>
        </nav>
    
</header>
    <div class="container">
        <form class="login-form" action="#" method="POST">
            <h2>Login</h2>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button href="blogpage.php" type="submit">Login</button>
            <div class="signup-link">
               
            </div>
        </form>
    </div>
</body>
</html>
