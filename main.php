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
   /* 공연,아티스트 정보 디테일 스타일 #explainLine */
   .explainColumn, .artistColumn {display:flex; flex-direction:row; align-items:center; margin:10px 0;}
   .extitle, .arttitle {width:90px; padding:15px 10px 15px 0; text-align:center;}
   .exdetail, .artdetail {width:200px; padding:15px 10px; border:5px solid black; text-align:center; font-weight:bold;}   #explainLine{padding:20px 0; width:100%; display:flex; flex-direction:column; align-items:center;}   #explainTitle{font-weight:bold; font-size:20px;}
   #siteContents{display:flex; flex-direction:column; align-items:center; margin:10px 0;}
   .siteColumn{width:100%;padding:20px 15px;}
   #siteNm{font-weight:bold; font-size:20px; text-align:center; background-color:black; color:white;}
   #siteImg{width:300px;}
   #siteAddr{font-weight:bold; font-size:15px; text-align:center;}
</style>

    </head>
    
    <body>
<!--고정 메뉴-->
<header>
   </header>
   <!--고정메뉴-->

        <div class="Logo">
            <a href="http://showdeerocks.info/"><img class="Header" src="src/logoimg2.png" border="0"></a><br>
            <h1>전 체 일 정</h1>
        </div>
           
        <div class="tab">
      
     
     <div id="checkLine">
        <a href="javascript:showCalendar();" id="cal1"><img src="src/cal.jpg"></a>
        <a href="javascript:showCalendar();" id="cal2" class="hidden"><img src="src/calBlack.png"></a>
        Filter : 
        <a href="javascript:showConcert('new');" class="blue">[신규공연]</a> 
        <a href="javascript:showConcert('free');" style="color: aquablue important!;">[무료공연]</a> 
        <a href="javascript:showConcert('hd');">[홍대공연]</a>
     </div> 
      <div class="tabcontent">
         <div id="tab01">
     
<div class='mainContents' style="width: 100%; height:auto;">
<table style="width:100%;">
   <tr style="width:100%;">
      <td style="width:50%;">

<div class='conOn' id='conAll' style="height:100vh; overflow-y:scroll;">

</div><!--conAll div End-->



   </td>
   <!-- </div>conText div end -->
   <td style="width:50%;">
      <div id="defaultContents"> 
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
      <div id="detailContents" style="height:100vh;display:flex;flex-direction:column;align-items:center;padding:10px 0px;">
         <div id="imgLine">
            <img src="src/sample2.jpeg">
         </div>

         <div id="explainLine">
            <div class="explainColumn">
               <!-- <div class="extitle">공연명</div> -->
               <div id="explainTitle"></div>
            </div>
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

      <div id="siteContents" style="display:none;">
         <div class="siteColumn" id="siteNm"></div>
         <img class="siteColumn" id="siteImg" src="#"/>
         <div class="siteColumn" id="siteAddr"></div>
         <div class="siteColumn" id="map" style="width:100%;height:400px;padding:20px 15px;"></div>
      </div>

      <div id="artistContents" style="display:none;">
         <div id="explainLine">
            <div class="arttitle">이미지</div>
               <img src="#" id="artistImg">
         </div>
            <div class="artistColumn">
               <div class="arttitle">소개</div>
               <div class="artdetail" id="artistIntro"></div>
            </div>
            <div class="artistColumn">
               <div class="arttitle">링크</div>
               <div class="artdetail" id="artistLink">
                  <div id="divLinkHpg"><a id="artLinkHpg" href="#"><img src="src/hpg_ic.jpeg"></a></div>
                  <div id="divLinkTw"><a id="artLinkTw" href="#"><img src="src/tw_ic.png"></a></div>
                  <div id="divLinkYout"><a id="artLinkYout" href="#"><img src="src/yout_ic.png"></a></div>
                  <div id="divLinkInsta"><a id="artLinkInsta" href="#"><img src="src/insta_ic.png"></a></div>
               </div>
            </div>
         </div>
      </div>

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
</body>

</html>