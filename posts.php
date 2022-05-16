<?php
date_default_timezone_set('Asia/Kolkata');
include '_.config/_s_db_.php';
$link = new mysqli("$hostName","$userName","$passWord","$dbName");
    if ($link->connect_error) {
      die('<p>Failed to connect to MySQL: '. $link->connect_error .'</p>');
    }

    $userDataSql = "SELECT * FROM fast_posts";
    if (mysqli_query($link, $userDataSql)) {
      $result = mysqli_query($link, $userDataSql);
      if ($row = mysqli_num_rows($result)) {
        while ($data = $result->fetch_assoc()) {
          $postUserID = $data['userID'];
          $postID = $data['postID'];
          $channelID = $data['channelID'];
          // get likes count
          $selectPostLikes = "SELECT * FROM fast_likes Where postID = '$postID'";
          $likesData = mysqli_query($link, $selectPostLikes);
          $likes = mysqli_num_rows($likesData);

          // get comments count
          $selectPostComments = "SELECT * FROM fast_comments Where postID = '$postID'";
          $commentsData = mysqli_query($link, $selectPostComments);
          $comments = mysqli_num_rows($commentsData);

          // get author name
          $selectPostAuthor = "SELECT * FROM fast_users Where userID = '$postUserID'";
          $authorData = mysqli_query($link, $selectPostAuthor);
          $authorArray = $authorData->fetch_assoc();
          $authorName = $authorArray['userFullName'];

          // get channel name
          $selectPostChannel = "SELECT * FROM fast_channels Where channelID = '$channelID'";
          $channelData = mysqli_query($link, $selectPostChannel);
          $channelArray = $channelData->fetch_assoc();
          $channelName = $channelArray['channelName'];

          // String to Array
          $pPicLink = unserialize($data['postOgPicLink']);
          // $pKeywords = unserialize($data['postKeyword']);
          // $pTags = unserialize($data['postTags']);


          include_once 'components/time.php';
          $tm = $data['postModifiedDate'];
          $pTime = strtotime($tm);
          $postTime = pTiming($pTime);

        // echo _ago($tm, $full = false);
        // echo date();
        // echo time_elapsed_string($tm);

          echo '
          <div class="posts cont500">
            <div class="postBody">
              <div class="postPic"> <img src="/uploads/posts/'.$pPicLink['year'].'/'.$pPicLink['month'].'/'.$pPicLink['id'].'.'.$pPicLink['ext'].'" alt=""> </div>
              <div class="postTitle"><a href="?posts='.$data['postOgLink'].'.html" id="postTitle" href=""> '.$data['postTitle'].'</a></div>
              <div class="extFoot">
                <span class="meta"><a id="channelName"  href="">'.$channelName.'</a></span>
                <p class="dot">&#x2022;</p>
                <span   class="meta"><a id="authorName" href="">'.$authorName.'</a></span>
                <p class="dot">&#x2022;</p>
                <span id="pubTime" class="meta">'.$postTime.' Ago</span>
              </div>
            </div>
            <div class="postFooter">
              <div class="footItems" id="react">
                <div id="like" class="react"><img  class="footImages"  src="/assets/pics/svgs/thumbs-up.svg" alt=""></div>
                <div id="likeCount" class="react rt footImages fontFam b sm ml_d4em">'.$likes.'</div>
              </div>
              <div class="footItems" >
                <img id="comment"class="footImages"  src="/assets/pics/svgs/comment_notFilled_2.svg" alt="">
                <div id="comentCount" class=" react rt footImages fontFam b sm ml_d4em">'.$comments.'</div>
              </div>
              <div class="footItems" id="share">
                <img  class="footImages" src="/assets/pics/svgs/share_en.svg" alt="">
              </div>
            </div>
          </div>
          ';
        }
      }else {
        for ($i=0; $i <2 ; $i++) {
          echo '
          <div class="posts cont500">
            <div class="postBody">
              <div class="postPic"> <img src="" alt=""> </div>
              <div class="postTitle"><a id="postTitle" href=""></a></div>
              <div class="extFoot">
                <span class="meta"><a id="channelName"  href=""></a></span>
                <p class="dot">&#x2022;</p>
                <span   class="meta"><a id="authorName" href=""></a></span>
                <p class="dot">&#x2022;</p>
                <span id="pubTime" class="meta"></span>
              </div>
            </div>
            <div class="postFooter">
              <div class="footItems" id="react">
                <div id="like" class="react"><img  class="footImages"  src="/assets/pics/svgs/thumbs-up.svg" alt=""></div>
                <div id="likeCount" class="react rt footImages fontFam b sm ml_d4em"></div>
              </div>
              <div class="footItems" >
                <img id="comment"class="footImages"  src="/assets/pics/svgs/comment_notFilled_2.svg" alt="">
                <div id="comentCount" class=" react rt footImages fontFam b sm ml_d4em"></div>
              </div>
              <div class="footItems" id="share">
                <img  class="footImages" src="/assets/pics/svgs/share_en.svg" alt="">
              </div>
            </div>
          </div>
          ';
        }

      }
    }
     ?>
