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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/jquery-ui.min.js"></script>
	<script language="javascript">
		$(document).ready(function(){
			$("#menu-pages").sortable({
				update: function(event, ui) {
					$.post("ajax.php", { type: "orderPages", pages: $('#menu-pages').sortable('serialize') } );
				}
			});
		});
	</script>
	<style type="text/css">
		.menu li {
			list-style: none;
			padding: 10px;
			margin-bottom: 5px;
			border: 1px solid #000;
			background-color: #C0C0C0;
			width: 150px;
			display: inline;
			float: left;
		}
	</style>
	
		<script language="javascript">
		$(document).ready(function(){
			$("#menu-pages2").sortable({
				update: function(event, ui) {
					$.post("ajax2.php", { type: "orderPages", pages: $('#menu-pages2').sortable('serialize') } );
				}
			});
		});
	</script>

	
	
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

 <link href="css/dropzone.css" type="text/css" rel="stylesheet" /> 
<script src="dropzone.min.js"></script>

<!--validate -->
<script language='javascript'>
function validate () {
 function checkNum(x)
{
	if (x.value=="")
	{return true;}
  if (!(/^\d+$/.test(x.value)))
  {
    x.focus();
    return false;
  }
  return true;
}
	
	if(document.getElementById('category_id').value=="" || document.getElementById('title').value=="" || !checkNum(document.getElementById('phone_number')) || !checkNum(document.getElementById('rating_average'))|| !checkNum(document.getElementById('priority'))|| !checkNum(document.getElementById('category_id'))) {
    alert("You need to complete category and title.Only Numeric Values allowed in priority,rating average and phone number textboxes");
    return false;
  }
  
  return true;
}
</script>
<!--//GOOGLE MAPS -->
<script type="text/javascript"> 
    // Standard google maps function 
    function initialize() { 
        var myLatlng = new google.maps.LatLng(52.469397,-3.208008);
        var myOptions = { 
            zoom: 1, 
            center: myLatlng, 
            mapTypeId: google.maps.MapTypeId.ROADMAP 
        } 
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions); 
    } 
    // Function for adding a marker to the page. 
    function addMarker(location) { 
        marker = new google.maps.Marker({ 
            position: location, 
            map: map,
            draggable:true,
    animation: google.maps.Animation.DROP  
        }); 
         // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragend', function() {
document.getElementById('latitude').value = marker.getPosition().lat();
document.getElementById('longtitude').value = marker.getPosition().lng();
  });
    }
    
    // Testing the addMarker function 
    function TestMarker() { 
    var x=document.getElementById('latitude').value;    
    var y=document.getElementById('longtitude').value;
Marker1=new google.maps.LatLng(parseFloat(x),parseFloat(y)); addMarker(Marker1); 
    } 
    </script> 
<script
src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>
</head>
<body onload="initialize()" style="background-color:#F0F0F0;">


	<!-- HEADER -->
	<div style="background-color:#33CCFF;text-align:center;color:white;margin-left:0px;" >
        <br><h1>EDIT ENTRY</h1><br>

    </div>
	<!-- LEFT MENU -->
	<div style="float:left;background-color:#A2B0CC;height:2000px;width:20%;">
	<br>
	<a href="addentry.php"><input type="button" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;" value="ADD ENTRY"></a><br>
	<a href="edit_delete_entry.php"><input type="button" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;" value="EDIT/DELETE ENTRY"></a>	
<form name="form1" method="post" action="logout.php">
<input type="submit" name="Submit" value="Logout" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;">
</form>	
	</div>
	
<div style="background-color:#F0F0F0;overflow:hidden;" >

<!-- UPDATE POST -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$id=$_GET['id'];


$category_id=$_POST["category_id"];
$title= $_POST["title"];
if ($_POST["phone_number"]=="")
	{$phone_number=0;}
	else
	{$phone_number=$_POST["phone_number"];}
if ($_POST["rating_average"]=="")
	{	
	$rating_average=0;
	}
	else
	{$rating_average=$_POST["rating_average"];
	}
if ($_POST["priority"]=="")
	{$priority=0;}
	else
	{$priority=$_POST["priority"];}
if ($_POST["information"]=="")
	{$information=null;}
	else
	{$information=$_POST["information"];}
if ($_POST["address"]=="")
	{$address=NULL;}
	else
	{$address=$_POST["address"];}
