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
<title>Edit panel data</title>
<script type="text/javascript">
function showUser(str) {
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
function twopole(str) {
var newstring = str.substr(2);
var newnum = parseFloat(newstring);
newnum=newnum+2;
 if (document.getElementById(newnum).readOnly == false) {
   document.getElementById(newnum).readOnly = true;
   document.getElementById(newnum).value = "twopole";
   document.getElementById(newnum).style.backgroundColor = "#aaaaaa";
 } else if (document.getElementById(newnum).readOnly == true) {
   document.getElementById(newnum).readOnly = false;
   document.getElementById(newnum).value = "";
   document.getElementById(newnum).style.backgroundColor = "#ffffff";
 }
}
function threepole(str) {
var newstring = str.substr(2);
var newnum = parseFloat(newstring);
newnum=newnum+2
 if (document.getElementById(newnum).readOnly == false) {
  var i=1;
  while ( i < 3 ) {
   document.getElementById(newnum).readOnly = true;
   document.getElementById(newnum).value = "threepole";
   document.getElementById(newnum).style.backgroundColor = "#aaaaaa";
   i=i+1;
   newnum=newnum+2;
  }
 } else if (document.getElementById(newnum).readOnly == true) {
  var i=1;
  while ( i < 3 ) {
   document.getElementById(newnum).readOnly = false;
   document.getElementById(newnum).value = "";
   document.getElementById(newnum).style.backgroundColor = "#ffffff";
   i=i+1;
   newnum=newnum+2;
  }
 }
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
.shaded {
 background-color: #aaaaaa;
}
</style>
</head>

<body>
<h1>Editing</h1>
<?php
if (isset($_POST['panel_index']) && is_numeric($_POST['panel_index'])) {
$con = new mysqli($server['server'],$server['username'],$server['password'],$server['database']);
if (!$con) {
 die('Could not connect: ' . mysql_error());
}

$result = mysqli_query($con, "SELECT * FROM `panels` WHERE `index` = ".$_POST['panel_index']);
$row = mysqli_fetch_array($result);

$panel_cct = unserialize($row['panel_cct']);
mysqli_close($con);

function editcheck($str1) {
if ($str1 == "twopole" || $str1 == "threepole") {
 $str2 = " class='shaded' readonly";
 return $str2;}
}
?>
<form action='update.php' method='post'>
<table>
<tr><td colspan='7' class='right'>
To <strong>delete</strong> this panel, check <strong>both</strong> boxes:
<input type='checkbox' name='del1' value='true'>
<input type='checkbox' name='del2' value='true'>
</td></tr>
<?php

echo "
<tr>
<td></td>
<td class='top left'><input type='text' name='panel_name' value='".$row['panel_name']."' tabindex='1'></td>
<td class='top' colspan='3'><input type='hidden' name='panel_index' value='".$_POST['panel_index']."'></td>
<td class='top right'><input type='text' name='panel_volt' value='".$row['panel_volt']."' tabindex='2'></td>
<td></td>
</tr>
";

$i = $row['cct_start'];
$tab1 = 3;
$tab2 = $row['num_cct'] / 2 + $tab1;

while ($i < $row['num_cct']) {
 echo "<tr>";
 echo "<td>
       <input type='button' id='2p$i' name='type$i' value='2-pole' onclick='twopole(this.id)'>
       <input type='button' id='3p$i' name='type$i' value='3-pole' onclick='threepole(this.id)'>
       </td>";
 echo "<td class='circuit'><input type='text' name='cct".$i."' id='".$i."' value='".$panel_cct['cct'.$i]."'".editcheck($panel_cct['cct'.$i])." tabindex='".$tab1."'></td>";
 echo "<td class='numbers'>".$i."</td>";
 $i++;$tab1++;
 echo "<td class='spacer'></td>";
 echo "<td class='numbers'>".$i."</td>";
 echo "<td class='circuit'><input type='text' name='cct".$i."' id='".$i."' value='".$panel_cct['cct'.$i]."'".editcheck($panel_cct['cct'.$i])." tabindex='".$tab2."'></td>";
 echo "<td>
       <input type='button' id='2p$i' name='type$i' value='2-pole' onclick='twopole(this.id)'>
       <input type='button' id='3p$i' name='type$i' value='3-pole' onclick='threepole(this.id)'>
       </td>";
 echo "</tr>\n";
 $i++;$tab2++;
}
?>
<tr><td colspan='7' class='right'>
<input style='width: 250px;' type='submit' value='Edit' tabindex='<?php echo $tab2; ?>'> (Only click once)
</td></tr>
</table>
</form>
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
<br/><input style='width: 150px;' type='submit' value='Edit'<?php if (empty($storeArray)) {echo " disabled";} ?>>
</form>
<?php
} ?>
<p><a href='view.php'>View</a>, <a href='edit.php'>Edit</a> or <a href='new.php'>Enter</a> a panel</p>
</body>
</html>
