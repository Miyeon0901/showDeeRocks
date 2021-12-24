
<?php
include_once("db_connect.php");
$sqlEvents = "SELECT CON_NAME, CON_DATE, CON_ID,ENTRYTYPE,CON_LINK, SITE, SITE_NAME as place, group_concat(a.ART_NM) as artist, group_concat(c.ARTIST) as artId from concert c join artist a on c.ARTIST = a.ART_ID group by c.CON_ID;";
$result = mysqli_query($conn, $sqlEvents);
$prevRow=null;
$res = [];
   $count=0;
   $yoil = array("일","월","화","수","목","금","토");
   if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $res[] = $row;
    }
}
    
echo json_encode($res);
exit;
?>