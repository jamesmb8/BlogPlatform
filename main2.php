<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Home</title>
    <link rel="stylesheet" href="cgcss.css">
</head>
<body>
    <header>
        
        <?php include 'navbar.php'; ?>
    </header>
     <a href="createpost.php" button id="createPostBtn">Create Post</button>

    <main id="blogPosts">
        <!-- Blog posts will be dynamically populated here -->
    </main>

    <script src="script.js"></script>
</body>
</html>