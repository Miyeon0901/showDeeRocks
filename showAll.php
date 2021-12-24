
<?php
include_once("db_connect.php");
$filter = $_POST['filter'];
if ($filter == 'all') 
    $sqlEvents = "SELECT ART_NM, CON_NAME, CON_DATE, CON_ID, ENTRYTYPE, CON_LINK, SITE, SITE_NAME as place, group_concat(a.ART_NM) as artist, group_concat(c.ARTIST) as artId from concert c join artist a on c.ARTIST = a.ART_ID group by c.CON_ID;";
else if ($filter == 'free')
    $sqlEvents = "SELECT ART_NM, CON_NAME, CON_DATE, CON_ID, ENTRYTYPE, CON_LINK, SITE, SITE_NAME as place, group_concat(a.ART_NM) as artist, group_concat(c.ARTIST) as artId from concert c join artist a on c.ARTIST = a.ART_ID where c.con_price=0 group by c.CON_ID;";
else if ($filter == 'hd')
    $sqlEvents = "SELECT ART_NM, CON_NAME, CON_DATE, CON_ID, ENTRYTYPE, CON_LINK, SITE, SITE_NAME as place, group_concat(a.ART_NM) as artist, group_concat(c.ARTIST) as artId from concert c join artist a on c.ARTIST = a.ART_ID where c.HU=1 group by c.CON_ID;";
else if ($filter == 'new')
    $sqlEvents = "SELECT ART_NM, CON_NAME, CON_DATE, CON_ID, ENTRYTYPE, CON_LINK, SITE, SITE_NAME as place, group_concat(a.ART_NM) as artist, group_concat(c.ARTIST) as artId from concert c join artist a on c.ARTIST = a.ART_ID where date(c.updated) between date_add(now(), interval -7 day) and now() group by c.CON_ID;";


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