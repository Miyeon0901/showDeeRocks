
<?php
include_once("db_connect.php");
error_reporting(E_ALL);
$siteId = $_POST['siteId'];
$sqlEvents = "SELECT * from site where SITE_ID=".$siteId;
$result = mysqli_query($conn, $sqlEvents);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $res = $row;
    }
}
echo json_encode($res);
exit;
?>