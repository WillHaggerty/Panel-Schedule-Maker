<?php
require('config.php');
$con = new mysqli($server['server'],$server['username'],$server['password'],$server['database']);
if (mysqli_connect_errno()) {
 printf("Connect failed: %s\n", mysqli_connect_error());
 exit();
}

global $job_num;
if (!isset($_POST['job-list'])) {
 $result = mysqli_query($con, "INSERT INTO `job` (`job_name`) VALUES ('".$_POST['job_name']."')");
 if ($result) {
  $job_num = mysqli_insert_id($con);
 }
} else {
 $job_num = $_POST['job-list'];
}

#INSERT INTO `panel`.`job` (`index`, `job_name`) VALUES (NULL, 'Test', '');

mysqli_close($con);
?>
<!doctype html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enter panel data</title>
<style type="text/css">
.top {
 border: 2px black solid;
 padding: 1px 4px 1px 4px;
 font-size: 16px;
}
.left {
 text-align: left;
}
.right {
 text-align: right;
}
.numbers {
 border: 1px black solid;
 text-align: center;
 font-weight: bold;
 font-size: 15px;
}
.spacer {
}
.circuit {
 border: 1px black solid;
 padding: 1px 4px 1px 4px;
 font-size: 14px;
}

</style>
</head>

<body>
<form name='panel' action='submit.php' method='post'>
<table>

<tr>
<td class='top left'><input type='text' name='panel_name' tabindex='1' required></td>
<td class='top' colspan='3'>
<input type='hidden' name='job' value='<?php echo $job_num; ?>'>
</td>
<td class='top right'><input class='right' type='text' name='panel_volt' tabindex='2'></td>
</tr>

<?php

$i = 1;
$cctnumstart = 1;
$numcct = $_POST['num_cct'];
$tab1 = 3;
$tab2 = $numcct / 2 + $tab1;

while ($i <= $numcct) {
 echo "<tr>";
 echo "<td class='circuit'><input type='text' name='cct".$i."' tabindex='".$tab1."'></td><td class='numbers'>".$i."</td>";
 $i++;$tab1++;
 echo "<td class='spacer'></td>";
 echo "<td class='numbers'>".$i."</td><td class='circuit'><input type='text' name='cct".$i."' tabindex='".$tab2."'></td>";
 echo "</tr>";
 $i++;$tab2++;
}

?>
<tr><td colspan='5' class='right'>
<input style='width: 250px;' type='submit' tabindex='<?php echo $tab2; ?>'>
</td></tr>
</table>
</form>
</body>
</html>
