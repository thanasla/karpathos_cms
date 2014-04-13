<?php include 'configuration.php'; ?>
<?php
	mysql_connect($dbhost,$dbuser,$dbpass);
	mysql_select_db($dbname) or die( "Unable to select database");
	
	parse_str($_POST['pages'], $pageOrder);
	foreach ($pageOrder['page'] as $key => $value) {
		mysql_query("UPDATE photo_gallery SET `photo_order` = '$key' WHERE `photo_id` = '$value'") or die(mysql_error());
	}
?>