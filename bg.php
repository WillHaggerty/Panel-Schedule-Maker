<?php
require('config.php');

if (isset($_GET['q'])) {
$theywant = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);

$con = new mysqli($server['server'],$server['username'],$server['password'],$server['database']);
if (mysqli_connect_errno()) {
 printf("Connect failed: %s\n", mysqli_connect_error());
 exit();
}

$sql = mysqli_query($con, "SELECT `index`, `panel_name` FROM `panels` WHERE `job` = $theywant");
echo "<select name='panel_index' class='panelbox' size='2'>";
while ($row = mysqli_fetch_array($sql, MYSQL_ASSOC)) {
 echo "<option value='".$row['index']."'>".$row['panel_name']."</option>";
}
echo "</select>";
mysqli_close($con);

}
?>
