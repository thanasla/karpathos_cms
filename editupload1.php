<?php include 'configuration.php'; ?>
<?php

if ($_GET["id"]=="")
	{$id=1;}
	else
	{$id=$_GET["id"];} 
 
 
 
 
 
 
$con=mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if (mysqli_connect_errno())
  {}
$result = mysqli_query($con,"SELECT max(photo_id) as photo_id  FROM photo_gallery;");
while($row = mysqli_fetch_array($result))
  {
  $max_photo_id=$row['photo_id'];
  }
mysqli_close($con);


if (!empty($_FILES)) {
	
	$string=$_FILES['file']['name'];	
	$whatIWant = substr($string, strpos($string, ".") + 1);
     
    $tempFile = $_FILES['file']['tmp_name'];           
   $targetFile =  'uploads/'.'photo_'.(string)($max_photo_id+1).".".$whatIWant;
    move_uploaded_file($tempFile,$targetFile);
        
	$con=mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
	mysqli_query($con,"INSERT INTO photo_gallery (id,photo_id,photo_name,photo_order) values (".$id.",".($max_photo_id+1).",'photo_".(string)($max_photo_id+1).".".$whatIWant."',".($max_photo_id+1).");");
	mysqli_close($con);

	  
      
}
?>
