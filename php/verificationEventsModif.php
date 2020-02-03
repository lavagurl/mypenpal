<?php
session_start();
include('connexionBDD.php');
$id = $_GET['modifier'];
if(isset($_POST['Modifier'])){

$title=htmlspecialchars($_POST['title']);
$position=htmlspecialchars($_POST['position']);
$description=htmlspecialchars($_POST['description']);
$start_event=htmlspecialchars($_POST['start_event']);
$end_event=htmlspecialchars($_POST['end_event']);


$req=$bdd->prepare("UPDATE events SET position = ? where id='${id}' ");
$req -> execute(array($position));


$req=$bdd->prepare("UPDATE events SET title = ? where id='${id}' ");
$req -> execute(array($title));

$req=$bdd->prepare("UPDATE events SET description = ? where id='${id}' ");
$req -> execute(array($description));

$req=$bdd->prepare("UPDATE events SET start_event = ? where id='${id}' ");
$req -> execute(array($start_event));

$req=$bdd->prepare("UPDATE events SET end_event = ? where id='${id}' ");
$req -> execute(array($end_event));






?>
<script type="text/javascript">
alert("Mise a jour de l'évènement !");
document.location.href = 'gestionEvenementBO.php';
</script>
<?php
}
?>
