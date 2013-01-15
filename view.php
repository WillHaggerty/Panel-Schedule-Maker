<?php
################################################################
#              Scripted by: Will Haggerty                      #
#                  January 13, 2013                            #
#            Please leave this comment intact                  #
################################################################ 
require('config.php');
?>
<!doctype html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View panel data</title>
<script>
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtGoal").innerHTML="";
  return;
  } 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtGoal").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","bg.php?q="+str,true);
xmlhttp.send();
}
</script>
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
 width: 24px;
 text-align: center;
 font-weight: bold;
 font-size: 15px;
}
.spacer {
 width: 2px;
}
.circuit {
 border: 1px black solid;
 width: 125px;
 padding: 1px 4px 1px 4px;
 font-size: 14px;
}
.nobottom {
 border-width: 1px 1px 0px 1px;
 border-color: black;
 border-style: solid;
 width: 125px;
 padding: 1px 4px 1px 4px;
 font-size: 14px;
}
.joined {
 border-width: 0px 1px 0px 1px;
 border-color: black;
 border-style: solid;
 width: 125px;
 padding: 1px 4px 1px 4px;
 font-size: 14px;
}
.thebox {
 float: left;
 min-width: 200px;
 height: 200px;
 font-size: 14px;
}
.panelbox {
 min-width: 200px;
 height: 200px;
 font-size: 14px;
}
.no-border {
 border: 0px white solid;
}
</style>
</head>

<body>
<?php
if (isset($_POST['panel_index'])) {
$con = new mysqli($server['server'],$server['username'],$server['password'],$server['database']);
if (!$con) {
 die('Could not connect: ' . mysql_error());
}

$result = mysqli_query($con, "SELECT * FROM `panels` WHERE `index` = ".$_POST['panel_index']);
$row = mysqli_fetch_array($result);

$panel_data = unserialize($row['panel_dump']);

mysqli_close($con);

function check($str1,$str2) {
if (empty($str2)) {$str2 = "NULL";} else {$str2 = $str2;}
# If the current cell does not contain 'twopole', but the next one does, rowspan
if ($str1 != "twopole" && $str2 == "twopole") {
 echo "<td class='circuit' rowspan='2'>".$str1."</td>";}
# If the current cell does not contain 'threepole', but the next two do, rowspan
elseif ($str1 != "threepole" && $str2 == "threepole") {
 echo "<td class='circuit' rowspan='3'>".$str1."</td>";}
elseif ($str1 == "twopole" || $str1 == "threepole") {echo "";}
else {echo "<td class='circuit'>".$str1."</td>";}
}
?>
<table>
<?php

echo "
<tr>
<td class='top left'>".$row['panel_name']."</td>
<td class='top' colspan='3'></td>
<td class='top right'>".$row['panel_volt']."</td>
</tr>
";

$i = $row['cct_start'];

while ($i < $row['num_cct']) {
 echo "<tr>";
 if (($i+2) > $row['num_cct']) {$str2 = NULL;} else {$str2 = $panel_data['cct'.($i+2)];}
 check($panel_data['cct'.$i],$str2);
 echo "<td class='numbers'>".$i."</td>";
 $i++;
 echo "<td class='spacer'></td>";
 echo "<td class='numbers'>".$i."</td>";
 if (($i+2) > $row['num_cct']) {$str2 = NULL;} else {$str2 = $panel_data['cct'.($i+2)];}
 check($panel_data['cct'.$i],$str2);
 echo "</tr>\n";
 $i++;
}
?>
</table>
<?php
} else {

$con = mysql_connect($server['server'],$server['username'],$server['password']);
if (!$con) {
 die('Could not connect: ' . mysql_error());
}
mysql_select_db($server['database'], $con);

$result = mysql_query("SELECT `index`, `job_name` FROM `job`");
$storeArray = Array();
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
 $storeArray[] = $row;
}

mysql_close($con);

?>
<form action='#' method='post'>
<fieldset class='no-border'>
<select class='thebox' size='2' name='job'<?php if (!empty($storeArray)) {echo " onchange='showUser(this.value)'";} ?>>
<?php
if (!empty($storeArray)) {
 foreach ($storeArray as $value) {echo "<option value='$value[index]'>$value[job_name]</option>";}
} else {echo "<option> No jobs in database</option>";}
?>
</select>


<div id="txtGoal">Panels will be listed here.</div>

</fieldset>
<br/><input style='width: 150px;' type='submit'<?php if (empty($storeArray)) {echo "disabled";} ?>>
</form>
<p><a href="./new.php">Enter a new panel/job.</a></p>
<?php
} ?>

</body>
</html>
