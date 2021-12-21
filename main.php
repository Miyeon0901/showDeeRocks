<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>ShowDeeRocks</title>
	<!-- add-line1 -->
        <link rel="stylesheet" href="./css/contents.css" type="text/css"> <!-- delete-line -->
        <!-- <script src="./includeHTML.js"></script> -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?ncpClientId=7dgihuvglz&submodules=geocoder"></script>
  <script>
    function showDetail(con_id) {
      $.ajax({
            url : "showDetail.php",
            type : "post",
            data : {
                conId : con_id,
            },
            success : function(res) {
               if(res) {
                  data = JSON.parse(res);
                  $("#explainTitle").text(data.CON_NAME); //공연명
                  $("#explainArtist").text(data.artist); //출연진
                  //$("#explainLink").text(data.CON_LINK);
                  $("#explainPnC").text(data.place); //장소
                  $("#explainTime").text(data.CON_TIME); //시간
                  $("#explainPrice").text(data.CON_PRICE); //가격
                  $("#conLink").attr("href",data.CON_LINK); //예매링크
               }
            }
        });
    }
    var mapOptions = {
         center: new naver.maps.LatLng(37.3595704, 127.105399),
         zoom: 30,
         mapTypeControl: true
      };
      var infoWindow = new naver.maps.InfoWindow({
         anchorSkew: true
      });
   var map;
   function showSite() {
      
      $.ajax({
            url : "showSite.php",
            type : "post",
            data : {
                //conId : con_id,
            },
            success : function(res) {
               if(res) {
                  data = JSON.parse(res);
                  //alert(data.map);
                  
     
                  map = new naver.maps.Map('map', mapOptions);
                  searchAddressToCoordinate(data.map);
                  
               }
            }
         
      });
      
   }

    function searchAddressToCoordinate(address) {
       //alert(address);
  naver.maps.Service.geocode({
    query: address
  }, function(status, response) {
    if (status === naver.maps.Service.Status.ERROR) {
      if (!address) {
        return alert('Geocode Error, Please check address');
      }
      return alert('Geocode Error, address:' + address);
    }

    if (response.v2.meta.totalCount === 0) {
      return alert('No result.');
    }
    var item = response.v2.addresses[0];
    var point = new naver.maps.Point(item.x, item.y);
    infoWindow.setContent([
      address
    ].join('\n'));
    map.setCenter(point);
    infoWindow.open(map, point);
  });
}

 </script>
 <script>
jQuery(function($) {
var conId = '';
$("body").css("display", "none");
$("body").fadeIn(500);
$("a.transition").click(function(event){
event.preventDefault();
linkLocation = this.href;
$("body").fadeOut(500, redirectPage);
});
function redirectPage() {
window.location = linkLocation;
}
});
</script>
<script>
   function showCalendar()
   {
      //alert("hello");
      var display = $('#tab02').attr('class');

      if (display == "hidden") {
         $('#tab02').removeClass('hidden');
         $('#tab01').addClass('hidden');
      } else {
         $('#tab01').removeClass('hidden');
         $('#tab02').addClass('hidden');
      }
   }
</script>
<style>
   /* 공연정보 디테일 스타일 #explainLine */
   .explainColumn {display:flex; flex-direction:row; align-items:center; margin:10px 0;}
   .extitle {width:90px; padding:15px 10px 15px 0; text-align:center;}
   .exdetail {width:200px; padding:15px 10px; border:5px solid black; text-align:center; font-weight:bold;}
   #explainLine{padding:20px 0; width:100%; display:flex; flex-direction:column; align-items:center;}
   #explainTitle{font-weight:bold; font-size:20px;}
</style>

    </head>
    
    <body>
