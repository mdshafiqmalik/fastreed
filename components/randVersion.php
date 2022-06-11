<?php
include '../_.config/_s_db_.php';
$sql = "SELECT * FROM fast_options WHERE opt_ID = '5648902096'";
$res = mysqli_query($db, $sql);
$row = $res->fetch_assoc();
$version = (int)$row['opt_value'];
$aV = array_map('intval', str_split($version));
$var = 0;
if ($version < 10) {
  $ver = $aV[0].'.0.0.0.0';
}elseif($version < 100) {
  $ver = $aV[0].'.'.$aV[1].'.0.0.0';
}elseif ($version < 1000) {
  $ver = $aV[0].'.'.$aV[1].'.'.$aV[2].'.0.0';
}elseif ($version < 10000) {
  $ver = $aV[0].'.'.$aV[1].'.'.$aV[2].'.'.$aV[3].'.0';
}elseif ($version < 100000) {
  $ver = $aV[0].'.'.$aV[1].'.'.$aV[2].'.'.$aV[3].'.'.$aV[4];
}else {
  $ver = $version;
}
if (!isset($_COOKIE['cssVersion'])) {
  setcookie('cssVersion',$ver, time()+(86400*7), '/');
}else {
  if ($version != $_COOKIE['cssVersion']) {
    setcookie('cssVersion',$ver, time()+(86400*7), '/');
  }else {
    if (!isset($_SESSION['randVersion'])) {
      $_SESSION['randVersion'] = $_COOKIE['cssVersion'];
    }
  }
}

?>
