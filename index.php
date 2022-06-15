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
        .settings{
          width: 100%;
          max-width: 500px;
        }
        .settings .profile{
          background: #eee;
          min-height: 12em;
          display: flex;
          justify-content: center;
          align-items: center;
          flex-direction: column;
        }
        .settings .profile img{
          border: 7px solid white;
          outline: 0;
          border-radius: 80px;
        }
        .label{
          background: #eee;
        }
        .label p{
          color:#444;
          font-weight: bold;
          padding: .7em;
          padding-left: 1em;
        }
        .options p{
          font-weight: bold;
          padding: .7em;
          padding-left: 1.6em;
          background: white;
          color: #444;
          border-bottom: 1px solid #eee;
        }
      </style>
  </head>
  <body>
    <div class="">
      <div style="background:#eee; border: 1px solid #ddd;" class="navigation">
      <span> <a id="backArrow" href="../">&#171;</a> </span>
     </div>
    <div class="settings">
      <div class="profile">
        <img height="100px" width="100px" src="uploads/users/default/female/cropped_open_head.jpg" alt="">
      </div>
    </div>

    <div class="settings label">
      <p>Accounts</p>
    </div>

    <div class="settings options">
      <p>Edit Profile</p>
    </div>
    <div class="settings options">
      <p>Channels</p>
    </div>
    <div class="settings options">
      <p>Notification</p>
    </div>

    <div class="settings options">
      <p>Edit Login Details</p>
    </div>
    <div class="settings label">
      <p>Others</p>
    </div>
    <div class="settings options">
      <p>Terms</p>
    </div>
    <div class="settings options">
      <p>Privacy Policy</p>
    </div>
    <div class="settings options">
      <p>Contact Us</p>
    </div>
    <div class="settings options">
      <p>Help and Feedback</p>
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
</html>
