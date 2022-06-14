<?php
include '../components/randVersion.php';
if(isset($_COOKIE['logID'])) {
  if (!empty($_COOKIE['logID'])) {
    include '../_.config/sjdhfjsadkeys.php';
    $dUserID = openssl_decrypt ($_COOKIE['logID'], $ciphering,
    $decryption_key, $options, $decryption_iv);
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
  $checkLoginID = "SELECT userID FROM fast_logged_users Where loginID = '$logID'";
  if ($userDat = mysqli_query($db, $checkLoginID)) {
    if (mysqli_num_rows($userDat)) {
      $status = $row['status'];
      if ((boolean)$status) {
        $row = $userDat->fetch_assoc();
        $exist = $row['userID'];
      }else {
        $exist = false;
      }
    }else {
      setcookie('logID', '', time() -3600, "/");
      unset($_SESSION['logID']);
      $exist = false;
    }
  }else {
    setcookie('logID', '', time() -3600, "/");
    unset($_SESSION['logID']);
    $exist = false;
  }

  return $exist;
}

function renderProfile($UID){
  include '../_.config/_s_db_.php';
  $link = new mysqli("$hostName","$userName","$passWord","$dbName");
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

    if ($upp == 0) {
      $profileImage = "users/default.jpg";
    }else {
      $upp = unserialize($row['userProfilePic']);
      $profileImage = $upp['folder'].'/'.$upp['year'].'/'.$upp['month'].'/'.$upp['id'].'.'.$upp['ext'];
    }
    $GLOBALS['profile'] ='
    <!-- Self Profile Opened -->
    <div id="" class="container">
      <div class="authorProfile">
        <div class="topDiv">
          <div class="authorPic"> <img src="../uploads/'.$profileImage.'" alt=""> </div>
          <div class="authorDetails">
            <div class="userNameWork">
              <span id="userFullName">'.$userFullName.'</span>
              <span id="userType">'.$userType.'</span>
              <span class="designation">'.$userCountry.'</span>
              <span class="designation">Joined '.$joinDate.' ago</span>
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
      <link rel="stylesheet" href="../users/src/style.css?v=<?php echo $_SESSION['randVersion']; ?>">
      <link rel="stylesheet" href="../assets/css/root.css?v=<?php echo $_SESSION['randVersion']; ?>">
      <link rel="stylesheet" href="../users/src/profile.css?v=<?php echo $_SESSION['randVersion']; ?>">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
  </head>
  <body>
    <div class="navigation">
      <span> <a id="backArrow" href="../">&#171;  <span>Back</span></a> </span>
    </div>
    <?php
    if (isset($GLOBALS['profile'])) {
      echo $GLOBALS['profile'];
    }
     ?>
  </body>
</html>
