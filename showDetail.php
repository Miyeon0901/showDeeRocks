
<?php
include_once("db_connect.php");
$conId = $_POST['conId'];
$sqlEvents = "SELECT CON_DATE, CON_ID, ENTRYTYPE, CON_LINK, SITE_NAME as place, group_concat(artist) as artist, CON_TIME, CON_PRICE, CON_NAME from concert where CON_ID=".$conId." group by CON_ID;";
$result = mysqli_query($conn, $sqlEvents);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $res = $row;
    }
}
echo json_encode($res);
exit;
?>
<script type="text/javascript" src="js/showDetail.js"></script>