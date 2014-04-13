<?php

if ($_POST["id"]=="")
	{$id=1;}
	else
	{$id=$_POST["id"];} 
 
$con=mysqli_connect("localhost","root","thanal2106","test");
if (mysqli_connect_errno())
  {}
$result = mysqli_query($con,"SELECT max(photo_id) as photo_id FROM photo_gallery where id=".$id);
while($row = mysqli_fetch_array($result))
  {
  $max_photo_id=$row['photo_id']; 
  }
mysqli_close($con);


if (!empty($_FILES)) {
	
	$string=$_FILES['file']['name'];	
	$whatIWant = substr($string, strpos($string, ".") + 1);
     
    $tempFile = $_FILES['file']['tmp_name'];           
   $targetFile =  'uploads/'. $id.'_photo_'.(string)($max_photo_id+1).".".$whatIWant;
    move_uploaded_file($tempFile,$targetFile);
        
	$con=mysqli_connect("localhost","root","thanal2106","test");
	mysqli_query($con,"INSERT INTO photo_gallery (id,photo_id,photo_name) values (".$id.",".($max_photo_id+1).",'".$id.'_photo_'.(string)($max_photo_id+1).".".$whatIWant."');");
	mysqli_close($con);

	  
      
}
?>
