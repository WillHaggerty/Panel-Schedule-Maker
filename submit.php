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
if (isset($_POST['panel_name']) && !empty($_POST['panel_name']) && is_numeric($_POST['num_cct']) && is_numeric($_POST['job'])) {
 $num_cct = $_POST['num_cct'];
 $job = $_POST['job'];
 $panel_name = htmlentities ( trim( $_POST['panel_name'] ), ENT_QUOTES );
 $panel_volt = htmlentities ( trim( $_POST['panel_volt'] ), ENT_QUOTES );

 $panel_cct = array_slice($_POST,4);
 foreach ($panel_cct as $k => $v) {
  $panel_cct[$k] = htmlspecialchars( trim( $v ) );
 }
 $com_panel_cct = serialize($panel_cct);
 $con = new mysqli($server['server'],$server['username'],$server['password'],$server['database']);
 if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
 }

 $sql="INSERT INTO `panels` (`index`, `job`, `cct_start`, `num_cct`, `panel_name`, `panel_volt`, `panel_cct`)
       VALUES (NULL, '$job', '1', '$num_cct', '$panel_name', '$panel_volt', '$com_panel_cct')";

 if (!mysqli_query($con, $sql)) {
  die('Error: ' . mysqli_error($con));
 }
 echo "<p>1 record has been added. (".$panel_name.")</p>";
 echo "<p>Do not refresh this page.</p>";
 mysqli_close($con);
} else {
 echo "Please <a href='enter.php'>go back</a>\n";
}
?>
<p><a href='view.php'>View</a>, <a href='edit.php'>Edit</a> or <a href='new.php'>Enter</a> a panel</p>
</body>
</html>
