
<?php
include_once("db_connect.php");
$siteId = '2001001';
$sqlEvents = "SELECT * from artist where ART_ID=".$artistId;
$result = mysqli_query($conn, $sqlEvents);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $res = $row;
    }
}
echo json_encode($res);
exit;
?>