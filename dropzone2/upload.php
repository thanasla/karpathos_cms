<?php

if ($_POST["id"]=="")
	{$id=1;}
	else
	{$id=$_POST["id"];} 
 
$con=mysqli_connect("localhost","root","thanal2106","test");
if (mysqli_connect_errno())
  {}
$result = mysqli_query($con,"SELECT max(menu_id) as menu_id FROM menu_gallery where id=".$id);
while($row = mysqli_fetch_array($result))
  {
  $max_menu_id=$row['menu_id']; 
  }
mysqli_close($con);


if (!empty($_FILES)) {
 
 	$string=$_FILES['file']['name'];	
	$whatIWant = substr($string, strpos($string, ".") + 1);
    
    $tempFile = $_FILES['file']['tmp_name'];           
   $targetFile =  'uploads/'. $id.'_menu_'.(string)($max_menu_id+1).".".$whatIWant;
    move_uploaded_file($tempFile,$targetFile);
    
	$con=mysqli_connect("localhost","root","thanal2106","test");
	mysqli_query($con,"INSERT INTO menu_gallery (id,menu_id,menu_name) values (".$id.",".($max_menu_id+1).",'".$id.'_menu_'.(string)($max_menu_id+1).".".$whatIWant."');");
	mysqli_close($con);

	  
      
}
?>
