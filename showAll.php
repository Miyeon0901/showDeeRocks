
<?php
include_once("db_connect.php");
$filter = $_POST['filter'];
if ($filter == 'all') 
    $sqlEvents = "SELECT ART_NM, CON_IMG,CON_NAME, CON_DATE, CON_TIME, CON_ID, ENTRYTYPE, CON_LINK, SITE, SITE_NAME as place, group_concat(a.ART_NM) as artist, group_concat(c.ARTIST) as artId from concert c join artist a on c.ARTIST = a.ART_ID /*where date(c.CON_DATE) between now() and date_add(now(), interval 60 day)*/ group by c.CON_ID order by c.CON_DATE, c.CON_TIME;";
else if ($filter == 'free')
    $sqlEvents = "SELECT ART_NM, CON_IMG, CON_NAME, CON_DATE, CON_TIME, CON_ID, ENTRYTYPE, CON_LINK, SITE, SITE_NAME as place, group_concat(a.ART_NM) as artist, group_concat(c.ARTIST) as artId from concert c join artist a on c.ARTIST = a.ART_ID where c.con_price=0 AND date(c.CON_DATE) between now() and date_add(now(), interval 60 day) group by c.CON_ID order by c.CON_DATE, c.CON_TIME;";
else if ($filter == 'hd')
    $sqlEvents = "SELECT ART_NM, CON_IMG, CON_NAME, CON_DATE, CON_TIME, CON_ID, ENTRYTYPE, CON_LINK, SITE, SITE_NAME as place, group_concat(a.ART_NM) as artist, group_concat(c.ARTIST) as artId from concert c join artist a on c.ARTIST = a.ART_ID where c.HU=1 AND date(c.CON_DATE) between now() and date_add(now(), interval 60 day) group by c.CON_ID order by c.CON_DATE, c.CON_TIME;";
else if ($filter == 'new')
    $sqlEvents = "SELECT ART_NM, CON_IMG, CON_NAME, CON_DATE, CON_TIME, CON_ID, ENTRYTYPE, CON_LINK, SITE, SITE_NAME as place, group_concat(a.ART_NM) as artist, group_concat(c.ARTIST) as artId from concert c join artist a on c.ARTIST = a.ART_ID where date(c.updated) between date_add(now(), interval -7 day) and now() AND date(c.CON_DATE) between now() and date_add(now(), interval 60 day) group by c.CON_ID order by c.CON_DATE, c.CON_TIME;";


$result = mysqli_query($conn, $sqlEvents);
$prevRow=null;
$res = [];  
   if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $res[] = $row;
    }
}
    
echo json_encode($res);
exit;
?>