if ($_POST["email"]=="")
	{$email=NULL;}
	else
	{$email=$_POST["email"];}
if ($_POST["website"]=="")
	{$website=NULL;}
	else
	{$website=$_POST["website"];}
if ($_POST["facebook"]=="")
	{$facebook=null;}
	else
	{$facebook=$_POST["facebook"];}
if ($_POST["longtitude"]=="")
	{$longtitude=0;}
	else
	{$longtitude=$_POST["longtitude"];}
if ($_POST["latitude"]=="")
	{$latitude=0;}
	else
	{$latitude=$_POST["latitude"];}
	
	
	if ($priority>0)
{
mysql_connect($dbhost,$dbuser,$dbpass)or die("cannot connect");
mysql_select_db($dbname)or die("cannot select DB");
$sql="SELECT priority FROM entry WHERE priority=".$priority." and hidden=0;";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
mysql_close(); 
if($count==1){
		$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if (mysqli_connect_errno())
  	{
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	mysqli_query($con,"update entry set priority=priority+1 where priority>=".$priority.";");
	mysqli_close($con); 
}

}


mysql_connect($dbhost,$dbuser,$dbpass)or die("cannot connect");
mysql_select_db($dbname)or die("cannot select DB");
$sql="update entry set category_id=".$category_id.",title='".$title."',rating_average=".$rating_average.",priority=".$priority.",information='".$information."',phone_number=".$phone_number.",address='".$address."',email='".$email."',website='".$website."',facebook='".$facebook."',latitude=".$latitude.",longtitude=".$longtitude." WHERE id=".$id.";";          
mysql_query($sql);
header("location:edit.php?id=".$id);
//header('location:add_entry.php');
}
?>

<!-- UPDATE FIELDS -->
<?php
$id=$_GET['id'];


$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (mysqli_connect_errno())
  {}
$result = mysqli_query($con,"SELECT * FROM entry WHERE id=".$id.";");
$row = mysqli_fetch_array($result);

$category_id1=$row['category_id'];
$title1=$row['title'];
$rating_average1=$row['rating_average'];
$priority1=$row['priority'];
if ($priority1==0)
{$priority1="''";} 
$information1=$row['information'];
$phone_number1=$row['phone_number'];
if ($phone_number1==0)
{$phone_number1="''";} 
$address1=$row['address'];
$email1=$row['email'];
$website1=$row['website'];
$facebook1=$row['facebook'];
$latitude1=$row['latitude'];
if ($latitude1==null)
{$latitude1="''";} 
$longtitude1=$row['longtitude']; 
if ($longtitude1==null)
{$longtitude1="''";} 
 
mysqli_close($con);
?>


		<a style="color:black;" href="edit_delete_entry.php" ><input type="button" class="btn btn-info" style="width:100px;height:32px;margin-bottom:2px;" value="BACK"></a>		  
				<form action="#" method="post" onsubmit='return validate()'>
					<table>
					<tr><td>Category:</td><td><select id="category_id" name="category_id">
