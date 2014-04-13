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
	<div  style="background-color:#33CCFF;text-align:center;color:white;margin-left:-8px;margin-right:-8px;margin-top:-8px;" >
        <br><h1>EDIT/DELETE ENTRY</h1><br>

    </div>

	<!-- LEFT MENU -->
	<div style="float:left;background-color:#A2B0CC;height:800px;width:20%;margin-left:-8px;">
	<br>
	<a href="addentry.php"><input type="button" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;" value="ADD ENTRY"></a><br>
	<a href=""><input type="button" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;" value="EDIT/DELETE ENTRY"></a>	
<form name="form1" method="post" action="logout.php">
<input type="submit" name="Submit" value="Logout" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;">
</form>	
	</div>
	


	<div style="background-color:#F0F0F0;height:800px;overflow:hidden;" >
<script type="text/javascript" >
$(document).ready(function () {  
    $('#category_id').change(function () {
       window.location.href = "edit_delete_entry.php?category_id="+ $(this).val();
    });    

});
</script>
<a style="color:black;" href="latest_update.php?ms=0" ><input type="button" class="btn btn-info" style="width:200px;height:32px;margin-bottom:2px;" value="EXPORT AS JSON"></a>		  
<h4>Choose entry:</h4>
<select style="float:right;" id="category_id" name="category_id">
<option value="0">CATEGORY</option>
<option value="1"><a href="edit_delete_entry.php?category_id=1">Drink Bar</a></option>
<option value="2">Drink Coffee</option>
<option value="3">Drink Music Clubs</option>
<option value="4">Drink Pool Bar</option>
<option value="5">Drink Fish Restaurant</option>
<option value="6">Food Italian</option>
<option value="7">Food Restaurant</option>
<option value="8">Food Sweets and Ice-creams</option>
<option value="9">Food Traditional</option>
<option value="10">Shop Fashion</option>
<option value="11">Shop Food Market</option>
<option value="12">Shop Jewellery</option>
<option value="13">Shop Pharmacy</option>
<option value="14">Shop Services</option>
<option value="15">Shop Traditional Products and Souvenirs</option>
<option value="16">Sights Historical Sites</option>
<option value="17">Sights Museums</option>
<option value="18">Sights Villages</option>
<option value="19">Sleep Hotel</option>
<option value="20">Sleep Studio</option>
<option value="21">grid menu activities</option>
<option value="22">grid menu beach</option>
<option value="23">grid menu drive</option>
<option value="24">grid menu events</option>
</select>
<a style="clear:both;color:black;float:right" href="edit_delete_entry.php" ><input type="button" class="btn btn-info" style="width:200px;height:32px;margin-bottom:2px;" value="CLEAR CATEGORY"></a>
<br><br>

<?php

$cate=$_GET['category_id'];
$getid="";
if ($cate!="")
{$cate="where category_id=".(string)$cate;
$getid="&category_id=".(string)$_GET['category_id'];
}

$rec_limit = 10;

$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
mysql_select_db($dbname);
/* Get total number of records */
$sql = "SELECT count(id) FROM entry ".$cate.";";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
	echo $sql;
  die('Could not get data: ' . mysql_error());
}
$row = mysql_fetch_array($retval, MYSQL_NUM );
$rec_count = $row[0];

if( isset($_GET{'page'} ) )
{
   $page = $_GET{'page'} + 1;
   $offset = $rec_limit * $page ;
}
else
{
   $page = 0;
   $offset = 0;
}
$left_rec = $rec_count - ($page * $rec_limit);

$sql = "SELECT id, title, category_id, information, hidden "."FROM entry ".$cate." LIMIT ".$offset .",". $rec_limit.";";

$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

echo "<table class='table'>";
echo "<tr><td>TITLE</td><td>CATEGORY_ID</td><td>INFORMATION</td><td>EDIT ENTRY</td><td>HIDE ENTRY</td><td>SHOW ENTRY</td><tr>";
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
	$hidden=$row['hidden'];
	if ($hidden==0)
	{
    echo "<tr><td>{$row['title']}</td>"."<td> {$row['category_id']} </td> "."<td> {$row['information']} </td> "."<td><a href='edit.php?id={$row['id']}'>EDIT</a>  </td>"."<td><a href='del.php?id={$row['id']}'>HIDE</a>  </td><td></td></tr>";   
		}
	elseif($hidden==1)  {
    echo "<tr><td>{$row['title']}</td>"."<td> {$row['category_id']} </td> "."<td> {$row['information']} </td> "."<td><a href='edit.php?id={$row['id']}'>EDIT</a>  </td>"."<td></td><td><a href='show.php?id={$row['id']}'>SHOW</a></td></tr>";   
}
} 
echo "</table>";
if( $page > 0 )
{
   $last = $page - 2;
   echo "<a href=\"$_PHP_SELF?page=$last$getid\">Last 10 Records</a> |";
   echo "<a href=\"$_PHP_SELF?page=$page$getid\">Next 10 Records</a>";
}
else if( $page == 0 )
{
   echo "<a href=\"$_PHP_SELF?page=$page$getid\">Next 10 Records</a>";
}
else if( $left_rec < $rec_limit )
{
   $last = $page - 2;
   echo "<a href=\"$_PHP_SELF?page=$last$getid\">Last 10 Records</a>";
}
mysql_close($conn);
?>

				   
	</div>

        
    
</body>
</html>



