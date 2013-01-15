<?php
################################################################
#              Scripted by: Will Haggerty                      #
#                  January 13, 2013                            #
#            Please leave this comment intact                  #
################################################################
require('config.php');
$con = new mysqli($server['server'],$server['username'],$server['password'],$server['database']);
if (mysqli_connect_errno()) {
 printf("Connect failed: %s\n", mysqli_connect_error());
 exit();
}

global $job_num;
$newjob = 0;
#$job_num = 2;
if (!isset($_POST['job-list']) && isset($_POST['job_name'])) {
 $result = mysqli_query($con, "INSERT IGNORE INTO job (`job_name`) VALUES ('".$_POST['job_name']."'), ('".$_POST['job_name']."')");
 if ($result) {
  $job_num = mysqli_insert_id($con);
  $newjob = 1;
 }
} elseif (isset($_POST['job-list'])) {
 $job_num = $_POST['job-list'];
} else {
 die('Go Back and try again.');
}

mysqli_close($con);
?>
<!doctype html>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enter panel data</title>
<script type="text/javascript">
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
.main {
 float: left;
 padding-right: 50px;
}
</style>
</head>

<body>
<?php if ($newjob == 1) {echo "<p>\"".$_POST['job_name']."\" has been added</p>";} ?>
<div class='main'><form action='submit.php' method='post'>
<table>
<tr>
<td></td>
<td class='top left'>
Panel name goes here:<br/>
<input title='Panel Title' type='text' name='panel_name' tabindex='1' required></td>
<td class='top' colspan='3'>
<input type='hidden' name='job' value='<?php echo $job_num; ?>'>
</td>
<td class='top right'>
Panel voltage (or note) goes here:<br/>
<input title='Panel Voltage' class='right' type='text' name='panel_volt' tabindex='2'></td>
<td></td>
</tr>

<?php

$i = 1;
$cctnumstart = 1;
$numcct = $_POST['num_cct'];
$tab1 = 3;
$tab2 = $numcct / 2 + $tab1;

while ($i <= $numcct) {
 echo "<tr>";
 echo "<td>
       <input type='button' id='2p$i' name='type$i' value='2-pole' onclick='twopole(this.id)'>
       <input type='button' id='3p$i' name='type$i' value='3-pole' onclick='threepole(this.id)'>
       </td>";
 echo "<td class='circuit'><input type='text' id='$i'name='cct".$i."' tabindex='".$tab1."'></td><td class='numbers'>".$i."</td>";
 $i++;$tab1++;
 echo "<td class='spacer'></td>";
 echo "<td class='numbers'>".$i."</td><td class='circuit'><input type='text' id='$i' name='cct".$i."' tabindex='".$tab2."'></td>";
 echo "<td>
       <input type='button' id='2p$i' name='type$i' value='2-pole' onclick='twopole(this.id)'>
       <input type='button' id='3p$i' name='type$i' value='3-pole' onclick='threepole(this.id)'>
       </td>";
 echo "</tr>";
 $i++;$tab2++;
}

?>
<tr><td colspan='7' class='right'>
<input style='width: 250px;' type='submit' tabindex='<?php echo $tab2; ?>'> (Only click once)
</td></tr>
</table>
</form></div>
<div><ul>
<li><strong>IMPORTANT: </strong>A panel name is required!</li>
<li>Click on 2 or 3-pole as needed, ignore 'twopole' or 'threepole' when it comes up</li>
<li>Do not refresh the page!</li>
</ul></div>
</body>
</html>
