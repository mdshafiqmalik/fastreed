<?php
include 'components/randVersion.php';
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="robots" content="noindex">
      <link rel="stylesheet" href="assets/css/style.css?v=<?php echo $_SESSION['randVersion']; ?>">
      <link rel="stylesheet" href="assets/css/root.css?v=<?php echo $_SESSION['randVersion']; ?>">
      <link rel="stylesheet" href="users/src/style.css?v=<?php echo $_SESSION['randVersion']; ?>">
      <script src="assets/js/fun.js?v=<?php echo $_SESSION['randVersion']; ?>" charset="utf-8"></script>
      <title>Fastreed : Read, Write and Learn</title>
      <style media="screen">
      .options p svg{
        /* width: 30px; */
        /* height: 30px; */
      }
      </style>
  </head>
  <body>
    <div id="top" class="top">
      <div style=" border:0; flex-direction:row-reverse;" class="navigation">
        <span onclick="renderHome()"style=" margin-right: 1.5em;font-size: 1.5em;"> &#9587; </span>
      </div>

      <div class="top2">
        <div class="top3">
          <div class="settings gotoprofile">
            <img width="45px" height="60px"src="uploads/users/default/female/open_head.jpg" alt="">
            <span>
              <p id="name">Jhon Doe</p>
              <a id="profilelink" href="#">View your profile</a>
            </span>
          </div>
          <div class="settings options">
            <p>
              <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M32 18.45V21.45H16.05V18.45ZM32 24.8V27.8H16.05V24.8ZM32 31.15V34.15H16.05V31.15ZM37.6 6V10.4H42V13.4H37.6V17.8H34.6V13.4H30.2V10.4H34.6V6ZM28.7 6V9H9Q9 9 9 9Q9 9 9 9V39Q9 39 9 39Q9 39 9 39H39Q39 39 39 39Q39 39 39 39V19.3H42V39Q42 40.2 41.1 41.1Q40.2 42 39 42H9Q7.8 42 6.9 41.1Q6 40.2 6 39V9Q6 7.8 6.9 6.9Q7.8 6 9 6Z"/></svg>
            <span>Write an article</span>   </p>
          </div>
          <div class="settings options">
            <p>
              <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M20 23.75Q16.7 23.75 14.6 21.65Q12.5 19.55 12.5 16.25Q12.5 12.95 14.6 10.85Q16.7 8.75 20 8.75Q23.3 8.75 25.4 10.85Q27.5 12.95 27.5 16.25Q27.5 19.55 25.4 21.65Q23.3 23.75 20 23.75ZM4 39.8V35.1Q4 33.35 4.875 31.95Q5.75 30.55 7.4 29.8Q11 28.2 14.075 27.5Q17.15 26.8 20 26.8Q20.25 26.8 20.575 26.8Q20.9 26.8 21.15 26.8Q20.85 27.5 20.7 28.175Q20.55 28.85 20.45 29.8H20Q17.1 29.8 14.325 30.425Q11.55 31.05 8.6 32.5Q7.8 32.9 7.4 33.625Q7 34.35 7 35.1V36.8H20.45Q20.7 37.7 21.05 38.425Q21.4 39.15 21.9 39.8ZM33.35 42 32.85 38.7Q32 38.45 31.125 37.975Q30.25 37.5 29.65 36.9L26.9 37.5L25.65 35.4L28 33.2Q27.9 32.75 27.9 31.95Q27.9 31.15 28 30.7L25.65 28.5L26.9 26.4L29.65 27Q30.25 26.4 31.125 25.925Q32 25.45 32.85 25.2L33.35 21.9H36.05L36.55 25.2Q37.4 25.45 38.275 25.925Q39.15 26.4 39.75 27L42.5 26.4L43.75 28.5L41.4 30.7Q41.5 31.15 41.5 31.95Q41.5 32.75 41.4 33.2L43.75 35.4L42.5 37.5L39.75 36.9Q39.15 37.5 38.275 37.975Q37.4 38.45 36.55 38.7L36.05 42ZM34.7 35.95Q36.5 35.95 37.6 34.85Q38.7 33.75 38.7 31.95Q38.7 30.15 37.6 29.05Q36.5 27.95 34.7 27.95Q32.9 27.95 31.8 29.05Q30.7 30.15 30.7 31.95Q30.7 33.75 31.8 34.85Q32.9 35.95 34.7 35.95ZM20 20.75Q21.95 20.75 23.225 19.475Q24.5 18.2 24.5 16.25Q24.5 14.3 23.225 13.025Q21.95 11.75 20 11.75Q18.05 11.75 16.775 13.025Q15.5 14.3 15.5 16.25Q15.5 18.2 16.775 19.475Q18.05 20.75 20 20.75ZM20 16.25Q20 16.25 20 16.25Q20 16.25 20 16.25Q20 16.25 20 16.25Q20 16.25 20 16.25Q20 16.25 20 16.25Q20 16.25 20 16.25Q20 16.25 20 16.25Q20 16.25 20 16.25ZM20.45 36.8Q20.45 36.8 20.45 36.8Q20.45 36.8 20.45 36.8Q20.45 36.8 20.45 36.8Q20.45 36.8 20.45 36.8Q20.45 36.8 20.45 36.8Q20.45 36.8 20.45 36.8Z"/></svg>
              <span>Update profile</span>   </p>
          </div>
          <div class="settings options">
            <p>
              <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 48" height="48" viewBox="0 0 24 24" width="48">
                <path d="M21,3H3v18h18V3z M12,13.65c-1.54,0-2.79-1.25-2.79-2.78S10.46,8.09,12,8.09s2.79,1.25,2.79,2.78S13.54,13.65,12,13.65z M12,15.53c3.96,0,6.48,1.65,6.98,4.47H5.02C5.52,17.18,8.04,15.53,12,15.53z M12.37,14.54c1.88-0.19,3.35-1.75,3.35-3.67 c0-2.05-1.66-3.71-3.72-3.71s-3.72,1.66-3.72,3.71c0,1.92,1.47,3.49,3.35,3.67C6.86,14.66,4.46,17.07,4.01,20H4V4h16v16h-0.01 C19.54,17.07,17.14,14.66,12.37,14.54z">
                </path>
              </svg>
          <span>Your channels</span>   </p>
          </div>
          <hr>
          <div class="settings options">
            <p>
              <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M4 22 14 4 24 22ZM14.05 42Q10.75 42 8.4 39.65Q6.05 37.3 6.05 34Q6.05 30.65 8.4 28.325Q10.75 26 14.05 26Q17.35 26 19.7 28.35Q22.05 30.7 22.05 34Q22.05 37.3 19.7 39.65Q17.35 42 14.05 42ZM14.05 39Q16.15 39 17.6 37.55Q19.05 36.1 19.05 34Q19.05 31.9 17.6 30.45Q16.15 29 14.05 29Q11.95 29 10.5 30.45Q9.05 31.9 9.05 34Q9.05 36.1 10.5 37.55Q11.95 39 14.05 39ZM9.1 19H18.9L14 10.2ZM26 42V26H42V42ZM29 39H39V29H29ZM34 22Q31.15 19.6 29.225 17.95Q27.3 16.3 26.15 15.05Q25 13.8 24.5 12.7Q24 11.6 24 10.35Q24 8.1 25.575 6.55Q27.15 5 29.5 5Q30.8 5 32 5.6Q33.2 6.2 34 7.35Q34.8 6.2 36 5.6Q37.2 5 38.5 5Q40.85 5 42.425 6.55Q44 8.1 44 10.35Q44 11.6 43.5 12.7Q43 13.8 41.85 15.05Q40.7 16.3 38.775 17.95Q36.85 19.6 34 22ZM34 18.05Q38.25 14.55 39.625 13.05Q41 11.55 41 10.45Q41 9.35 40.35 8.675Q39.7 8 38.6 8Q37.95 8 37.325 8.35Q36.7 8.7 35.75 9.55L34 11.2L32.25 9.55Q31.3 8.7 30.675 8.35Q30.05 8 29.4 8Q28.3 8 27.65 8.675Q27 9.35 27 10.45Q27 11.55 28.375 13.05Q29.75 14.55 34 18.05ZM34 13Q34 13 34 13Q34 13 34 13Q34 13 34 13Q34 13 34 13Q34 13 34 13Q34 13 34 13Q34 13 34 13Q34 13 34 13Q34 13 34 13Q34 13 34 13Q34 13 34 13Q34 13 34 13ZM14 14.6ZM14.05 34Q14.05 34 14.05 34Q14.05 34 14.05 34Q14.05 34 14.05 34Q14.05 34 14.05 34Q14.05 34 14.05 34Q14.05 34 14.05 34Q14.05 34 14.05 34Q14.05 34 14.05 34ZM34 34Z"/></svg>
              <span>Your interests</span>   </p>
          </div>
          <div class="settings options">
            <p> <span>Languages</span>   </p>
          </div>
          <div class="settings options">
            <p> <span>Privacy</span>   </p>
          </div>
          <div class="settings options">
            <p> <span>Security & Login</span>  </p>
          </div>
          <hr>
          <div class="settings options">
            <p> <span> Terms & Policy </span>  </p>
          </div>

          <div class="settings options">
            <p><svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><path d="M15.36,9.96c0,1.09-0.67,1.67-1.31,2.24c-0.53,0.47-1.03,0.9-1.16,1.6L12.85,14h-1.75l0.03-0.28 c0.14-1.17,0.8-1.76,1.47-2.27c0.52-0.4,1.01-0.77,1.01-1.49c0-0.51-0.23-0.97-0.63-1.29c-0.4-0.31-0.92-0.42-1.42-0.29 c-0.59,0.15-1.05,0.67-1.19,1.34L10.32,10H8.57l0.06-0.42c0.2-1.4,1.15-2.53,2.42-2.87c1.05-0.29,2.14-0.08,2.98,0.57 C14.88,7.92,15.36,8.9,15.36,9.96z M12,18c0.55,0,1-0.45,1-1s-0.45-1-1-1s-1,0.45-1,1S11.45,18,12,18z M12,3c-4.96,0-9,4.04-9,9 s4.04,9,9,9s9-4.04,9-9S16.96,3,12,3 M12,2c5.52,0,10,4.48,10,10s-4.48,10-10,10S2,17.52,2,12S6.48,2,12,2L12,2z"></path></svg> <span>Help & Feedback</span>  </p>
          </div>
          <div class="settings options">
            <p> <span> About Us</span> </p>
          </div>
          <div class="settings options">
            <p> <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24" viewBox="0 0 24 24" width="24"><path d="M20,3v18H8v-1h11V4H8V3H20z M11.1,15.1l0.7,0.7l4.4-4.4l-4.4-4.4l-0.7,0.7l3.1,3.1H3v1h11.3L11.1,15.1z"></path></svg><span>Log Out</span>  </p>
          </div>
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
