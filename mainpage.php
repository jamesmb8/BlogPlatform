<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="style.css">
   
</head>

<body>

    <nav>
        <div class="nav-left">
            <a href="index.html"><img src="images/bluelogo.png" class="logo"></a>
           
        </div>

        <div class="nav-right">


            <div class="nav-user-icon online" onclick="settingsMenuToggle()">
                <img src="images/User-image.png">
            </div>

        </div>
        <!-- ------dropdown-settings-menu--------- -->
        <div class="settings-menu">
            <div id="dark-btn">
                <span></span>
            </div>
            
                   
                
               
                </div>
                <div class="settings-links">
                    <img src="images/setting.png" class="settings-icon">
                    <a href="">Settings & Privacy <img src="images/arrow.png" width="10px"></a>
                </div>
                
                
                </div>
                <div class="settings-links">
                    <img src="images/logout.png" class="settings-icon">
                    <a href="">Logout <img src="images/arrow.png" width="10px"></a>
                </div>
            </div>

        </div>
    </nav>
    <div class="container">
        <div class="left-sidebar">
            <div class="imp-links">
               
                <a href="#"><img src="images/friends.png"> Friends</a>
               
            
            </div>
           
        </div>
        <!----------------- middle content--------- -->
        <div class="main-content">
            <div class="story-gallery">
               
                
               
               
               
            </div>

            <div class="write-post-container">
                <div class="user-profile">
                    <img src="images/profile-pic.png">
                    <div>
                        <p>User</p>
                        <small>Public <i class="fas fa-caret-down"></i></small>
                    </div>
                </div>

                <div class="post-input-container">
                    
                    <div class="add-post-links">
                       
                  
                        <a href="createpost.php" button type="button" class="upload-btn">Make a post</button>
                       
                    </div>
                </div>

            </div>
            <div class="post-container">
                <div class="post-row">
                     <!-- ----------posts----------- -->
                  
                    </div>
                </div>

            </div>

            

        </div>
       
        <div class="right-sidebar">
            <div class="sidebar-title">
             
            </div>

           
                </div>
            </div>

            
               
            </div>

            


        </div>
    </div>
    

    <script src="script.js"></script>
</body>

</html>