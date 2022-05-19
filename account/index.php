<?php
session_start();
 ?>
<!DOCTYPE html>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <?php include '../components/randVersion.php' ?>
    <link rel="stylesheet" href="src/style.css?v=<?php echo($randVersion); ?>">
    <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo($randVersion); ?>">
    <link rel="stylesheet" href="src/logged.css?v=<?php echo($randVersion); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>

  <div class="navigation">
    <span> <a id="backArrow" href="/">&#171;  <span>Back</span></a> </span>
  </div>
  <script type="text/javascript">
var height = window.innerHeight;
var width = window.innerWidth;
document.write("height: "+height);
document.write(" width: "+width);
  </script>

<!-- Author Profile -->
  <div id="" class="container">
    <div class="authorProfile">
      <div class="topDiv">
        <div class="authorPic"> <img src="../uploads/users/2022/7/25316532.jpg" alt=""> </div>
        <div class="authorDetails">
          <div class="userNameWork">
            <span id="userFullName">Shafiq Malik</span>
            <span id="userType">Administator</span>
          </div>
          <div class="userParam">
            <div class="userArticles">
              <span class="userParameters">Articles</span>
              <span class="values">239</span>
            </div>
            <div class="userFollowers">
              <span class="userParameters">Follows</span>
              <span class="values">12M</span>
            </div>
            <div class="userRating">
              <span class="userParameters">Rating</span>
              <span class="values">9.8</span>
            </div>
          </div>
        </div>
      </div>
      <div class="bottomDiv">
        <div id="linkOne"class="linkOne"> <span class="links">Create</span> </div>
        <div id="linkTwo" class="linkOne"> <span class="links">Edit</span> </div>
        <!-- <div class="linkTwo"><span class="links">Follow</span></div> -->
      </div>
    </div>
    <div class="featuredArticle content">

    </div>
  </div>

</div>
  <script src="src/fun.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  </body>
</html>
