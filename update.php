<?php
################################################################
#              Scripted by: Will Haggerty                      #
#                  January 13, 2013                            #
#            Please leave this comment intact                  #
################################################################ 
require("./config.php");
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Enter panel data</title>
</head>

<body>

<?php
if (isset($_POST['del1']) && isset($_POST['del2']) && isset($_POST['panel_index']) && is_numeric($_POST['panel_index']) && isset($_POST['panel_name']) && !empty($_POST['panel_name'])) {
 $panel_name = htmlentities ( trim( $_POST['panel_name'] ), ENT_QUOTES );
 $con = new mysqli($server['server'],$server['username'],$server['password'],$server['database']);
 if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
 }
 $sql="DELETE FROM `panel`.`panels` WHERE `panels`.`index` =".$_POST['panel_index'];
 if (!mysqli_query($con, $sql)) {
  die('Error: ' . mysqli_error($con));
 }

echo "\"".$panel_name."\" has been deleted from the database.";
}
elseif (isset($_POST['panel_index']) && is_numeric($_POST['panel_index']) && isset($_POST['panel_name']) && !empty($_POST['panel_name'])) {
 if (isset($_POST['del1'])) {unset($_POST['del1']);}
 if (isset($_POST['del2'])) {unset($_POST['del2']);}

 $panel_index = $_POST['panel_index'];
 $panel_name = htmlentities ( trim( $_POST['panel_name'] ), ENT_QUOTES );
 $panel_volt = htmlentities ( trim( $_POST['panel_volt'] ), ENT_QUOTES );
 $panel_cct = array_slice($_POST,3);
 foreach ($panel_cct as $k => $v) {
  $panel_cct[$k] = htmlspecialchars( trim( $v ) );
 }
 $com_panel_cct = serialize($panel_cct);

 $con = new mysqli($server['server'],$server['username'],$server['password'],$server['database']);
 if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
 }

 $sql="UPDATE `panel`.`panels`
 SET `panel_name` = '".$panel_name."',
 `panel_volt` = '".$panel_volt."',
 `panel_cct` = '".$com_panel_cct."'
 WHERE `panels`.`index` = ".$panel_index;

 if (!mysqli_query($con, $sql)) {
  die('Error: ' . mysqli_error($con));
 }
 echo "<p>1 record has been updated. (".$_POST['panel_name'].")</p>";
 echo "<p>Do not refresh this page.</p>";
 mysqli_close($con);
} else {
 echo "Please <a href='enter.php'>go back</a>\n";
}
?>
<p><a href='view.php'>View</a>, <a href='edit.php'>Edit</a> or <a href='new.php'>enter</a> a panel</p>
</body>
</html>
