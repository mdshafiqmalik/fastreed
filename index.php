<?php
$writeArticles = '  <!-- Write an article  -->
  <div class="settings options">
    <p>
      <img class="opt_icons" src="assets/pics/svgs/articles.svg" alt="">
    <span> <a href="#">Write an article</a> </span>   </p>
  </div>';
$updateProfile = '<!-- Update Profile -->
<div class="settings options">
  <p>
    <img class="opt_icons" src="assets/pics/svgs/manage_accounts.svg" alt="">
    <span> <a href="#">Update profile</a> </span>   </p>
</div>';
$channels = '<!-- Channels -->
<div class="settings options">
  <p>
    <img class="opt_icons" src="assets/pics/svgs/channel.svg" alt="">
<span> <a href="#">Your channels</a> </span>   </p>
</div>';
$Interests = '<!-- Your interests -->
<div class="settings options">
  <p>
    <img class="opt_icons" src="assets/pics/svgs/interests.svg" alt="">
    <span> <a href="#">Your interests</a> </span>   </p>
</div>';
$Languages = '<!-- Languages -->
<div class="settings options">
  <p>
    <img class="opt_icons" src="assets/pics/svgs/language.svg" alt="">
     <span>Languages</span>
     <select class="language" name="language" id="language">
       <option value="English">English</option>
       <option value="Hindi">Hindi</option>
     </select> </p>
</div>';
$privacy = '<!-- Privacy -->
<div class="settings options">
  <p>
    <img class="opt_icons" src="assets/pics/svgs/security.svg" alt="">
     <span> <a href="#">Privacy</a> </span>   </p>
</div>';
$securityLogin = '  <!-- Security and Login -->
  <div class="settings options">
    <p>
      <img class="opt_icons" src="assets/pics/svgs/lock.svg" alt="">
       <span> <a href="#">Security & Login</a> </span>  </p>
  </div>
';
$termsPolicy = '<!-- Terms and Policy -->
<div class="settings options">
  <p>
    <img class="opt_icons" src="assets/pics/svgs/policy.svg" alt="">
     <span> <a href="#">Terms & Policy</a>   </span>  </p>
</div>';
$helpFeedback ='  <!-- Help and Feedback -->
  <div class="settings options">
    <p>
      <img class="opt_icons" src="assets/pics/svgs/help.svg" alt="">
    <span> <a href="#">Help & Feedback</a> </span>  </p>
  </div>';
$aboutUs = '  <!-- About Us -->
  <div class="settings options">
    <p>
      <img class="opt_icons" src="assets/pics/svgs/info.svg" alt="">
       <span> <a href="#">About Us</a>  </span> </p>
  </div>';
$logout = '<!-- Log Out -->
<div class="settings options">
  <p>
    <img class="opt_icons" src="assets/pics/svgs/power.svg" alt="">
    <span> <a href="logout">Log Out</a> </span>  </p>
</div>
';
$nonLoggedProfile = '
        <!-- Non logged Profile -->
          <div class="settings newUser">
            <a href="login">Log In</a>
            <a href="register">Create Account</a>
          </div>';

include 'components/randVersion.php';
if (isset($_SESSION['logID'])) {
  if (isset($_SESSION['loggedIn'])){
    if ((boolean)$_SESSION['loggedIn']) {
      $getUserData  = getUserDat($_SESSION['logID']);
      $loggedProfile = '
      <!-- Logged Profile -->
          <div class="settings gotoprofile">
            <div >
              <img style="border-radius:65px;height: 60px; width:60px; overflow: hidden; object-fit:contain;" src="'.$getUserData['userProfilePic'].'" alt="">
            </div>
            <span>
              <p id="name">'.$getUserData['userFullName'].'</p>
              <a id="profilelink" href="profile">View your profile</a>
            </span>
          </div>';
      $GLOBALS['Menu'] = $loggedProfile.$writeArticles.$updateProfile.$channels.'<hr>'.$Interests.$Languages.$privacy.$securityLogin.'<hr>'.$termsPolicy.$helpFeedback.$aboutUs.$logout;
    }else {
      $GLOBALS['Menu'] = $nonLoggedProfile.$Interests.$Languages.$privacy.$termsPolicy.$helpFeedback.$aboutUs;
    }
  }else {
    $GLOBALS['Menu'] = $nonLoggedProfile.$Interests.$Languages.$privacy.$termsPolicy.$helpFeedback.$aboutUs;
  }
}else {
  $GLOBALS['Menu'] = $nonLoggedProfile.$Interests.$Languages.$privacy.$termsPolicy.$helpFeedback.$aboutUs;
}
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
      .newUser{
        padding: 1em;
        /* border-bottom: 1px solid; */
      }
      .newUser a{
        text-decoration: none;
        padding: .4em .6em;
        background-color: #0165E1;
        color: white;
        font-weight: 500;
        border-radius: 4px;
        margin-left: .3em;
      }
      .options p img{
        width: 26px;
        height: 26px;
      }
      </style>

  </head>
  <body>

    <div id="top" class="top">

      <div style=" flex-direction:row-reverse; padding: .45em 0em;" class="navigation">
        <b><span class="menu"onclick="renderHome()"style=" margin-right: 2.5em;"> <img style="height: 34px; width:34px;"src="assets/pics/svgs/cancel.svg" alt=""> </span></b>
      </div>
      <div class="top2">
        <div class="top3">
          <?php
          if (isset($GLOBALS['Menu'])) {
            echo $GLOBALS['Menu'];
          }
           ?>
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

<?php
function getUserDat($lID){
  include '_.config/_s_db_.php';
  $userID = getUserID($lID);
  $usrID = $userID['userID'];
  $sql = "SELECT * FROM user_cred WHERE userID = '$usrID'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    $data = $result->fetch_assoc();
  }else {
    $data = false;
  }
return $data;
}

function getUserID($logID){
  include '_.config/_s_db_.php';
  $sql = "SELECT * FROM fast_logged_users WHERE loginID = '$logID'";
  $result = mysqli_query($db, $sql);
  if ($result) {
    $data = $result->fetch_assoc();
  }else {
    $data = false;
  }
  return $data;
}
 ?>
