<?php include 'configuration.php'; ?>
<!DOCTYPE html>

<html lang="en">
<head>
 <meta http-equiv="content-type" content="text/html; charset=ISO-8859-7" /> 
 <link href="css/dropzone.css" type="text/css" rel="stylesheet" /> 
<script src="dropzone.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
<?php
session_start();
if(!session_is_registered(myusername)){
header("location:index.php");
}
?>
</head>
<body onload="initialize()" style="background-color:#F0F0F0;">

<!--HEADER -->
	<div style="background-color:#33CCFF;text-align:center;color:white;margin-left:-8px;margin-right:-8px;margin-top:-8px;" >
        <br><h1>ADD ENTRY</h1><br>

    </div>


<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
<!-- NOT EMPTY -->
<script language='javascript'>
function validate () {
 function checkNum(x)
{
	if (x.value=="")
	{return true;}
  if (!(/^\d+$/.test(x.value)) )
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
        var myLatlng = new google.maps.LatLng(35.5188143,27.2021484);
        var myOptions = { 
            zoom: 10, 
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
	<!-- LEFT MENU -->
	<div style="float:left;display:inline;background-color:#A2B0CC;height:1000px;width:20%;margin-left:-8px;">
	<br>
	<a href=""><input type="button" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;" value="ADD ENTRY"></a><br>
	<a href="edit_delete_entry.php"><input type="button" class="btn btn-primary" style="width:100%;height:32px;margin-bottom:2px;" value="EDIT/DELETE ENTRY"></a>	
<form name="form1" method="post" action="logout.php">
<input type="submit" name="Submit" value="Logout" class="btn btn-primary" style="width:100%;height:32px;">
</form>	
	</div>
	
	<div style="background-color:#F0F0F0;height:1000px;overflow:hidden;" >
	<a href="addentry.php"><input type="button" class="btn btn-info" style="width:100px;height:32px;margin-bottom:2px;"style="width:100px;border-width:3px;border-color:grey;height:32px;" value="CLEAR"></a>
		
				<form action="#" method="post" onsubmit='return validate()'>
					<table>
					<tr><td>Category:</td><td><select id="category_id" name="category_id">
<option value="1">Drink Bar</option>
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
</select>*</td></tr>
    				<tr><td>Title:</td><td><input name="title" id="title" placeholder="" value="" type="text">*</td></tr>
    				<tr><td>Rating Average:</td><td><input name="rating_average" id="rating_average" placeholder="" value="" type="text"></td></tr>
    				<tr><td>Priority:</td><td><input name="priority" id="priority" placeholder="" value="" type="text"></td></tr>
    				<tr><td>Information:</td><td><textarea cols="40" rows="8" name="information" id="information"></textarea></td></tr>
    				<tr><td>Phone Number:</td><td><input name="phone_number" id="phone_number" placeholder="" value="" type="text"></td></tr>
    				<tr><td>Address:</td><td><input name="address" id="address" placeholder="" value="" type="text"></td></tr>
    				<tr><td>E-mail:</td><td><input name="email" id="email" placeholder="" value="" type="text"></td></tr>
    				<tr><td>Website:</td><td><input name="website" id="website" placeholder="" value="" type="text"></td></tr>
    				<tr><td>Facebook:</td><td><input name="facebook" id="facebook" placeholder="" value="" type="text"></td></tr>
    				<tr><td>Latitude:</td><td><input name="latitude" id="latitude" placeholder="" value="" type="text"></td></tr>
    				<tr><td>Longtitude:</td><td><input name="longtitude" id="longtitude" placeholder="" value="" type="text"></td></tr>

						<tr><td colspan="2"><input value="ADD" name="1" type="submit" style="width:350px;border-width:3px;border-color:grey;height:32px;"></td></tr>
					</table>
    				<br>
				</form>	

					<div id="map_canvas" style="width:350px;height:250px;"></div>
					<button  id="drop" onclick="TestMarker()" style="width:350px;border-width:3px;border-color:grey;height:32px;">Preview In Map</button>

			<br>	
	</div>
	

<div style='background-color:#F0F0F0;height:1px;width:99%;display:block;overflow:hidden;'></div>

 
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$addstring="";
	$category_id=$_POST["category_id"];
	$addstring=$addstring+"category_id";
	$title= $_POST["title"];
	if ($_POST["phone_number"]=="")
	{$phone_number=0;}
	else
	{$phone_number=$_POST["phone_number"];}
	if ($_POST["rating_average"]=="")
	{$rating_average=0;
	$rating_count=0;	
	}
	else
	{$rating_average=$_POST["rating_average"];
	$rating_count=1;	
	}
	if ($_POST["priority"]=="")
	{$priority=0;}
	else
	{$priority=(int)$_POST["priority"];}
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
	{$longtitude=NULL;}
	else
	{$longtitude=$_POST["longtitude"];}
	if ($_POST["latitude"]=="")
	{$latitude=NULL;}
	else
	{$latitude=$_POST["latitude"];}
		

if ($priority>0)
{
mysql_connect($dbhost, $dbuser, $dbpass)or die("cannot connect");
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
mysql_close(); 
}
	
	$con=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if (mysqli_connect_errno())
  	{
  	echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	#mysqli_query($con,"INSERT INTO person (firstname, lastname) VALUES ('Peter2', 'Griffin2')");
	mysqli_query($con,"INSERT INTO entry (category_id,title,rating_average,rating_count,priority,information,phone_number,address,email,website,facebook,latitude,longtitude) VALUES (".(int)$category_id.",'".$title."',".(float)$rating_average.",".$rating_count.",".$priority.",'".$information."',".(int)$phone_number.",'".$address."','".$email."','".$website."','".$facebook."',".(float)$latitude.",".(float)$longtitude.");");
	mysqli_close($con);


echo "<div style='background-color:#F0F0F0;height:400px;width:50%;float:left;overflow:hidden;'>";
echo "<form action='upload1.php' class='dropzone'>";
echo "ADD PHOTOS";
echo "</form>"; 			
echo "</div>";

echo "<div style='background-color:#F0F0F0;height:400px;width:49.8%;overflow:hidden;'>";
echo "<form action='upload2.php' class='dropzone'>";
echo "ADD MENU PHOTOS";
echo "</form>"; 			
echo "</div>";


}
       
?> 
</body>
</html>


