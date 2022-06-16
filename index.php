<?php
include 'components/randVersion.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="robots" content="noindex">
      <link rel="stylesheet" href="assets/css/style.css?v=<?php echo $randVersion; ?>">
      <link rel="stylesheet" href="assets/css/root.css?v=<?php echo $randVersion; ?>">
      <link rel="stylesheet" href="users/src/style.css?v=<?php echo $randVersion; ?>">
      <script src="assets/js/fun.js?v=<?php echo $randVersion; ?>" charset="utf-8"></script>
      <title>Fastreed : Read, Write and Learn</title>
      <style media="screen">
      .options p img{
        width: 26px;
        height: 28px;
      }
      </style>
  </head>
  <body>
    <div id="top" class="top">


      <div style=" flex-direction:row-reverse;" class="navigation">
        <b><span class="menu"onclick="renderHome()"style=" margin-right: 2.9em; margin-top: 0.4em; "> <img style="height: 34px; width:34px"src="assets/pics/svgs/cancel.svg" alt=""> </span></b>
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
            <p>
              <img class="opt_icons" src="assets/pics/svgs/add_post.svg" alt="">

            <span>Write an article</span>   </p>
          </div>
          <div class="settings options">
            <p>
              <img class="opt_icons" src="assets/pics/svgs/manage_accounts.svg" alt="">
              <span>Update profile</span>   </p>
          </div>
          <div class="settings options">
            <p>
              <img class="opt_icons" src="assets/pics/svgs/channel.svg" alt="">

          <span>Your channels</span>   </p>
          </div>
          <hr>
          <div class="settings options">
            <p>
              <img class="opt_icons" src="assets/pics/svgs/interests.svg" alt="">

              <span>Your interests</span>   </p>
          </div>
          <div class="settings options">
            <p>
              <img class="opt_icons" src="assets/pics/svgs/language.svg" alt="">
               <span>Languages</span>   </p>
          </div>
          <div class="settings options">
            <p>
              <img class="opt_icons" src="assets/pics/svgs/security.svg" alt="">
               <span>Privacy</span>   </p>
          </div>
          <div class="settings options">
            <p>
              <img class="opt_icons" src="assets/pics/svgs/lock.svg" alt="">
               <span>Security & Login</span>  </p>
          </div>
          <hr>
          <div class="settings options">
            <p>
              <img class="opt_icons" src="assets/pics/svgs/policy.svg" alt="">
               <span> Terms & Policy </span>  </p>
          </div>

          <div class="settings options">
            <p>
              <img class="opt_icons" src="assets/pics/svgs/help.svg" alt="">
            <span>Help & Feedback</span>  </p>
          </div>
          <div class="settings options">
            <p>
              <img class="opt_icons" src="assets/pics/svgs/info.svg" alt="">
               <span> About Us</span> </p>
          </div>
          <div class="settings options">
            <p>
              <img class="opt_icons" src="assets/pics/svgs/power.svg" alt="">
              <span>Log Out</span>  </p>
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
