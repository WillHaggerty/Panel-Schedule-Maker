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
if (isset($_POST['panel_name'])) {
 $num_cct = count($_POST)-3;
 $serial_data = serialize($_POST);

 $con = new mysqli($server['server'],$server['username'],$server['password'],$server['database']);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

 $sql="INSERT INTO `panels` (`index`, `job`, `cct_start`, `num_cct`, `panel_name`, `panel_volt`, `panel_dump`)
       VALUES (NULL, '$_POST[job]', '1', '$num_cct', '$_POST[panel_name]', '$_POST[panel_volt]', '$serial_data')";

 if (!mysqli_query($con, $sql)) {
  die('Error: ' . mysqli_error());
 }
 echo "<p>1 record has been added. (".$_POST['panel_name'].")</p>";
 echo "<p>Do not refresh this page.</p>";
 echo "<p><a href='view.php'>View</a> or <a href='new.php'>enter</a> a panel</p>";
 mysqli_close($con);
} else {
 echo "Please <a href='enter.php'>go back</a>\n";
}
?>
</body>
</html>
