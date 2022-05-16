<?php
$source = "assets";
$svgFolder = $source."/pics/svgs";

$header = '<div class="header">
<div class="">
  <h1 class="logo">project</h1>
</div>
  <div class="menuTop">
    <div class="menu"><img src="/'.$svgFolder.'/menu_NB.svg" alt=""> </div>
  </div>
</div>';
$subheader = '<div class="subheader">
  <div><a href="/"><img id="home" class="submenu" src="/'.$svgFolder.'/home_NF.svg" alt=""></a></div>
  <!--<div><a href="channels.php"><img id="subscribe" class="submenu" src="/'.$svgFolder.'/logo.svg" alt=""></a></div>-->
  <div><a href="/notifications"><img id="notification" class="submenu" src="/'.$svgFolder.'/bell_NF.svg" alt=""></a> </div>
  <div><a href="/account"><img id="user" class="submenu" src="/'.$svgFolder.'/user_notFilled.svg" alt=""></a> </div>
</div>';


$homeOther = ($_SERVER['REQUEST_URI'] == "/account/" || $_SERVER['REQUEST_URI'] == "/notifications/");
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
