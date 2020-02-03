<?php
session_start();
include('connexionBDD.php');

$champs=array('title','description','position','start_event','end_event');
$title=htmlspecialchars($_POST['title']);
$position=htmlspecialchars($_POST['position']);
$description=htmlspecialchars($_POST['description']);
$start_event=htmlspecialchars($_POST['start_event']);
$end_event=htmlspecialchars($_POST['end_event']);


foreach ($champs as $value) {
  if(!isset($_POST[$value]) || empty($_POST[$value]))
  {
    header("Location:gestionEvenementBO.php?error=".$value);
    exit;
  }
}

$req=$bdd->prepare('INSERT INTO events(title,position,description,start_event,end_event) VALUES(:title,:position,:description,:start_event,:end_event)');

$req ->execute(array
('title'=>$title,
'position'=>$position,
'description'=>$description,
'start_event'=>$start_event,
'end_event'=>$end_event,
));



header("Location:evenements.php");
exit;

?>
