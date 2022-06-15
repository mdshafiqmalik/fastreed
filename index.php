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
      .top{
        position: absolute;
        min-height: 100vh;
        height: 100%;
        max-width: 500px;
        width: 100%;
        background-color: white;
        z-index: 9999;
        display: flex;
        align-items: center;
        flex-direction: column;
        overflow: hidden;
      }
      .top2{
        width: 100%;
        height: 100%;
        padding-bottom: .6em;
        overflow: scroll;
      }
      .top3{
        height: auto;
        width: 100%;
        padding-bottom: 3em;
      }
        .settings{
          width: 100%;
          max-width: 500px;
        }
        .gotoprofile{
          display: flex;
          align-items: center;
          border-bottom: 1px solid #eee;
          padding: 0.5em 1.6em;
        }
        .gotoprofile img{
          border-radius: 5px;
          border: 1px solid #aaa;
        }
        .gotoprofile span{
          margin-left: 1em;
          display: flex;
          flex-direction: column;
          justify-content: center;
        }
        .gotoprofile span p{
          height: 100%;
        }
        .gotoprofile span #name{
          padding: .2em 0;
          font-size: 1.3em;
          font-weight: bold;
        }
        .gotoprofile span #profilelink{
          color:  #444;
          text-decoration: none;
          padding: .2em 0;
        }
        .profile #username{
          background: none;
          font-weight: bold;
          font-size: 1.1em;
          margin-top: .3em;
        }
        .options p{
          font-size: 1.1em;
          font-weight: bold;
          padding: .8em 1.6em;
          background: white;
          color: #444;
          border-bottom: 1px solid #eee;
          display: flex;
          align-items: center;
        }
        .options span{
          width: 100%;
        }
        .options p img{
          right: 1.6em;
        }
        .setting_icon{
          margin-right: .4em;
          width: 25px;
          height: 25px;
          border-radius: 8px;
        }

      </style>
  </head>
  <body style="overflow:hidden">
    <div class="top">
      <div style=" border:1px solid #eee; font-weight: bold;flex-direction:row-reverse;" class="navigation">
        <span style=" margin-right: 1.2em;font-size: 1.5em;"> &#9587; </span>
      </div>

      <div class="top2">
        <div class="top3">
          <div class="settings gotoprofile">
            <img width="45px" height="60px"src="uploads/users/default/female/open_head.jpg" alt="">
            <span>
              <p id="name">Jhon Doe</p>
              <a id="profilelink" href="#">View Your Profile</a>
            </span>
          </div>

          <div class="settings options">
            <p> <span>Edit Profile</span>   <img width="20px" height="15px"src="assets/pics/svgs/forward.svg" alt=""></p>

          </div>
          <div class="settings options">
            <p> <span> Channels</span> <img width="20px" height="15px"src="assets/pics/svgs/forward.svg" alt=""></p>

          </div>
          <div class="settings options">
            <p> <span>Notification</span>  <img width="20px" height="15px"src="assets/pics/svgs/forward.svg" alt=""></p>

          </div>

          <div class="settings options">
            <p> <span>Edit Login Details</span>  <img width="20px" height="15px"src="assets/pics/svgs/forward.svg" alt=""></p>
          </div>
          <div class="settings options">
            <p> <span>Services</span>  <img width="20px" height="15px"src="assets/pics/svgs/forward.svg" alt=""></p>
          </div>
          <div class="settings options">
            <p> <span>Contact Us </span> <img width="20px" height="15px"src="assets/pics/svgs/forward.svg" alt=""></p>
          </div>
          <div class="settings options">
            <p> <span> Privacy Policy </span>  <img width="20px" height="15px"src="assets/pics/svgs/forward.svg" alt=""></p>
          </div>

          <div class="settings options">
            <p> <span>Help and Feedback</span>  <img width="20px" height="15px"src="assets/pics/svgs/forward.svg" alt=""></p>
          </div>
          <div class="settings options">
            <p> <span>Log Out</span>  <img width="20px" height="15px"src="assets/pics/svgs/forward.svg" alt=""></p>
          </div>
        </div>
      </div>
    </div>


    <!-- <div class="hes">

      <div style="border: 1px solid #ddd;" class="navigation">
      <span> <a id="backArrow" href="../">&#171;</a> </span>
      </div>

      <div class="set">
        <div class="contain">

        </div>

      </div>
    </div> -->
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
</html>
