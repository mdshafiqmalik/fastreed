<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <?php include '../components/randVersion.php'; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/style.css?v=<?php  echo $_SESSION['randVersion']; ?>">
  <link rel="stylesheet" href="/assets/css/root.css?v=<?php  echo $_SESSION['randVersion']; ?>">
  <link rel="stylesheet" href="/users/src/profile.css?v=<?php  echo $_SESSION['randVersion']; ?>">
  <title>401 Error</title>
</head>
<body>
  <style media="screen">
  .cont600{
    max-width: 400px;
    display: flex;
    justify-content: center;
    align-items:center;
    flex-direction:column;
  }
    .error{
      display: flex;
      justify-content: center;
      align-items:center;
      flex-direction:column;
      border-top: 1px solid #ccc;
      margin: 0em 0 .2em 0;
      background-color: white;
      padding: 1em 0em;
    }
  .error #errorType{
      font-size: 1.4em;
      font-weight: bold;
      padding: .2em .5em;
      background-color: #eee;
      border-left: 8px solid red;
      border-right: 8px solid red;
    }
    .tagandSearch{
      height: auto;
      margin-top: 1em;
    }
    .error #error{
      margin-top: .6em;
      text-align: center;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <?php include '../components/header.php'; ?>
  <div id="" class="container">
      <div class="error">
        <div class="cont600">
          <span id="errorType" >401 Error!</span>
          <span id="error"> Unauthorized Access</span>
      </div>
  </div>
</html>
