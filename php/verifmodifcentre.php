<?php
session_start();
include('connexionBDD.php');{

  if(isset($_POST['valider'])){




    $musique = isset($_POST['musique']) ? $_POST['musique'] : NULL;
    $voyage = isset($_POST['voyage']) ? $_POST['voyage'] : NULL;
    $nourriture = isset($_POST['nourriture']) ? $_POST['nourriture'] : NULL;
    $sport = isset($_POST['sport']) ? $_POST['sport'] : NULL;
    $histoire = isset($_POST['histoire']) ? $_POST['histoire'] : NULL;
    $langues = isset($_POST['langues']) ? $_POST['langues'] : NULL;
    $lectures = isset($_POST['lectures']) ? $_POST['lectures'] : NULL;
    $culture = isset($_POST['culture']) ? $_POST['culture'] : NULL;
    $technologie = isset($_POST['technologie']) ? $_POST['technologie'] : NULL;
    $cine = isset($_POST['cine']) ? $_POST['cine'] : NULL;
    $jeux = isset($_POST['jeux']) ? $_POST['jeux'] : NULL;
    $art = isset($_POST['art']) ? $_POST['art'] : NULL;
    $nature = isset($_POST['nature']) ? $_POST['nature'] : NULL;
    $bricolage = isset($_POST['bricolage']) ? $_POST['bricolage'] : NULL;
    $beaute = isset($_POST['beaute']) ? $_POST['beaute'] : NULL;
    $result = $bdd->query("SELECT id FROM member WHERE name='{$_SESSION['pseudo']}'");
    $id_member = $result -> fetch();
    $id= $id_member["id"];

    $reponse1 = $bdd->query ("SELECT name FROM hobbies WHERE id_hobbies IN (SELECT hobbies FROM posseder WHERE member IN (SELECT id FROM member WHERE name ='{$_SESSION['pseudo']}'))");
    $donnees1 = $reponse1-> fetch();



    if($musique == TRUE)
    {
      if ( $donnees1['name']!= 'Musique') {
        $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '1'");
        $id_h = $result1 -> fetch();
        $id_hobbies = $id_h["id_hobbies"];
        $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
        $insertmbr ->execute(array
        ( "id" =>$id,
        "id_hobbies" => $id_hobbies)
      );
    }
    $donnees1 = $reponse1-> fetch();
    header("Location: parametresProfil.php");
  } else {
    $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '1' ");

  }

  if($voyage == TRUE)
  {
    if( $donnees1['name']!= 'Voyage'){
      $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '2'");
      $id_h = $result1 -> fetch();
      $id_hobbies = $id_h["id_hobbies"];
      $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
      $insertmbr ->execute(array
      ( "id" =>$id,
      "id_hobbies" => $id_hobbies)
    );
  }
$donnees1 = $reponse1-> fetch();
  header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '2' ");

}


if($nourriture == TRUE)
{
  if( $donnees1['name']!= 'Nourriture'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '3'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '3' ");
}


if($sport == TRUE)
{
  if( $donnees1['name']!= 'Sport'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '4'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '4' ");
}


if($histoire == TRUE)
{
  if( $donnees1['name']!= 'Histoire'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '5'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '5' ");
}


if($langues == TRUE)
{
if( $donnees1['name']!= 'Langues'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '6'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '6' ");
}


if($lectures == TRUE)
{
  if( $donnees1['name']!= 'Lecture'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '7'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '7' ");
}


if($culture == TRUE)
{
  if( $donnees1['name']!= 'CultureAsiatique'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '8'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '8' ");
}


if($technologie == TRUE)
{
  if( $donnees1['name']!= 'Technologie'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '9'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '9' ");
}


if($cine == TRUE)
{
  if( $donnees1['name']!= 'Cinématographie'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '10'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '10' ");
}


if($jeux == TRUE)
{
  if( $donnees1['name']!= 'JeuxVidéo'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '11'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '11' ");

}


if($art == TRUE)
{
  if( $donnees1['name']!= 'Art'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies ='12'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '12' ");
}


if($nature == TRUE)
{
  if( $donnees1['name']!= 'Nature'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies ='13'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '13' ");
}


if($bricolage == TRUE)
{
  if( $donnees1['name']!= 'Bricolage'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '14'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '14' ");
}


if($beaute == TRUE)
{
  if( $donnees1['name']!= 'Beauté'){
    $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies ='15'");
    $id_h = $result1 -> fetch();
    $id_hobbies= $id_h["id_hobbies"];
    $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
    $insertmbr ->execute(array
    ( "id" =>$id,
    "id_hobbies" => $id_hobbies)
  );
}
$donnees1 = $reponse1-> fetch();
header("Location: parametresProfil.php");
}else {
  $result1 = $bdd -> query(" DELETE FROM posseder WHERE member ='{$_SESSION['id']}' AND hobbies = '15' ");
}


}
}



?>
