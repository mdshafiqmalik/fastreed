<?php
include '../components/randVersion.php';
if(isset($_COOKIE['logID'])) {
  if (!empty($_COOKIE['logID'])) {
    include '../_.config/sjdhfjsadkeys.php';
    $dUserID = openssl_decrypt ($_COOKIE['logID'], $ciphering,
    $encryption_key, $options, $encryption_iv);
    $_SESSION["logID"] = $dUserID;
    if ($userID = checkLogDetails($_SESSION['logID'])) {
      renderProfile($userID);
    }else {
      echo '<script type="text/javascript">
        document.location = "../login/?code=001LIDNF";
      </script>';
    }
  }else {
    echo '<script type="text/javascript">
      document.location = "../login/?code=002LIDNF";
    </script>';
  }

}elseif ($_SESSION["logID"]) {
  if ($userID =checkLogDetails($_SESSION["logID"])) {
    renderProfile($userID);
  }else {
    echo '<script type="text/javascript">
      document.location = "../login/?code=005LIDNF";
    </script>';
  }
}else {
  echo '<script type="text/javascript">
    document.location = "../login?code=00NCSS";
  </script>';
}



$GLOBALS['containerStart'] = '<div id="" class="container">';
$GLOBALS['divStop'] = '</div>';


function checkLogDetails($logID){
  include '../_.config/_s_db_.php';
  $checkLoginID = "SELECT userID FROM fast_logged_users Where loginID = '$logID' AND status = '1'";
  $userDat = mysqli_query($db, $checkLoginID);
  if (mysqli_num_rows($userDat)) {
      $row = $userDat->fetch_assoc();
      $exist = $row['userID'];
  }else {
    setcookie('logID', '', time() -3600, "/");
    unset($_SESSION['logID']);
    $exist = false;
  }
  return $exist;
}

function renderProfile($UID){
  include '../_.config/_s_db_.php';
  $getUserData = "SELECT * FROM user_cred Where userID = '$UID'";
  $result = mysqli_query($db,$getUserData);
  if (mysqli_num_rows($result)) {
    $row = $result->fetch_assoc();
    $userFullName = $row['userFullName'];
    $userJoinDate = $row['userJoiningDate'];
    $upp = $row['userProfilePic'];

    include_once '../components/time.php';
    $pTime = strtotime($userJoinDate);
    $joinDate = pTiming($pTime);

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
    }

    $getPost = "SELECT * FROM fast_posts WHERE userID ='$UID'";
    $postData = mysqli_query($db, $getPost);
    $postsCount = mysqli_num_rows($postData);

    $fastUser = "SELECT * FROM fast_users WHERE userID ='$UID'";
    $getUserData = mysqli_query($db, $fastUser);
    $userData = $getUserData->fetch_assoc();
    $uName = $userData['userName'];

    $getFollow = "SELECT * FROM fast_follows WHERE toUserID ='$UID'";
    $followData = mysqli_query($db, $getFollow);
    $followCount = mysqli_num_rows($followData);

    $getRating = "SELECT * FROM fast_rating WHERE toUserID ='$UID'";
    $rateData = mysqli_query($db, $getRating);
    $rateCount = mysqli_num_rows($rateData);
    if ($rateCount == 0) {
      $rate = 0;
    }else {
      $totalRating = 0;
      while ($row = $rateData->fetch_assoc()) {
        $totalRating += $row['rateUser'];
        break;
      }
      $rateInDecimal = $totalRating/$rateCount;
      $rate = number_format((float)$rateInDecimal, 1, '.','');
    }
    $profileImage =$row['userProfilePic'];
    if ($profileImage == '0M') {
      $pImg = 'uploads/users/default/male.png';
    }elseif ($profileImage == '0F') {
      $pImg = 'uploads/users/default/female.png';
    }else {
      $pImg = $row['userProfilePic'];
    }
    $GLOBALS['profile'] ='
    <!-- Self Profile Opened -->
    <div id="" class="container">
      <div class="authorProfile">
        <div class="topDiv">
          <div class="authorPic"> <img width="105" height="105"src="../'.$pImg.'" alt="">
          <span id="userType">'.$userType.'</span>
          </div>
          <div class="authorDetails">
            <div class="userNameWork">
              <span id="userFullName">'.$userFullName.'</span>
              <span id="userName">#'.$uName.'</span>
              <span id="userCountry">'.$userCountry.'</span>
              <span id="joinedDate">Joined '.$joinDate.' ago</span>
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
                <span class="values">'.$rate.'</span>
              </div>
            </div>
          </div>
        </div>
        <div class="bottomDiv">
          <div id="linkOne"class="linkOne"> <span class="links"> <a href="../logout/">Logout</a></span> </div>
          <div id="linkTwo" class="linkOne"> <span class="links"> <a href="#">Settings</a> </span> </div>
        </div>
      </div>
      </div>
    <!-- Self Profile Closed -->';
  }


  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <head>
      <meta charset="utf-8">
      <?php include '../components/randVersion.php' ?>
      <link rel="stylesheet" href="../users/src/style.css?v=<?php echo $randVersion; ?>">
      <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo $randVersion; ?>">
      <link rel="stylesheet" href="../users/src/profile.css?v=<?php echo $randVersion; ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style media="screen">
      .mCont{
        width: 100vw;
        height:100vh;
        background-color: rgba(20, 20, 20, 0.5);
        max-width: 500px;
        position: absolute;
      }
      .mCont .getData{
        width: 100%;
        min-height: 200px;
        background-color: white;
        position: absolute;
        z-index: 999999;
        bottom: 0;
        border-radius: 45px 45px 0 0 ;
        padding: 1em 0 7em 0;
        display: flex;
        flex-direction: column;
      }
      .mCont .getData .justDiv{
        font-size: 1em;
        font-family: var(--fontFam);
        color: black;
        margin: .7em;
        margin-top: 0;
        padding: .2em 3em;
        font-weight: 500;
      }
      .mCont .getData form{
        font-weight: 500;
        margin-top: 1em;
      }
      .dateInput{
        display: flex;
      }
      .dateInput input{
        width: 50px;
        margin: 0 .3em;
        font-size: 1.1em;
        border: 1px solid #aaa;
        padding: .2em .2em;
        text-align: center;
        border-radius: 5px;
      }
      .actionLabel{
        display: flex;
        flex-direction: column;
        align-items:center;
        text-align: center;
      }
      .splitter{
        width: 80px;
        border: 2px solid #ddd;
        background-color: #ddd;
        margin: 1em;
      }
    </style>
  </head>
  <body style="overflow:hidden">
    <div class="mCont">
      <div class="getData">
        <div class="justDiv">
          <span class="actionLabel">Complete Your Profile <hr class="splitter"> </span>
          <form class="" action="index.html" method="post">
            <label for=""> Date Of Birth</label><br><br>
            <div class="dateInput">
              <input type="number" min="1" max="31" name="day" value="" placeholder="Day">
              <input type="number" min="1" max="12" name="month" value="" placeholder="Month">
              <input type="number" min="1950" max="2022" name="year" value="" placeholder="Year">
            </div>

          </form>
        </div>

      </div>
    </div>
    <div class="navigation">
      <span> <a id="backArrow" href="../">&#171;  <span>Home</span></a> </span>
    </div>
    <?php
    if (isset($GLOBALS['profile'])) {
      echo $GLOBALS['profile'];
    }
     ?>

  </body>
</html>
