<?php include 'configuration.php'; ?>
<?php
if($_GET["id"] != null && $_GET["new_rating"] != null ) 
	{
		
	$id=$_GET["id"];
	$new_rating=$_GET["new_rating"];
  $new_latest_update=strtotime("now");


	$con=mysqli_connect($dbhost, $dbuser, $dbpass$dbname);
	if (mysqli_connect_errno())
  	{
  	}

	mysqli_query($con,"UPDATE entry SET rating_average=((rating_average* rating_count)+".$new_rating.")/(rating_count+1) ,rating_count=rating_count+1 where id=".$id.";");
	mysqli_close($con);

	}
?> 


