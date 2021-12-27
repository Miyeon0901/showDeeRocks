<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>ShowDeeRocks</title>
        <link rel="stylesheet" href="css/contents.css" type="text/css"> <!-- delete-line -->
        <script src="js/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=7dgihuvglz&submodules=geocoder"></script>
  <script src="https://kit.fontawesome.com/6478f529f2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="css/basic-jquery-slider.css" rel="stylesheet" type="text/css" media="screen">
    <link href="https://hangeul.pstatic.net/hangeul_static/css/nanum-square-round.css" rel="stylesheet">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script>
   $(document).ready(function(){
      showConcert("all");
      $("#detailContents").hide();
   });
   jQuery(function ($) {
      var conId = '';
      $("body").css("display", "none");
      $("body").fadeIn(500);
      $("a.transition").click(function (event) {
         event.preventDefault();
         linkLocation = this.href;
         $("body").fadeOut(500, redirectPage);
      });
      function redirectPage() {
         window.location = linkLocation;
      }
   });
</script>
<style>

</style>

    </head>
    
    <body>
<!--고정 메뉴-->
<header>
<a href="index.html">
<div style="float:left; color: white;">
         [쇼]
      </div>
      </a>
   <a href="https://digging.kr" target="window" data-transition="fade">
      <div style="float:right; height: 100%;">
         <img src="src/DM.png" style="height: 100%; width: auto;">
      </div>
   </a>
   <div class="sidenav">
      <button class="dropdown-btn"><i class="fas fa-bars fa-2x"></i></button>
      <div class="dropdown-container">
         <a href="#">지난공연</a>
         <a href="#">인스타그램</a>
         <a href="#">트위터</a>
         <a href="#">CONTACT</a>
         <a href="#">ABOUT</a>
      </div>
   </div>
   
</header>
   <!--고정메뉴-->

        <div class="Logo" style="margin-bottom: 20px">
            <a href="http://showdeerocks.info/"><img class="Header" src="src/logoimg2.png" border="0"></a><br>
            <!-- <h1>전 체 일 정</h1> -->
        </div>
           
        <div class="tab">
      
     
     <div id="checkLine">
        <a href="javascript:showCalendar();" id="cal1"><img src="src/cal.jpg"></a>
        <a href="javascript:showCalendar();" id="cal2" class="hidden"><img src="src/calBlack.png"></a>
        <span id="filter">
        Filter : 
        <a id="newConcert" href="javascript:showConcert('new');">[신규공연]</a> 
        <a id="freeConcert" href="javascript:showConcert('free');">[무료공연]</a> 
        <a id="hdConcert" href="javascript:showConcert('hd');">[홍대공연]</a>
</span>
     </div> 
      <div class="tabcontent">
         <div id="tab01">
     
<div class='mainContents' style="width: 100%; height:auto;">
<table style="width:100%;">
   <tr style="width:100%;">
      <td style="width:50%;">

<div class='conOn' id='conAll' style="height:70vh; overflow-y:scroll;">

