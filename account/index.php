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
  <div id="userDiv" class="cont">
    <div class="authorProfile">
      <div class="topDiv">
        <div class="authorPic"> <img src="../uploads/users/2022/7/25316532.jpg" alt=""> </div>
        <div class="authorDetails"></div>
      </div>
      <div class="bottomDiv">

      </div>
    </div>
    <div class="featuredArticle">

    </div>
  </div>
<!-- if (isset($_SESSION['userID'])) {
       include '../_.config/_s_db_.php';
       $userID = $_SESSION['userID'];
       $sql = "SELECT userProfile from user_data where userID = '$userID'";
       $user_data = mysqli_query($db,$sql);
       $row = $user_data->fetch_assoc();
       $userPicArray = unserialize($row['userProfile']);
      echo '<img height="30px" width="30px" src="/uploads/'.$userPicArray['year'].'/'.$userPicArray['month'].'/'.$userPicArray['id'].'.'.$userPicArray['ext'].'" alt="">';
     }else {
       include '../components/login.php';
     }
 ?> -->

    <!-- New Users -->
<!-- <div class="content">
  <span id="signUp" >Create An Account</span>
  <br>
  <form class="loginForm" action="" method="post">
    <div class="loginFields">
      <input id=""onkeyup="" type="email" name="" value="" placeholder="Full Name">
    </div>
    <div class="loginFields">
      <input id=""onkeyup="" type="email" name="" value="" placeholder="Enter Email Or Phone">
    </div>
    <div class="loginSubmit">
      <input type="submit" name="" value="SEND OTP">
    </div>
  </form>
</div> -->
  <script src="src/fun.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  <script src="../assets/js/jquery-3.6.0.js?v=<?php echo $randVersion ?>" charset="utf-8"></script>
  </body>
</html>
