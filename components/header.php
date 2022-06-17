<?php
$source = "assets";
$svgFolder = $source."/pics/svgs";
if (isset($_SESSION["logID"]) || isset($_COOKIE["logId"])) {
  $user = "profile";
}else {
  $user = "login";
}

$header = '<div class="header">

  <div class="menuTop">
    <div onclick="renderMenu()" class="menu"> <img stye="font-weight:bold;" src="/'.$svgFolder.'/menu.svg" alt="">  </div>
  </div>
  <div class="logo">
    <h1 class="logo">project</h1>
  </div>
</div>';
$subheader = '<div class="subheader">
  <div><a href="/"><img id="home" class="submenu" src="/'.$svgFolder.'/home.svg" alt=""></a></div>
  <!--<div><a href="channels.php"><img id="subscribe" class="submenu" src="/'.$svgFolder.'/logo.svg" alt=""></a></div>-->
  <div><a href="/notifications"><img id="notification" class="submenu" src="/'.$svgFolder.'/circle_notifications.svg" alt=""></a> </div>
  <div><a href="/'.$user.'/"><img id="user" class="submenu" src="/'.$svgFolder.'/user.svg" alt=""></a> </div>
</div>';
$homeOther = ($_SERVER['REQUEST_URI'] == "/users/" || $_SERVER['REQUEST_URI'] == "/notifications/");
if ($homeOther) {
  echo '
  <div class="hd cont500">'.$subheader.'
  </div>
  ';
}else {
  echo '
  <div class="hd cont500">
  '.$header.''.$subheader.'
  </div>
  ';
}
?>
