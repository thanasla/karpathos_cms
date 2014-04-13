<?php include 'configuration.php'; ?>
<?php

$con=mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if (mysqli_connect_errno())
  {}
  $result2 = mysqli_query($con,"SELECT max(id) as id FROM entry;");
while($row2 = mysqli_fetch_array($result2))
  {
  $id=$row2['id']; 
  }
  mysqli_close($con);
 
$con=mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
if (mysqli_connect_errno())
  {}
$result = mysqli_query($con,"SELECT max(menu_id) as menu_id FROM menu_gallery;");
while($row = mysqli_fetch_array($result))
  {
  $max_menu_id=$row['menu_id']; 
  }
mysqli_close($con);


if (!empty($_FILES)) {
	
	$string=$_FILES['file']['name'];	
	$whatIWant = substr($string, strpos($string, ".") + 1);
     
    $tempFile = $_FILES['file']['tmp_name'];           
   $targetFile =  'uploads/'.'menu_'.(string)($max_menu_id+1).".".$whatIWant;
    move_uploaded_file($tempFile,$targetFile);
        
	$con=mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
	mysqli_query($con,"INSERT INTO menu_gallery (id,menu_id,menu_name,menu_order) values (".$id.",".($max_menu_id+1).",'".'menu_'.(string)($max_menu_id+1).".".$whatIWant."',".($max_menu_id+1).");");
	mysqli_close($con);

	  
      
}
?>
