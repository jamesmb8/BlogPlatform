<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Facebook Post Box Clone | CodingNepal</title>
  <link rel="stylesheet" href="createpost.css">
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
              <p>User</p>
              
            </div>
          </div>
          <textarea placeholder="What's on your mind?" spellcheck="false" name="postt" required></textarea>
         
          
          <button>Post</button>
        </form>
      
    </div>
  </div>

  <script>
    const container = document.querySelector(".container"),
      privacy = container.querySelector(".post .privacy"),
      arrowBack = container.querySelector(".audience .arrow-back");

    privacy.addEventListener("click", () => {
      container.classList.add("active");
    });

    arrowBack.addEventListener("click", () => {
      container.classList.remove("active");
    });
  </script>

</body>

</html>