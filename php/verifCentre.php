<?php
session_start();
include('connexion.php');
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
    $result = $bdd->query("SELECT id FROM member WHERE id=(SELECT MAX(id) FROM member)");
    $id_member = $result -> fetch();
    $id= $id_member["id"];
    $centre = '1';

    $req = $bdd -> query("SELECT name FROM member WHERE id=(SELECT MAX(id) FROM member)");
    $req1 = $req -> fetch();
    $pseudo = $req1['name'];


  }

  if($musique == TRUE )
  {
  $result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '1'");
  $id_h = $result1 -> fetch();
  $id_hobbies = $id_h["id_hobbies"];
  $insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
  $insertmbr ->execute(array
  ( "id" =>$id,
  "id_hobbies" => $id_hobbies)
);
?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}

if($voyage == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '2'");
$id_h = $result1 -> fetch();
$id_hobbies = $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);
?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($nourriture == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '3'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);

?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($sport == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '4'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);

?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($histoire == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '5'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);

?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($langues == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '6'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);
?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($lectures == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '7'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);

?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($culture == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '8'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);

?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}


if($technologie == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '9'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);
?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($cine == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '10'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);
?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($jeux == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '11'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);

?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($art == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies ='12'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);

?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}

if($nature == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies ='13'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);

?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($bricolage == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies = '14'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);

?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}
if($beaute == TRUE )
{
$result1 = $bdd->query("SELECT id_hobbies FROM hobbies WHERE id_hobbies ='15'");
$id_h = $result1 -> fetch();
$id_hobbies= $id_h["id_hobbies"];
$insertmbr =$bdd->prepare("INSERT INTO posseder(member,hobbies) VALUES (:id,:id_hobbies)");
$insertmbr ->execute(array
( "id" =>$id,
"id_hobbies" => $id_hobbies)
);

?>
<script type="text/javascript">
document.location.href = 'pageProfil.php?name=<?php echo($pseudo); ?>';
</script>
<?php
}

}



?>
