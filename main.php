<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>ShowDeeRocks</title>
        <link rel="stylesheet" href="./css/contents.css" type="text/css"> <!-- delete-line -->
        <script src="js/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- <link rel="stylesheet" href="/resources/demos/style.css"> -->
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=7dgihuvglz&submodules=geocoder"></script>

<script>
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
        <a href="#" class="blue">[신규공연]</a> 
        <a href="#" style="color: aquablue important!;">[무료공연]</a> 
        <a href="#">[홍대공연]</a>
     </div> 
      <div class="tabcontent">
         <div id="tab01">
     
<div class='mainContents' style="width: 100%; height:auto;">
<table style="width:100%;">
   <tr style="width:100%;">
      <td style="width:50%;">

<div class='conOn' id='conAll' style="height:100vh; overflow-y:scroll;">
<?php
   $conn = mysqli_connect("showdeedb.cipqx10duwv3.us-east-2.rds.amazonaws.com", "ShowdeeMaster", "wogusdla1!" , "showdeerocks");
   $sql = "SELECT CON_DATE, CON_ID,ENTRYTYPE,CON_LINK, SITE, SITE_NAME as place, group_concat(a.ART_NM) as artist, group_concat(c.ARTIST) as artId from concert c join artist a on c.ARTIST = a.ART_ID group by c.CON_ID;";
   $result = mysqli_query($conn, $sql); 
   $prevRow=null;
   $count=0;
   $yoil = array("일","월","화","수","목","금","토");
   if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    if($prevRow==$row["CON_DATE"]){
       echo "<br>";
    }
    else{
       $count=0;
       echo "<br><br>";
       echo "<b>";
       $prevRow=$row["CON_DATE"];
       $outDate=date("m월 d일",strtotime($prevRow));
       $conYoil=$yoil[date('w', strtotime($prevRow))];
       if($conYoil=="일"){
          echo "<font color=red>";
       }
       elseif($conYoil=="토"){
          echo "<font color=blue>";
       }
       else{
          echo "<font color=black>";
       }
       echo $outDate." ".$conYoil."요일";
       echo "</font></b>";
       echo "<br>";
    }
    if($count==5){
       echo "<br>";
       $count=0;
    }
    $count++;
   
    $artists = [];
  
    $artist = strtok($row["artist"], ",");
    
    //echo "<a>".$artist."</h1>";
   while( $artist !== false) {
       $artists[] = $artist;
       $artist = strtok(",");
    }

   $artIds = [];
   $artId = strtok($row["artId"], ",");
   while( $artId !== false) {
      $artIds[] = $artId;
      $artId = strtok(",");
   }
    //json_encode($artists);
   for ($x = 0; $x < count($artists); $x++) {
      //$val = json_encode($artists[$x]);
      echo "<a href='javascript:showArtist(".$artIds[$x].");'>".$artists[$x]."</a>";
      if ($x < count($artists) - 1)
         echo ", ";
   }

    echo "-<b><a href='javascript:showSite(".$row["SITE"].");'>".$row["place"]."</a></b>";
    echo "<a href='javascript:showDetail(".$row["CON_ID"].");'>[".$row["ENTRYTYPE"]."]</a>";
    }
    }else{
    echo "테이블에 데이터가 없습니다.";
    };
    ?>
   </div><!--conAll div End-->

   </td>
   <!-- </div>conText div end -->
   <td style="width:50%;">
   
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
<<<<<<< HEAD
         <div class="siteColumn" id="siteNm"></div>
         <img class="siteColumn" id="siteImg" src="#"/>
         <div class="siteColumn" id="siteAddr"></div>
         <div class="siteColumn" id="map" style="width:100%;height:400px;padding:20px 15px;"></div>
=======
         <div id="siteNm"></div>
         <img id="siteImg" src="#"/>
         <div id="siteAddr"></div>
         <div id="map" style="width:100%;height:400px;"></div>
>>>>>>> 014de878db345fb6711c076e366e3772cebf9316
      </div>

      <div id="artistContents" style="display:none;">
         <div id="explainLine">
            <div class="artistColumn">
               <div class="arttitle">소개</div>
               <div class="artdetail" id="artistIntro"></div>
            </div>
            <div class="artistColumn">
               <div class="arttitle">링크</div>
               <div class="artdetail" id="artistLink"><a id="artLink" href="#">아티스트 더보기</a></div>
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