<?php
/*
$test = array('http://myworldfacts.com/wp-content/uploads/2015/02/Horse-22.jpg','http://myworldfacts.com/wp-content/uploads/2015/02/Horse-22.jpg','http://myworldfacts.com/wp-content/uploads/2015/02/Horse-22.jpg');
foreach($test as $item){
	echo '<img src="' . $item . '" />';
}
*/

$zip = system("zip -r files/zipfile test.php"); 
echo $zip;

?>