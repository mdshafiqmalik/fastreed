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
    <link rel="stylesheet" href="src/profile.css?v=<?php echo($randVersion); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>

  <div class="navigation">
    <span> <a id="backArrow" href="/">&#171;  <span>Back</span></a> </span>
  </div>

<!-- Author Profile Opened -->
<!-- <div id="" class="container">
  <div class="authorProfile">
    <div class="topDiv">
      <div class="authorPic"> <img src="../uploads/users/2022/7/25316534.jpg" alt=""> </div>
      <div class="authorDetails">
        <div class="userNameWork">
          <span id="userFullName">Jhon Doe</span>
          <span id="userType">Administator</span>
          <span class="designation">Alaska, USA</span>
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
      <div id="linkOne"class="linkOne"> <span class="links">Follow</span> </div>
      <div id="linkTwo" class="linkOne"> <span class="links">Rate</span> </div>
    </div>
  </div> -->
<!-- Author Profile Closed -->
<div id="" class="container">
  <div class="authorProfile">
    <div class="topDiv">
      <div class="authorPic"> <img src="../uploads/users/2022/7/25316534.jpg" alt=""> </div>
      <div class="authorDetails">
        <div class="userNameWork">
          <span id="userFullName">Jhon Doe</span>
          <span id="userType">Administator</span>
          <span class="designation">Alaska, USA</span>
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
      <div id="linkOne"class="linkOne"> <span class="links"> <a href="#">Create</a></span> </div>
      <div id="linkTwo" class="linkOne"> <span class="links"> <a href="#">Settings</a> </span> </div>
    </div>
  </div>
<!-- Self Profile Opened -->

<!-- Self Profile Closed -->

<!-- Featured Article Opened -->
  <div class="featuredArticle">
    <span class="title">Featured Article</span>
    <div class="featuredPost">
      <span class="post">Hi Guys What are you doing I am here to make an egg</span>
      <div class="fpdetail">
        <span class="channelName">Fast Hub</span>
        <span class="fpDot">&#x2022;</span>
        <span class="pubTime">1 hour Ago</span>
      </div>
    </div>
  </div>
<!-- Featured Article Closed -->

<!-- Channels Open -->
  <br>
  <hr>
  <br>
  <div class="channelsDiv">
    <span class="title">Channels</span>
    <div class="channel">
      <div class="channels">
        <div class="channelImg">
          <img src="../uploads/posts/2022/7/67895436.jpg" alt=" ">
        </div>
        <div class="channelDetail">
          <span class="channelName">Dream Hub</span>
          <span class="articlesCount">1.6K Articles</span>
          <div class="channelButtons"> <a href="#">Subscribe</a> </div>
        </div>
      </div>
      <div class="channels">
        <div class="channelImg">
          <img src="../uploads/posts/2022/7/67529813.jpg" alt=" ">
        </div>
        <div class="channelDetail">
          <span class="channelName">The Living Society</span>
          <span class="articlesCount">160 Articles</span>
          <div class="channelButtons"> <a href="#">Subscribe</a> </div>
        </div>
      </div>
    </div>
  </div>
<!-- Channels Close -->
<br>
<hr>
<br>
<!-- Popular Articles Open -->
  <div class="popularArticles">
    <div class="top">
      <select class="title select" name="filterOpt" id="filterOpt">
        <option value="">Latest </option>
        <option value="trending">Popular</option>
        <option value="newlyAdded">Newest</option>
      </select>
      <span class="title">Articles</span>
    </div>

    <div class="posts cont500">
      <div class="postBody">
        <div class="postPic"> <img src="/uploads/posts/2022/7/12095427.jpg" alt=""> </div>
        <div class="postTitle"><a href="" id="postTitle" href=""> How to get a full detail of your</a></div>
        <div class="extFoot">
          <span class="meta"><a id="channelName"  href="">Fast Hub</a></span>
          <p class="dot">&#x2022;</p>
          <span   class="meta"><a id="authorName" href="">Jhon Doe</a></span>
          <p class="dot">&#x2022;</p>
          <span id="pubTime" class="meta">1hr Ago</span>
        </div>
      </div>
      <div class="postFooter">
        <div class="footItems" id="react">
          <div id="like" class="react"><img  class="footImages"  src="/assets/pics/svgs/thumbs-up.svg" alt=""></div>
          <div id="likeCount" class="react rt footImages fontFam b sm ml_d4em">1</div>
        </div>
        <div class="footItems" >
          <img id="comment"class="footImages"  src="/assets/pics/svgs/comment_notFilled_2.svg" alt="">
          <div id="comentCount" class=" react rt footImages fontFam b sm ml_d4em">13</div>
        </div>
        <div class="footItems" id="share">
          <img  class="footImages" src="/assets/pics/svgs/share_en.svg" alt="">
        </div>
      </div>
    </div>
  </div>
<!-- Popular Articles Close -->

</div>

</div>
  <script src="src/fun.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  </body>
</html>
