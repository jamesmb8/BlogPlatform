<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Basic CSS for posts display */
        .post {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Welcome to Your Dashboard</h1>

    <!-- Container for displaying posts -->
    <div id="postsContainer"></div>

    <script>
        $(document).ready(function () {
            // Fetch posts using AJAX
            $.ajax({
                url: 'phpfunctions/getposts.php',
                type: 'GET',
                success: function (data) {
                    // Parse JSON data
                    var posts = JSON.parse(data);

                    // Display posts on the page
                    if (posts.length > 0) {
                        var postsHtml = '';
                        posts.forEach(function (post) {
                            postsHtml += '<div class="post">';
                            postsHtml += '<p><strong>' + post.member_username + '</strong></p>';
                            postsHtml += '<p>' + post.post_text + '</p>';
                            postsHtml += '<p><small>' + post.post_date + '</small></p>';
                            postsHtml += '</div>';
                        });
                        $('#postsContainer').html(postsHtml);
                    } else {
                        $('#postsContainer').html('<p>No posts found.</p>');
                    }
                },
                error: function () {
                    $('#postsContainer').html('<p>Error fetching posts.</p>');
                }
            });
        });
    </script>
</body>

</html>