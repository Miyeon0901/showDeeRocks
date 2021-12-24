
<?php

include_once("db_connect.php");
$artId = $_POST['artId'];
$sqlEvents = "SELECT * FROM artist WHERE ART_ID=".$artId;
$result = mysqli_query($conn, $sqlEvents);
// echo mysqli_num_rows($result);
if (mysqli_num_rows($result) > 0) {
   
    while($row = mysqli_fetch_assoc($result)) {
        $res = $row;
    }
}
echo json_encode($res);
exit;

?>