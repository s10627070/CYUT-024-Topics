<?php
/*include("../dbset.inc.php");
$result = $dblink->query("select date1,date2 from room where type='豪華房';");
$row=mysqli_fetch_array($result);
$data = $result->fetch_all();
$num = @$row['date1'];
echo $i[0];*/
include_once ('../dbset.inc.php');
global $dblink;
$result = mysqli_query($dblink,"select date1,date2 from room where type='豪華房';");
$row=mysqli_fetch_all($result);

?>
