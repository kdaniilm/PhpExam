<?php
include_once("functions.php");

$link = connect();
$cid = $_GET["cid"];

$selectCommand = "select id,hotel,stars from Hotels where cityId =".$cid;
$res = mysqli_query($link, $selectCommand);
?>
<table class="table table-stripped" id="table1">
<thead><tr>Hotel<th> <tr>Coast<th> <tr>Stars<th> <tr>Details<th> </thead>
<tbody>

<?php
while($row = mysqli_fetch_array($res, MYSQLI_NUM)){
    echo "<tr><td>".$row[1]."</td> <td>".$row[3]."</td>";
    echo "<td><a href='pages/info.php?hotel=$row[0]' class='btn btn-default btn-xs'>DETAILS</a></td></tr>";
}

    mysqli_free_result($res);
?>

</tbody>
</table>