</div><!--conAll div End-->



   </td>
   <!-- </div>conText div end -->
   <td style="width:50%; height:70vh; overflow-y:scroll;">
      <div id="defaultContents" class="vcenter" style="height: 68vh; text-align:center;"> 
      <div class="swiper mySwiper vcenter" id="left">
                <div class="swiper-wrapper" id="poster">
                    <div class="swiper-slide"><img src="src/sample1.jpeg" onClick="location.href='https://naver.com'"></div>
                    <div class="swiper-slide"><img src="src/sample2.jpeg"></div>
                    <div class="swiper-slide"><img src="src/sample3.jpeg"></div>
                </div>
                <div class="swiper-button-next" style="color:white; font-weight: bold;"></div>
                <div class="swiper-button-prev" style="color:white; font-weight: bold;"></div>
            </div>

      </div>
      <div id="detailContents" style="height:68vh;display:flex;flex-direction:column;align-items:center;padding:10px 0px;">
      <div class="explainColumn">
               <!-- <div class="extitle">공연명</div> -->
               <div id="explainTitle"></div>
            </div>
         <div id="imgLine" style="height: 40%; width: auto;">
          <img src="#" id="conImg" style="height: 100%; width: auto;">
         </div>

         <div id="explainLine">
            
            <div class="explainColumn">
               <div class="extitle">출연진</div>
               <div class="exdetail" id="explainArtist"></div>
            </div>
            <div class="explainColumn">
               <div class="extitle">장소</div>
               <div class="exdetail" id="explainPnC"></div>
            </div>
            <div class="explainColumn">
               <div class="extitle">공연시간</div>
               <div class="exdetail" id="explainTime"></div>
            </div>
            <div class="explainColumn">
               <div class="extitle">가격정보</div>
               <div class="exdetail" id="explainPrice"></div>
            </div>
            <div class="explainColumn">
               <div class="extitle">예매처</div>
               <div class="exdetail" id="explainLink"><a id="conLink" href="#">예매하기</a></div>
            </div>
         </div>
      </div>

      <div id="siteContents" style="display:none; height: 68vh;">
         <div class="siteColumn" id="siteNm"></div>
         <div id="siteImg"><img id="siteImgtag" src="#"/></div>
         <div id="siteLink" style="margin-top:10px;">
                  <div id="divSLinkHpg" style="float:left"><a id="siteLinkHpg" href="#"><img src="src/hpg_ic.jpeg"></a></div>
                  <div id="divSLinkTw" style="float:left"><a id="siteLinkTw" href="#"><img src="src/tw_ic.png"></a></div>
                  <div id="divSLinkYout" style="float:left"><a id="siteLinkYout" href="#"><img src="src/yout_ic.png"></a></div>
                  <div id="divSLinkInsta" style="float:left"><a id="siteInsta" href="#"><img src="src/insta_ic.png"></a></div>
               </div>   
         <div class="siteColumn" id="siteAddr"></div>
         <div class="siteColumn" id="map"></div>
      </div>

      <div id="artistContents" style="display:none; height: 68vh">
         <div id="explainLine">
            <div class="arttitle" id="artistNm"></div>
            <div id="artistImg">
               <img src="#" id="artistImgtag">
            </div>         
            <div id="artistLink" style="margin-top:10px;">
                  <div id="divLinkHpg" style="float:left"><a id="artLinkHpg" href="#"><img src="src/hpg_ic.jpeg"></a></div>
                  <div id="divLinkTw" style="float:left"><a id="artLinkTw" href="#"><img src="src/tw_ic.png"></a></div>
                  <div id="divLinkYout" style="float:left"><a id="artLinkYout" href="#"><img src="src/yout_ic.png"></a></div>
                  <div id="divLinkInsta" style="float:left"><a id="artLinkInsta" href="#"><img src="src/insta_ic.png"></a></div>
               </div>   
         </div>
            <div class="artistColumn">
               <div class="arttitle">소개</div>
               <div class="artdetail" id="artistIntro"></div>
            </div>
            <div class="artistColumn">
               <div class="arttitle">멤버</div>
               <div class="artdetail" id="artistMember"></div>
            </div>
            <div class="artistColumn">
               <div class="arttitle">프리뷰</div>
               <div id="artistView">
               <iframe width="100%" height="auto" src="https://www.youtube.com/embed/NYC6GDuK9VQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
               </div>
            </div>
         </div>
      </div>
      <br>
      <a href="javascript:openPopup();" style="text-align: right;"><div>공연추가/수정요청</div></a>
   </td></tr></table>
   </div> <!--mainContents div end-->
   
   </div><!--tab01 div end-->
   <div id="tab02" class="hidden">
      <?php include('calendar.php');
      ?>
   </div>
   </div><!--tabcontent end-->
  </div><!--tab end-->
   <footer style="width:100%;">
           
            <p>Copyright ⓒ 2021 showdeerocks l Showdeerocks All rights reserved.</p>
            <p>: showdeerocks@gmail.com</p>                
            <a href="https://twitter.com/showdee_rocks?ref_src=twsrc%5Etfw"><img src="src/sns1.png"></a>
            <a href="https://www.instagram.com/showdeerocks"><img src="src/sns3.png"></a>

</footer>   
<script>
   $(function(){
      $("button").click(function(){
         var $p = $(this).next();
         if($p.css("display") == "none"){
               $(this).siblings("div").slideUp();
               $p.slideDown();
         }else {
               $p.slideUp();
         }         
      })
   })
</script>
<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper(".mySwiper", {
        spaceBetween: 60,
        centeredSlides: true,
        /*watchOverflow: false,*/
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
    });
</script>

</body>
<div class="popup" id="contact" style="background-color: white;">
        <div class="popup_column">
            <span>CONTACT</span>
            <a href="javascript:closePopup();"><i class="fas fa-times"></i></a>
        </div>
        <div class="popup_column">
            <h4>showdeerocks info</h2>
        </div>
        <div class="popup_column">
            <div class="popup_column_text">
                <pre>
EMAIL
[showdee_rocks@naver.com](mailto:showdee_rocks@naver.com)

PHONE
+82 10-2029-6027

<a href="https://twitter.com/showdee_rocks">Twitter <i class="fab fa-twitter-square"></i></a>
<a href="https://www.instagram.com/showdeerocks/">Instagram <i class="fab fa-instagram-square"></i></a>
                </pre>
            </div>            
        </div>
    </div>


    <script
      src="https://kit.fontawesome.com/6478f529f2.js"
      crossorigin="anonymous"
    ></script>
</html>