<!--고정 메뉴-->
<header>
         <!-- <div style="float:left;">
            <h1><a href="http://showdeerocks.info">[쇼디락스]</a></h1>
         </div>
         <div style="float:right;">
            <nav>
            <li><a href="2109page.html">지난 공연<span>▼</span></a>
                <ul>
                    <li><a href="2107page.html">21년 7월</a></li>
                    <li><a href="2108page.html">21년 8월</li>
                    <li><a href="2109page.html">21년 9월</li>

                </ul>
            &nbsp;
            </li>
            <a href="https://www.instagram.com/showdeerocks"><span>인스타그램</span></a>
            &nbsp;
              <a href="https://digging.kr/"><span>[파트너]디깅매거진</span></a>
            </nav>
         </div> -->
   </header>
   <!--고정메뉴-->

        <div class="Logo">
            <a href="http://showdeerocks.info/"><img class="Header" src="src/logoimg2.png" border="0"></a><br>
            <h1>전 체 일 정</h1>
        </div>
            <!-- <div id="sns">
                <a href="https://twitter.com/showdee_rocks?ref_src=twsrc%5Etfw"><img src="src/sns1.png"></a>
                <a href="https://www.instagram.com/showdeerocks"><img src="src/sns3.png"></a>
            </div> -->
            <!-- <div class="Comment">
            <div class="Comment-line">
                최근 1주일 이내에 추가되는 공연들은 파란색 글씨로 표기됩니다.<br>
                최근 수정일 : 2021 - 09 - 07 
            </div>
        </div> -->
        <div class="tab">
      
      <!-- <ul class="tabnav">
        <li><a href="#tab01">텍스트</a></li>   
        <li><a href="#tab02">달력</a></li>
     </ul> -->
     <div id="checkLine">
        <a href="javascript:showCalendar();">달력이미지</a>
        Filter : 
        <a href="#" class="blue">[신규공연]</a> 
        <a href="#" style="color: aquablue important!;">[무료공연]</a> 
        <a href="#">[홍대공연]</a>
     </div> 
      <div class="tabcontent">
         <div id="tab01">
      <!-- <div id="checkLine">
         <input type='checkbox' name='freeChk' id='freeChk' value='yyy'>무료공연만 보기
      </div> -->
<div class='mainContents' style="width: 100%; height:auto;">
<table style="width:100%;">
   <tr style="width:100%;">
      <td style="width:50%;">
<!-- <div id='conText' style="background-color: red; width:50%; float:left;"> -->
<div class='conOn' id='conAll' style="height:100vh; overflow-y:scroll;">
<?php
   $conn = mysqli_connect("showdeedb.cipqx10duwv3.us-east-2.rds.amazonaws.com", "ShowdeeMaster", "wogusdla1!" , "showdeerocks");
   $sql = "SELECT CON_DATE, CON_ID,ENTRYTYPE,CON_LINK, SITE_NAME as place, group_concat(artist) as artist from concert group by CON_ID;";
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
    
    echo $row["artist"]. "-<b><a href='javascript:showSite();'>" . $row["place"]."</a></b><a href='javascript:showDetail(".$row["CON_ID"].");'>[".$row["ENTRYTYPE"]."]</a>";
    }
    }else{
    echo "테이블에 데이터가 없습니다.";
    };
    ?>
   </div><!--conAll div End-->
   <div class='freeOn' id='freeConView'  style="height:100vh; overflow-y:scroll;">
   <?php
    /* 전체공연 end*/
    /* 무료공연 div */
    
    $sqlFree="SELECT CON_DATE, CON_ID,ENTRYTYPE,CON_LINK, s.SITE_NAME as place, group_concat(artist) as artist from concert as co join site as s on s.SITE_ID =co.site where con_price=0 group by CON_ID ;";
    $resultFree=mysqli_query($conn,$sqlFree);
      while($row = mysqli_fetch_assoc($resultFree)) {
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
         echo $outDate.$conYoil."요일";
         echo "</font></b>";
         echo "<br><br>";
      }
      if($count==5){
         echo "<br>";
         $count=0;
      }
      $count++;
      echo $row["artist"]. "-<b>" . $row["place"]."</b><a href='".$row["CON_LINK"]."'>[".$row["ENTRYTYPE"]."]</a>";
      }

     
   // include_once("../event-calendar/Event/index.php");
   mysqli_close($conn); // 디비 접속 닫기 
?>
</div><!--free div end-->
   </td>
   <!-- </div>conText div end -->
   <td style="width:50%;">
   <div id="map" style="width:100%;height:400px;"></div>


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


<!-- <script>
$(":checkbox[name='freeChk']").on({
  click: function(e) {
    $('#freeConView').toggleClass('on');
    $('#conAll').toggleClass('on');
  }
});
$(function(){
  $('.tabcontent > div').hide();
  $('.tabnav a').click(function () {
    $('.tabcontent > div').hide().filter(this.hash).fadeIn();
    $('.tabnav a').removeClass('active');
    $(this).addClass('active');
    return false;
  }).filter(':eq(0)').click();
  });
</script>    -->

</html>