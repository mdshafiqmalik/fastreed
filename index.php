<?php
include 'account/session.php';
include 'components/randVersion.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="assets/css/style.css?v=<?php echo $randVersion; ?>">
      <link rel="stylesheet" href="assets/css/root.css?v=<?php echo $randVersion; ?>">
      <script src="assets/js/fun.js?v=<?php echo $randVersion; ?>" charset="utf-8"></script>
      <title>Fastreed : Read, Write and Learn</title>
  </head>
  <body>
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
      <?php include 'posts.php'; ?>
    </div>
  </body>
</html>
