<?php include 'configuration.php'; ?>
<?php
if($_GET["ms"] != null) 
	{
		$ms=$_GET["ms"];

	$x="{ \"entries\":[ ";

$con=mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if (mysqli_connect_errno())
  {}
$result = mysqli_query($con,"SELECT * FROM entry where hidden=0;");
while($row = mysqli_fetch_array($result))
  {  	
  	$latest_update=$row['latest_update'];
//	echo "<br>";   	
  	$latest_updatems=strtotime($latest_update); 
//	echo "<br>";  
	if ($latest_updatems>$ms)
	{
	$x=$x." {\"id\": ".$row['id'].",";		
	$x=$x." \"category_id\": ".$row['category_id'].",";			
	$x=$x." \"title\": \"".$row['title']."\",";			
	if ($row['rating_count']!=0)
	{	$x=$x." \"rating_average\": ".$row['rating_average'].",";}
	$x=$x." \"priority\": ".$row['priority'].",";

	$result2 = mysqli_query($con,"SELECT photo_name FROM photo_gallery where id=".$row['id']." ORDER BY `photo_order` ASC;");
	$a=0;
	while($row2 = mysqli_fetch_array($result2))
	{
		if($a==0) 
		{
		$x=$x." \"photo_gallery\" : [";
		$a=1;
		}	
	$x=$x."\"".$row2['photo_name']."\",";		
	}
	if ($a==1)
	{
	$x=substr($x, 0, -1);		
	$x=$x."] ,";}
						
	if ($row['information']!=null)
	{	$x=$x." \"information\": \"".$row['information']."\",";}
	if ($row['phone_number']!=0)
	{	$x=$x." \"phone_number\": ".$row['phone_number'].",";}
	if ($row['address']!=null)
	{	$x=$x." \"address\": \"".$row['address']."\",";}
	if ($row['email']!=null)
	{	$x=$x." \"email\": \"".$row['email']."\",";}
	if ($row['website']!=null)
	{	$x=$x." \"website\": \"".$row['website']."\",";}
	if ($row['facebook']!=null)
	{	$x=$x." \"facebook\": \"".$row['facebook']."\",";}

	$result3 = mysqli_query($con,"SELECT menu_name FROM menu_gallery where id=".$row['id']." ORDER BY `menu_order` ASC;");
	$b=0;
	while($row3 = mysqli_fetch_array($result3))
	{
		if($b==0) 
		{
		$x=$x." \"menu_gallery\" : [";
		$b=1;
		}	
	$x=$x."\"".$row3['menu_name']."\",";		
	}
	if ($b==1)
	{
	$x=substr($x, 0, -1);		
	$x=$x."] ,";
	}

	if ($row['latitude']!=0)
	{	$x=$x." \"latitude\": ".$row['latitude'].",";}
	if ($row['longtitude']!=0)
	{	$x=$x." \"longtitude\": ".$row['longtitude'].",";}
	$x=$x." \"latest_update\": ".$latest_updatems.",";			

	
	$x=substr($x, 0, -1);
	$x=$x."},";	
   }    
  }
  $x=substr($x, 0, -1);
  $x=$x." ], \"latest_update\": ".$ms."}";		
	
		
mysqli_close($con);
header('Content-Type: application/json');
echo $x;
//echo json_encode($x);
}
?>
