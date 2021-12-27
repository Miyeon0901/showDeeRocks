<?php 
// include('header.php');
include('header.php');
?>
<title>phpzag.com : Demo Create Event Calendar with jQuery, PHP and MySQL</title>
<link rel="stylesheet" href="css/calendar.css">
<!-- 버튼 스타일 -->
<style>
   .btn-primary {background-image:none;}
   .left {color:white; background-color: #333;}
   .right {color:white; background-color: #333;}

   .btn-warning {background-image: none;}
   .btn-warning.active {background-color: #0e0d0d; border-color:none;}
   .year {color:white; background-color: #333;}
   .month {color:white; background-color: #333;}
   .week {color:white; background-color: #333;}
   
</style>
<?php 
//include('container.php');
include('container.php');
?>
<div class="container">   
   <!-- <h2>쇼디락스 캘린더뷰</h2>    타이틀--> 
   <div class="page-header">
      <div class="pull-right form-inline">
         <div class="btn-group">
            <button class="btn btn-primary left" data-calendar-nav="prev"><< 이전 달</button>
            <button class="btn btn-default mid" data-calendar-nav="today">이번 달</button>
            <button class="btn btn-primary right" data-calendar-nav="next">다음 달 >></button>
         </div>
         <div class="btn-group">
            <button class="btn btn-warning year" data-calendar-view="year">Year</button>
            <button class="btn btn-warning month" data-calendar-view="month">Month</button>
            <button class="btn btn-warning week" data-calendar-view="week">Week</button>
            <!-- <button class="btn btn-warning" data-calendar-view="day">Day</button> -->
         </div>
</div>
   </div>
   <div class="row">
      <div class="col-md-9">
         <div id="showEventCalendar"></div>
      </div>
   </div>   
   <!-- <div style="margin:50px 0px 0px 0px;">
      <a class="btn btn-default read-more" style="background:#3399ff;color:white" href="http://www.phpzag.com/create-event-calendar-with-jquery-php-and-mysql/">Back to Tutorial</a>
   </div> -->
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/events.js"></script>
<?php include('footer.php');?>