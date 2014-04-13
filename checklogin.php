<?php include 'configuration.php'; ?>
<?php

mysql_connect($dbhost, $dbuser, $dbpass)or die("cannot connect");
mysql_select_db($dbname)or die("cannot select DB");
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];


$sql="SELECT * FROM users WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);

if($count==1){
session_register("myusername");
session_register("mypassword");
header("location:edit_delete_entry.php");
}
else {
echo "Wrong Username or Password";
}
?>