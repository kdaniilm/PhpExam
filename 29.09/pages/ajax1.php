<?php
include_once("functions.php");

$link = connect();
$cid = $_GET["cid"];

$selectCommand = "select * from cities where countryId =".$cid;
$res = mysqli_query($link, $selectCommand);

echo "<option value='0'> Select Cities<option>";
while($row = mysqli_fetch_array($res, MYSQLI_NUM)){
    echo "<option value='$row[0]'> $row[1]</option>";
}
mysqli_free_result($res);

?>