<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
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
    <?php
    if (isset($_SESSION['userID'])) {
      $userID = $_SESSION['userID'] ;
      $userEmail = $_SESSION['userEmail'] ;
      renderProfilePage($userID, $userEmail);
    }elseif (isset($_COOKIE['userID'])) {
      include '../_.config/sjdhfjsadkeys.php';
      $dUserID = openssl_decrypt ($_COOKIE['userID'], $ciphering,
        $decryption_key, $options, $decryption_iv);
      $dUserEmail = openssl_decrypt ($_COOKIE['userEmail'], $ciphering,
        $decryption_key, $options, $decryption_iv);
      $_SESSION['userID'] = $dUserID;
      $_SESSION['userEmail'] = $dUserEmail;
      renderProfilePage($_SESSION['userID'], $_SESSION['userEmail']);
    }else {
      header("Location: /account/");
    }
    function renderProfilePage($userID, $userEmail){
      include '../_.config/_s_db_.php';
    }
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
     ?>
  </body>
</html>
