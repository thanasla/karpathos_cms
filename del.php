<?php include 'configuration.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!session_is_registered(myusername)){
header("location:index.php");
}
?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="initialize()" style="background-color:#F0F0F0;">

	<!-- HEADER -->
	<div style="background-color:#33CCFF;text-align:center;color:white;margin-left:-8px;margin-right:-8px;margin-top:-8px;" >
        <br><h1>DELETE ENTRY</h1><br>

    </div>
	<!-- LEFT MENU -->
	<div style="float:left;background-color:#A2B0CC;height:800px;width:20%;margin-left:-8px">
	<br>
	<a href="addentry.php"><input type="button" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;" value="ADD ENTRY"></a><br>
	<a href="edit_delete_entry.php"><input type="button" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;" value="EDIT/DELETE ENTRY"></a>	
<form name="form1" method="post" action="logout.php">
<input type="submit" name="Submit" value="Logout" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;">
</form>	
	</div>
	
	<div style="background-color:#F0F0F0;height:800px;overflow:hidden;" >
<br>
<?php
mysql_connect($dbhost, $dbuser, $dbpass)or die("cannot connect");
mysql_select_db($dbname)or die("cannot select DB");
$id=$_GET['id'];


$sql="update entry set hidden=1 WHERE id=".$id.";";
mysql_query($sql);
echo "ENTRY DELETED";
?>
<br>
<a style="color:black;" href="edit_delete_entry.php" ><input type="button" class="btn btn-info" style="width:100px;height:32px;margin-bottom:2px;" value="BACK"></a>		  
	</div>
      
    
</body>
</html>



