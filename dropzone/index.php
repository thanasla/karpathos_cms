<html>
 <?php
session_start();
if(!session_is_registered(myusername)){
header("location:../main_login.php");
}
?>
<head>   
<link href="css/dropzone.css" type="text/css" rel="stylesheet" /> 
<script src="dropzone.min.js"></script>
</head>
 
<body>
<!-- HEADER -->
	<div style="background-color:#33CCFF;text-align:center;color:white;margin-left:0px;" >
        <br><h1>ADD PHOTOS</h1><br>

    </div>    
 	<!-- LEFT MENU -->
	<div style="float:left;background-color:#C0C0C0;height:800px;width:20%;">
	<br>
	<a href="../addentry.php"><input type="button" style="width:100%;border-width:2px;border-color:grey;height:32px;" value="ADD ENTRY"></a><br>
	<a href="../edit_delete_entry.php"><input type="button" style="width:100%;border-width:3px;border-color:grey;height:32px;" value="EDIT/DELETE ENTRY"></a>
	<a href=""><input type="button" style="width:100%;border-width:3px;border-color:grey;height:32px;" value="ADD PHOTOS"></a>
	<a href="../dropzone2/index.php"><input type="button" style="width:100%;border-width:3px;border-color:grey;height:32px;" value="ADD MENU PHOTOS"></a>
<form name="form1" method="post" action="../logout.php">
<input type="submit" name="Submit" value="Logout" style="width:100%;border-width:3px;border-color:grey;height:32px;">
</form>			
		</div>    
<div style="background-color:#F0F0F0;height:800px;overflow:hidden;" >
	
<form action="upload.php" class="dropzone">

Select ID:
<select name="id">
<?php
$con=mysqli_connect("localhost","root","thanal2106","test");
if (mysqli_connect_errno())
  {}
$result = mysqli_query($con,"SELECT id FROM entry");
while($row = mysqli_fetch_array($result))
  {
  $id=$row['id'];
  if ($id==1)
  		{echo "<option value=".$id." selected>".$id."</option>";}
  else
  		{echo "<option value=".$id.">".$id."</option>";}
  }
?>
</select> 
</form> 

</div>

</body> 
</html>