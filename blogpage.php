<?php
include("bootstrap.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="Blog">Top bar</div>
            <div class="navbar-menu">
                <div class="navbar-link">
                    <a href="#">Account</a>
                    <a href="#">Settings</a>
                </div>
            </div>
            </div>
    </header>

    <div class="container">
        <h1>Welcome to your blog page</h1>
        <!-- Blog posts go here -->
    </div>
    <main class="container">
        <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
            <div class="col-lg-6 px-0">
                <h1 class="display-4 fst-italic">Title of a longer featured blog post</h1>
                <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and
                    efficiently about what’s most interesting in this post’s contents.</p>
                <p class="lead mb-0"><a href="#" class="text-body-emphasis fw-bold">Continue reading...</a></p>
            </div>
        </div>

        <button id="new-post-btn">+</button>
</body>

</html>