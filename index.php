<?php
include 'components/randVersion.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="robots" content="noindex">
      <link rel="stylesheet" href="assets/css/style.css?v=<?php echo $_SESSION['randVersion']; ?>">
      <link rel="stylesheet" href="assets/css/root.css?v=<?php echo $_SESSION['randVersion']; ?>">
      <link rel="stylesheet" href="users/src/style.css?v=<?php echo $_SESSION['randVersion']; ?>">
      <script src="assets/js/fun.js?v=<?php echo $_SESSION['randVersion']; ?>" charset="utf-8"></script>
      <title>Fastreed : Read, Write and Learn</title>
      <style media="screen">
      </style>
  </head>
  <body>
    <div id="top" class="top">
      <div style=" border:0; flex-direction:row-reverse;" class="navigation">
        <span onclick="renderHome()"style=" margin-right: 1.5em;font-size: 1.5em;"> &#9587; </span>
      </div>

      <div class="top2">
        <div class="top3">
          <div class="settings gotoprofile">
            <img width="45px" height="60px"src="uploads/users/default/female/open_head.jpg" alt="">
            <span>
              <p id="name">Jhon Doe</p>
              <a id="profilelink" href="#">View your profile</a>
            </span>
          </div>
          <div class="settings options">
            <p> <span>Write an article</span>   </p>
          </div>
          <div class="settings options">
            <p> <span>Update profile</span>   </p>
          </div>
          <div class="settings options">
            <p> <span>Your channels</span>   </p>
          </div>
          <hr>
          <div class="settings options">
            <p> <span>Your interests</span>   </p>
          </div>
          <div class="settings options">
            <p> <span>Languages</span>   </p>
          </div>
          <div class="settings options">
            <p> <span>Privacy</span>   </p>
          </div>
          <div class="settings options">
            <p> <span>Security & Login</span>  </p>
          </div>
          <hr>
          <div class="settings options">
            <p> <span> Terms & Policy </span>  </p>
          </div>

          <div class="settings options">
            <p> <span>Help & Feedback</span>  </p>
          </div>
          <div class="settings options">
            <p> <span> About Us</span> </p>
          </div>
          <div class="settings options">
            <p> <span>Log Out</span>  </p>
          </div>
        </div>
      </div>
    </div>


    <div class="mainCont">
      <!-- include Header -->
    <?php include 'components/header.php';?>
      <!-- Search and Tag -->
      <div class="tagandSearch cont500 ">
        <div class="search">
          <div id="search">
          <span>&#128269;</span>
            <input id="" type="search" name="" value="" placeholder=" Search Here....">
          </div>
        </div>
        <div class="tags">
          <select class="filterOpt" name="filterOpt" id="filterOpt">
            <option value="">Filter </option>
            <option value="trending">Trending</option>
            <option value="mostActive">Channels</option>
            <option value="newlyAdded">Newer</option>
            <option value="atoz">A to Z</option>
          </select>
          <span onclick="allActive()" class="tagActive" id="all">All</span>
          <span class="stags" id="how-to" onclick="goTo('how-to')">how to?</span>
          <span class="stags" id="health" onclick="goTo('health')">health</span>
          <span class="stags" id="blogging" onclick="goTo('blogging')">blogging</span>
          <span class="stags" id="trading" onclick="goTo('trading')">trading</span>
        </div>
      </div>
      <div class="cont500">
      <?php include 'articles.php'; ?>
    </div>
    </div>
  </body>
  <script type="text/javascript">
    function renderHome(){
      var x= document.getElementById('top');
      x.style.display ="none";
      document.getElementsByTagName('body')[0].style.overflow = 'scroll';
    }
     function renderMenu(){
       var x= document.getElementById('top');
       x.style.display ="flex";
       document.getElementsByTagName('body')[0].style.overflow = 'hidden';
     }
  </script>
</html>
