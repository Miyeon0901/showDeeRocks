<?php
include_once("db_connect.php");
$sqlEvents = "SELECT CON_LINK, CON_ID as id,ENTRYTYPE ,CON_DATE as start_date, CON_DATE as end_date, s.SITE_NAME as description, group_concat(artist) as title from concert as co join site as s on s.SITE_ID =co.site group by CON_ID ;";
$resultset = mysqli_query($conn, $sqlEvents) or die("database error:". mysqli_error($conn));
$calendar = array();
$count=0;
while( $rows = mysqli_fetch_assoc($resultset) ) {	
	// convert  date to milliseconds
	$start = strtotime($rows['start_date']) * 1000;
	$end = strtotime($rows['end_date']) * 1000;	
    $title = $rows['title']."-".$rows['description']."[".$rows['ENTRYTYPE']."]";
	$calendar[] = array(
        'id' =>$rows['id'],
        'title' => "$title",
        'url' => $rows['CON_LINK'],
		"class" => 'event-important',
        'start' => "$start",
        'end' => "$end",
    );
}
$calendarData = array(
	"success" => 1,	
    "result"=>$calendar);
echo json_encode($calendarData);
exit;
?>