<option id="1" value="1">Drink Bar</option>
<option id="2" value="2">Drink Coffee</option>
<option id="3" value="3">Drink Music Clubs</option>
<option id="4" value="4">Drink Pool Bar</option>
<option id="5" value="5">Drink Fish Restaurant</option>
<option id="6" value="6">Food Italian</option>
<option id="7" value="7">Food Restaurant</option>
<option id="8" value="8">Food Sweets and Ice-creams</option>
<option id="9" value="9">Food Traditional</option>
<option id="10" value="10">Shop Fashion</option>
<option id="11" value="11">Shop Food Market</option>
<option id="12" value="12">Shop Jewellery</option>
<option id="13" value="13">Shop Pharmacy</option>
<option id="14" value="14">Shop Services</option>
<option id="15" value="15">Shop Traditional Products and Souvenirs</option>
<option id="16" value="16">Sights Historical Sites</option>
<option id="17" value="17">Sights Museums</option>
<option id="18" value="18">Sights Villages</option>
<option id="19" value="19">Sleep Hotel</option>
<option id="20" value="20">Sleep Studio</option>
<option id="21" value="21">grid menu activities</option>
<option id="22" value="22">grid menu beach</option>
<option id="23" value="23">grid menu drive</option>
<option id="24" value="24">grid menu events</option>
</select>*</td></tr>
    				<tr><td>Title:</td><td><input name="title" id="title" placeholder="" value='<?php echo $title1;?>' type="text">*</td></tr>
    				<tr><td>Rating Average:</td><td><input name="rating_average" id="rating_average" placeholder="" value='<?php echo $rating_average1;?>' type="text"></td></tr>
    				<tr><td>Priority:</td><td><input name="priority" id="priority" placeholder="" value='<?php echo $priority1;?>' type="text"></td></tr>
    				<tr><td>Information:</td><td><textarea cols="40" rows="8" name="information"  placeholder="" id="information"><?php echo $information1;?></textarea></td></tr>
    				<tr><td>Phone Number:</td><td><input name="phone_number" id="phone_number" placeholder="" value=<?php echo $phone_number1;?> type="text"></td></tr>
    				<tr><td>Address:</td><td><input name="address" id="address" placeholder="" value='<?php echo $address1;?>' type="text"></td></tr>
    				<tr><td>E-mail:</td><td><input name="email" id="email" placeholder="" value='<?php echo $email1;?>' type="text"></td></tr>
    				<tr><td>Website:</td><td><input name="website" id="website" placeholder="" value='<?php echo $website1;?>' type="text"></td></tr>
    				<tr><td>Facebook:</td><td><input name="facebook" id="facebook" placeholder="" value='<?php echo $facebook1;?>' type="text"></td></tr>
    				<tr><td>Latitude:</td><td><input name="latitude" id="latitude" placeholder="" value='<?php echo $latitude1;?>' type="text"></td></tr>
    				<tr><td>Longtitude:</td><td><input name="longtitude" id="longtitude" placeholder="" value='<?php echo $longtitude1;?>' type="text"></td></tr>

					<tr><td colspan="2"><input value="EDIT" type="submit" class="btn btn-info" style="width:350px;height:32px;margin-bottom:2px;"></td></tr>
					</table>
				</form>
									<div id="map_canvas" style="width:350px;height:250px;"></div>
					<button  id="drop" onclick="TestMarker()" style="width:350px;border-width:3px;border-color:grey;height:32px;">Preview In Map</button>

				<br>
<?php
echo "<script>document.getElementById('".$category_id1."').setAttribute('selected', 'selected');</script> ";

?>				
						
		<h3>PHOTOS</h3>		
		
			<?php
			$id=$_GET['id'];
echo '<ul class="menu" id="menu-pages">';
$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (mysqli_connect_errno())
  {}
$result = mysqli_query($con,"SELECT * FROM photo_gallery WHERE id=".$id." ORDER BY `photo_order` ASC;");
while($row = mysqli_fetch_array($result))
  {
	$photo_name=$row['photo_name'];
	$photo_id=$row['photo_id'];
	echo '<li id="page_'.$photo_id.'">';
	echo "<img height='120' width='120' src='uploads/".$photo_name."'> <a href='del_photo.php?id=".$id."&photo_name=".$photo_name."'><input type='button' value='delete'></a>";
//	echo $photo_name;
echo "</li>"; 
 }
mysqli_close($con);
echo "</ul>";


echo "\n\n<div style='background-color:#F0F0F0;height:300px;width:90%;float:left;overflow:hidden;'>";
echo "<form action='editupload1.php?id=".$id."' class='dropzone'>";
echo "ADD PHOTOS";
echo "</form>"; 			
echo "</div><br><br>";
echo "<div style='clear:both;display:block;'></div>";

echo "\n\n<h3>MENU PHOTOS</h3>";
echo '<ul class="menu" id="menu-pages2">';
$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if (mysqli_connect_errno())
  {}
$result = mysqli_query($con,"SELECT * FROM menu_gallery WHERE id=".$id." ORDER BY `menu_order` ASC;");
while($row = mysqli_fetch_array($result))
  {
	$menu_name=$row['menu_name'];
	$menu_id=$row['menu_id'];
	echo "<li id='page_".$menu_id."'> <img height='120' width='120' src='uploads/".$menu_name."'><a href='del_menu_photo.php?id=".$id."&menu_name=".$menu_name."'><input type='button' value='delete'></a></li>";
 }
mysqli_close($con);

echo '</ul>';

echo "\n\n<div style='background-color:#F0F0F0;height:300px;width:89.8%;clear:both;'>";
echo "<form action='editupload2.php?id=".$id."' class='dropzone'>";
echo "ADD MENU PHOTOS";
echo "</form></div>"; 	
			
?>
			
			


</div>


</body>
</html>



