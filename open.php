<?php 
if ($_FILES["openFile"]["error"] > 0) {
	echo "Error: " . $_FILES["openFile"]["error"] . "<br />";
} else {
	$file = fopen($_FILES["openFile"]["tmp_name"], "rb");
	$line = fgets($file);
	$arr = explode('|', $line, 3);
	$name = $arr[0];
	$type = $arr[1];
	$table = $arr[2];
	echo "<script>parent.openCalendar('".$name."','".$type."', ".$table.");</script>";	
}
?>
