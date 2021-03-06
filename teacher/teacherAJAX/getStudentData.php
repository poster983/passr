<?php
include("../common.php");
checklogin();
header('Content-Type: application/json');
$msg = "";
date_default_timezone_set('America/Chicago');
include "../../medooconnect.php";



/*

The MIT License (MIT)

Copyright (c) Sat Feb 25 2017  Joseph Hassell josephh2018@gmail.com

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORTOR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
$return = "";
if($_POST['whatToDo'] == "getStudentsLeaving") {

  if($medooDB->has("passes", array(
    "AND" => array(
      "day_to_come" => date( 'Y-m-d', strtotime(" today ")),
      "teacherAccountID" => $_POST['teacher']
    )
  ))) {
    $sL = $medooDB->select("passes", array(
      "id",
      "firstname",
      "lastname",
      "place",
      "period",
      "shTeacherExcused"
    ), array(
      "AND" => array(
        "day_to_come" => date( 'Y-m-d', strtotime(" today ")),
        "teacherAccountID" => $_POST['teacher']
      )
    ));
    $return = "<ul class='collection' style='border: 1px solid #424242 !important;'>";
    foreach($sL as $row) {

      $return = $return . " <li class='collection-item avatar grey darken-2 hoverable avatar-clickable'  style='border-bottom: 1px solid #424242'>
      <!--<div class='hover-color tint'> -->
      <div class='submitAnimationEnabled' onclick='collectionAvatarSubmitAnimation($(this));' data-ishere='0'>
          <img src='/passport/image/favicon.png' alt='" . $row['firstname'] . " " . $row['lastname'] . "' class='circle avatar-img cursor-point'>

            <span class='avatar-icon'><i class='material-icons'>create</i></span>
            <span class='returnIcon'><i class='material-icons small'>done</i></span>
            <span class='undoIcon'><i class='material-icons small'>clear</i></span>

        </div>
    <!--</div>-->
        <span class='title'>" . $row['firstname'] . " " . $row['lastname'] . "</span>
        <p>" . $row['place'] . "</p>
        <p>" . $row['period'] . " Period</p>
        <!--<a href='#!' class='secondary-content'><i class='material-icons'>delete_forever</i></a>-->
      </li>
      ";
    }
    $return = $return . "</ul> <script> $(\"ul.collection > li.avatar-clickable\").hover(
      function(){
        if ($(\".submitAnimationEnabled\", this).data(\"submit-success\") != true && $(\".submitAnimationEnabled\", this).attr(\"data-ishere\") == 0) {
          $(\"img.avatar-img\", this).addClass(\"filter-color-blue\", 500);
          $(\"span.avatar-icon\", this).addClass(\"animate\");
        } else if ($(\".submitAnimationEnabled\", this).attr(\"data-ishere\") == 1) {
          $(this).find(\"img.avatar-img\", this).addClass(\"filter-color-red\", 500);
          $(this).find(\"span.undoIcon\", this).addClass(\"animate\");
          $(this).find(\"span.returnIcon\", this).addClass(\"animateOut\");
          $(this).find(\"span.returnIcon\").one('webkitAnimationEnd oanimationend msAnimationEnd animationend',
            function(e) {
              $(this).find(\"span.returnIcon\").removeClass(\"animate animateOut\");
              console.log($(this).find(\"span.returnIcon\"));
          });
        }
        console.log($(\".submitAnimationEnabled\", this).attr(\"data-ishere\"));
      }, function() {
        if ($(\".submitAnimationEnabled\", this).data(\"submit-success\") != true && $(\".submitAnimationEnabled\", this).attr(\"data-ishere\") == 0) {
          $(\"img.avatar-img\", this).removeClass(\"filter-color-blue\", 300);
          $(\"span.avatar-icon\", this).removeClass(\"animate\");
        } else if ($(\".submitAnimationEnabled\", this).attr(\"data-ishere\") == 1) {
          $(this).find(\"img.avatar-img\", this).removeClass(\"filter-color-red\", 500);
          $(this).find(\"span.undoIcon\", this).removeClass(\"animate\").addClass(\"animateOut\");
          $(this).find(\"span.returnIcon\", this).removeClass(\"animateOut\").addClass(\"animate\");
          $(this).find(\"span.returnIcon\").one('webkitAnimationEnd oanimationend msAnimationEnd animationend',
            function(e) {
              $(this).find(\"span.undoIcon\").removeClass(\"animate animateOut\");
              
          });
        }
      }
    );
  //submit animation

  function collectionAvatarSubmitAnimation(selector){
    selector.find(\"span.avatar-icon > i\").addClass(\"animateSubmit\");
    selector.find(\"span.returnIcon\").addClass(\"animate\");
    selector.find(\"span.avatar-icon > i\").one('webkitAnimationEnd oanimationend msAnimationEnd animationend',
      function(e) {
        selector.find(\"span.avatar-icon > i\").removeClass(\"animateSubmit\");
        $('span.avatar-icon.animate').removeClass(\"animate\");
        //console.log(\"done\");
    });
    selector.data(\"submit-success\", true);

    //DEBUG ONLY:
    selector.attr(\"data-ishere\", \"1\");

    //console.log(\"Animated\");
  }</script>";
  }
  echo json_encode(array('code'=>'7001','html'=>$return));
}

?>
