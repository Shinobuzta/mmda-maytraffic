<?php
	$db = new PDO("mysql:host=localhost:3306;dbname=daandb","root","JYU87OHv7z");
	$s = $db->prepare("SELECT code,name FROM tbl_location");
	$e = $s->execute();
	$f = $s->fetchAll();

	foreach($f as $key=>$value){
		echo $value['code'];
	}
?>
function getNorthBound(code){

}