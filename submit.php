<?php
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
 echo "1 record added";
 mysqli_close($con);
} else {
 echo "Please <a href='enter.php'>go back</a>\n";
}
?>
</body>
</html>
