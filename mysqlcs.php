<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>ShowdeeTest</title>
	<!-- add-line1 -->
        <link rel="stylesheet" href="./css/index copy.css" type="text/css"> <!-- delete-line -->
        <script src="./includeHTML.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    </head>
    
    <body>
<!--고정 메뉴-->
<header>
    <div style="float:left;">
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
    </div>
</header>   
<!--고정메뉴-->

        <div class="Logo">
            <a href="http://showdeerocks.info/"><img class="Header" src="./src/showdee_logo.png" border="0"></a>
        </div>
            <div id="sns">
                <a href="https://twitter.com/showdee_rocks?ref_src=twsrc%5Etfw"><img src="src/sns1.png"></a>
                <a href="https://www.instagram.com/showdeerocks"><img src="src/sns3.png"></a>
            </div>
            <div class="Comment">
            <div class="Comment-line">
                최근 1주일 이내에 추가되는 공연들은 파란색 글씨로 표기됩니다.<br>
                최근 수정일 : 2021 - 10 - 18
            </div>
        </div>
   <div class="tab">
       <ul class="tabnav">
         <li><a href="#tab01">텍스트</a></li>   
         <li><a href="#tab02">달력</a></li>
      </ul>
      <div class="tabcontent">
         <div id="tab01">
      <div id="checkLine">
         <input type='checkbox' name='freeChk' id='freeChk' value='yyy'>무료공연만 보기
      </div>
<div class='mainContents' style="width: 100%; height:auto;">
<!-- <div id='conText' style="background-color: red; width:50%; float:left;"> -->
<div class='conOn' id='conAll'>
<?php
   $conn = mysqli_connect("localhost", "root", "wogusdla11" , "showdee_db");
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
    
    echo $row["artist"]. "  -  <b>" . $row["place"]."</b><a href='".$row["CON_LINK"]."'>[".$row["ENTRYTYPE"]."]</a>";
    }
    }else{
    echo "테이블에 데이터가 없습니다.";
    };
    ?>
   </div><!--conAll div End-->
   <div class='freeOn' id='freeConView'>
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
   <!-- </div>conText div end -->
   
   </div> <!--mainContents div end-->
   
   </div><!--tab01 div end-->
   <div id="tab02">
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


<script>
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
</script>   

</html>