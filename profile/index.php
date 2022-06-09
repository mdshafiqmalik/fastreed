<?php
session_start();
$GLOBALS['containerStart'] = '<div id="" class="container">';
$GLOBALS['divStop'] = '</div>';
$selfProfile = '
<!-- Self Profile Opened -->
  <div class="authorProfile">
    <div class="topDiv">
      <div class="authorPic"> <img src="../uploads/users/2022/7/25316534.jpg" alt=""> </div>
      <div class="authorDetails">
        <div class="userNameWork">
          <span id="userFullName">Jhon Doe</span>
          <span id="userType">Administator</span>
          <span class="designation">Alaska, USA</span>
          <span class="designation">Joined 23-02-2022</span>
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
<!-- Self Profile Closed -->';
$featuredArticle = '<!-- Featured Article Opened -->
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
<!-- Featured Article Closed -->';
$channels = '<!-- Channels Open -->
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
<!-- Channels Close -->';

$articles = '<!-- Popular Articles Open -->
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
<!-- Popular Articles Close -->';
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <head>
      <meta charset="utf-8">
      <?php include '../components/randVersion.php' ?>
      <link rel="stylesheet" href="../users/src/style.css?v=<?php echo($randVersion); ?>">
      <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo($randVersion); ?>">
      <link rel="stylesheet" href="../users/src/profile.css?v=<?php echo($randVersion); ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <div class="navigation">
      <span> <a id="backArrow" href="../">&#171;  <span>Back</span></a> </span>
    </div>
    <?php
    if(isset($_COOKIE['userID'])) {
      include '../_.config/sjdhfjsadkeys.php';
      $dUserID = openssl_decrypt ($_COOKIE['userID'], $ciphering,
      $decryption_key, $options, $decryption_iv);
      $_SESSION["userID"] = $dUserID;
      if (checkUserID($_SESSION["userID"])) {
        renderProfile($_SESSION['userID']);
      }else {
        echo '<script type="text/javascript">
          document.location = "../login";
        </script>';
      }
    }elseif(isset($_SESSION['userID'])) {
      if (checkUserID($_SESSION["userID"])) {
        renderProfile($_SESSION['userID']);
      }else {
        echo '<script type="text/javascript">
          document.location = "../login";
        </script>';
      }
    }else {
      echo '<script type="text/javascript">
        document.location = "../login";
      </script>';
    }

function checkUserID($dUserID){
  include '../_.config/_s_db_.php';
  $link = new mysqli("$hostName","$userName","$passWord","$dbName");
  $checkUserID = "SELECT userID FROM fast_users Where userID = '$dUserID'";
  $userDat = mysqli_query($link, $checkUserID);

  if (mysqli_num_rows($userDat)) {
    $exist = true;
  }else {
    setcookie("userID", "", time()-3600);
    $exist = false;
  }
  return $exist;
}


  function renderProfile($UID){
    include '../_.config/_s_db_.php';
    $link = new mysqli("$hostName","$userName","$passWord","$dbName");
    $getUserData = "SELECT * FROM user_credentials Where userID = '$UID'";
    $result = mysqli_query($db,$getUserData);
    if (mysqli_num_rows($result)) {
      $row = $result->fetch_assoc();
      $userFullName = $row['userFullName'];
      $userJoinDate = $row['userJoiningDate'];
      $upp = unserialize($row['userProfilePic']);
      $userCountry = $row['userCountry'];
      switch ($row['userType']) {
        case '0':
          $userType = "Reader";
          break;
        case '1':
          $userType = "Author";
          break;
        case '2':
          $userType = "Administator";
          break;
        default:
          $userType = "Reader";
          break;
      }
      $getPost = "SELECT * FROM fast_posts WHERE userID ='$UID'";
      $postData = mysqli_query($link, $getPost);
      $postsCount = mysqli_num_rows($postData);

      $getFollow = "SELECT * FROM fast_follows WHERE toUserID ='$UID'";
      $followData = mysqli_query($link, $getFollow);
      $followCount = mysqli_num_rows($followData);

      $getRating = "SELECT * FROM fast_rating WHERE toUserID ='$UID'";
      $rateData = mysqli_query($link, $getRating);
      $rateCount = mysqli_num_rows($rateData);
      $totalRating = 0;
      while ($row = $rateData->fetch_assoc()) {
        $totalRating += $row['rateUser'];
      }
      // $rateDec = $totalRating/$rateCount;
      // $rate = number_format((float)$rateDec, 1, '.','');


      echo $GLOBALS['containerStart'];
      echo '
      <!-- Self Profile Opened -->
        <div class="authorProfile">
          <div class="topDiv">
            <div class="authorPic"> <img src="../uploads/'.$upp['folder'].'/'.$upp['year'].'/'.$upp['month'].'/'.$upp['id'].'.'.$upp['ext'].'" alt=""> </div>
            <div class="authorDetails">
              <div class="userNameWork">
                <span id="userFullName">'.$userFullName.'</span>
                <span id="userType">'.$userType.'</span>
                <span class="designation">'.$userCountry.'</span>
                <span class="designation">Joined '.$userJoinDate.'</span>
              </div>
              <div class="userParam">
                <div class="userArticles">
                  <span class="userParameters">Articles</span>
                  <span class="values">'.$postsCount.'</span>
                </div>
                <div class="userFollowers">
                  <span class="userParameters">Follows</span>
                  <span class="values">'.$followCount.'</span>
                </div>
                <div class="userRating">
                  <span class="userParameters">Rating</span>
                  <span class="values">9</span>
                </div>
              </div>
            </div>
          </div>
          <div class="bottomDiv">
            <div id="linkOne"class="linkOne"> <span class="links"> <a href="../logout.php">Logout</a></span> </div>
            <div id="linkTwo" class="linkOne"> <span class="links"> <a href="#">Settings</a> </span> </div>
          </div>
        </div>
      <!-- Self Profile Closed -->';
    }
    echo $GLOBALS['divStop'];
    }
     ?>
  </body>
</html>
