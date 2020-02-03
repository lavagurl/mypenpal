<?php
session_start();
include('connexionBDD.php');
$champs=array('name','position','type','room','price_ini','description');
$name=htmlspecialchars($_POST['name']);
$position=htmlspecialchars($_POST['position']);
$type=htmlspecialchars($_POST['type']);
$room=htmlspecialchars($_POST['room']);
$price_ini=$_POST['price_ini'];
$description=htmlspecialchars($_POST['description']);
$position = ucfirst(strtolower($position));

if ($price_ini>=0 && $price_ini<=50) {
	$price="0-50€";
}
if ($price_ini>50 && $price_ini<=100) {
	$price="50-100€";
}if ($price_ini>100 && $price_ini<=150) {
	$price="100-150€";
}if ($price_ini>150 && $price_ini<=200) {
	$price="150-200€";
}
if ($price_ini>200) {
	$price="200€ et plus";
}



foreach ($champs as $value) {
	if(!isset($_POST[$value]) || empty($_POST[$value]))
	{
		header("Location: formulaireLocations.php?error=".$value);
		exit;
	}
}

$req=$bdd->prepare('INSERT INTO lease(name,position,type,room,price,price_ini,date_post,description,member) VALUES(:name,:position,:type,:room,:price,:price_ini,NOW(),:description,'.$_SESSION["id"].')');

$req ->execute(array
('name'=>$name,
'position'=>$position,
'type'=>$type,
'room'=>$room,
'price'=>$price,
'price_ini'=>$price_ini,
'description'=>$description,


));



header("Location: locations.php");
exit;

?>
