<?php session_start();
ob_start();
$date = date("d-m-Y");
$heure = date("H:i");
include('connexionBDD.php');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon.ico" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles2.css">
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon.ico" />
  <title>Gestion membres</title>
</head>
<body>
  <?php include('header.php'); ?>
  <div id="main">
    <?php include("navBarBO.php") ?>
    <section>
      <div class="container" style="text-align: justify;margin-top:2%;">
        <section  class="block1" style="text-align:center;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:2%;margin-bottom:2%;">
          <h3 style="text-align:center;border:5px solid #b1d1d0;padding:2px;background:white;border-radius:5px;"> Membres présents </h3>
          <?php
          $admin= 1;
          $supprime = 1;
          $i = 0;
          $reponse = $bdd->query("SELECT * FROM member WHERE name='{$_SESSION['pseudo']}'");
          $donnees = $reponse -> fetch();
          $member = $bdd -> query("SELECT * FROM member WHERE admin = 0 and suppr = 0");
          $creadate1=$bdd->query('SELECT DAY(creation_date) as day_member, MONTH(creation_date) as month_member, YEAR(creation_date) as year_member, HOUR(creation_date) as hour_member, MINUTE(creation_date) as minute_member FROM member WHERE admin = 0 and suppr = 0');
          $dateannive=$bdd->query('SELECT DAY(birth_date) as day_member_birth, MONTH(birth_date) as month_member_birth, YEAR(birth_date) as year_member_birth, HOUR(birth_date) as hour_member_birth, MINUTE(birth_date) as minute_member_birth FROM member WHERE admin = 0 and suppr = 0');

          ?>
          <table style="width:100% ;margin:auto;border:5px solid #b1d1d0;border-radius:5px;">
            <tr style="text-align:center;border:  2px solid #b1d1d0 ; width: 50%;">
              <th style="border:  2px solid #b1d1d0 ;"> Pseudo</th>
              <th style="border:  2px solid #b1d1d0 ;"> Email </th>
              <th style="border:  2px solid #b1d1d0 ;"> Date Anniversaire </th>
              <th style="border:  2px solid #b1d1d0 ;"> Position </th>
              <th style="border:  2px solid #b1d1d0 ;"> Description </th>
              <th style="border:  2px solid #b1d1d0 ;"> Genre </th>
              <th style="border:  2px solid #b1d1d0 ;"> Date de Création </th>
              <th style="border:  2px solid #b1d1d0 ;"> Supression </th>
              <th style="border:  2px solid #b1d1d0 ;"> Add Admin </th>
            </tr>
          </section>
          <?php while( ($member1 = $member-> fetch())&&($crea=$creadate1->fetch())&&($creadate=$dateannive->fetch())){?>
            <tr>
              <td style="border:  2px solid #b1d1d0 ;width:10%;"><?php if($member1['premium']==1){ echo $member1['name'];?> <img class='symboles' src="../images/premium1.png"/><?php } else {echo $member1['name'];} ?></td>
              <td style="border:  2px solid #b1d1d0 ;">  <?php echo $member1['email']; ?>  </td>
              <?php
              if($creadate['minute_member_birth']<10){
                $minute_member_birth =  '0'.$creadate['minute_member_birth'];
              } else{
                $minute_member_birth = $creadate['minute_member_birth'];
              }
              if($creadate['month_member_birth']<10){
                $month_member_birth = '0'.$creadate['month_member_birth'];
              } else {
                $month_member_birth = $creadate['month_member_birth'];
              }
              if($creadate['day_member_birth']<10){
                $day_member_birth =  '0'.$creadate['day_member_birth'];
              } else {
                $day_member_birth = $creadate['day_member_birth'];
              }
              if($creadate['hour_member_birth']<10){
                $hour_member_birth =  '0'.$creadate['hour_member_birth'];
              } else {
                $hour_member_birth = $creadate['hour_member_birth'];
              }?>
              <td style="border:  2px solid #b1d1d0 ;">  <?php echo $day_member_birth.'/'.$month_member_birth.'/'.$creadate['year_member_birth']; ?></td>
              <td style="border:  2px solid #b1d1d0 ;">  <?php echo $member1['position']; ?> </td>
              <td style="border:  2px solid #b1d1d0 ;">  <?php echo $member1['description']; ?> </td>
              <td style="border:  2px solid #b1d1d0 ;">  <?php  if($member1['gender']==0){
                echo "Femme";
              }
              else
              {
                echo "Homme";
              }  ; ?> </td>
              <?php
              if($crea['minute_member']<10){
                $minute_member =  '0'.$crea['minute_member'];
              } else{
                $minute_member = $crea['minute_member'];
              }
              if($crea['month_member']<10){
                $month_member = '0'.$crea['month_member'];
              } else {
                $month_member = $crea['month_member'];
              }
              if($crea['day_member']<10){
                $day_member =  '0'.$crea['day_member'];
              } else {
                $day_member = $crea['day_member'];
              }
              if($crea['hour_member']<10){
                $hour_member =  '0'.$crea['hour_member'];
              } else {
                $hour_member = $crea['hour_member'];
              }?>
              <td style="border:  2px solid #b1d1d0 ;"> <?php echo $day_member.'/'.$month_member.'/'.$crea['year_member']; ?> </td>
              <td style="border:  2px solid #b1d1d0 ;">  <a href="gestionBO.php?supprime=<?= $member1['id'];?>">Suppression</a></td>
              <?php
              if (isset($_GET['supprime']) AND !empty($_GET['supprime'])) {
                $id = htmlspecialchars((int) $_GET['supprime']);
                $delete = $bdd->prepare('UPDATE member SET suppr = ?  WHERE id = ?');
                $delete->execute(array($supprime,$id));
                header("Location:gestionBO.php");
              } ?>
              <td style="border:  2px solid #b1d1d0 ;"> <a href="gestionBO.php?admin=<?= $member1['id'];?>"> Add Admin </a> </td>
              <?php if(isset($_GET['admin'])AND !empty($_GET['admin'])){
                $id= htmlspecialchars((int) $_GET['admin']);
                $add= $bdd-> prepare('UPDATE member SET admin = ? WHERE id = ?  ');
                $add -> execute(array($admin,$id));
                header("Location:gestionAdminBO.php");
              } ?>
              <?php
            } ?>
          </tr>
        </table>
      </section>
      <section  class="block1" style="text-align:center;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;margin-top:2%;margin-bottom:2%;">
        <h3 style="text-align:center;border:5px solid #b1d1d0;padding:2px;background:white;border-radius:5px;"> Membres Supprimés </h3>
        <?php
        $admin= 1;
        $ajoute = 0;
        $i = 0;
        $reponse = $bdd->query("SELECT * FROM member WHERE name='{$_SESSION['pseudo']}'");
        $donnees = $reponse -> fetch();
        $member = $bdd -> query("SELECT * FROM member WHERE admin = 0 and suppr = 1");
        $creadate1=$bdd->query('SELECT DAY(creation_date) as day_member, MONTH(creation_date) as month_member, YEAR(creation_date) as year_member, HOUR(creation_date) as hour_member, MINUTE(creation_date) as minute_member FROM member WHERE admin = 0 and suppr = 1');
        $dateannive=$bdd->query('SELECT DAY(birth_date) as day_member_birth, MONTH(birth_date) as month_member_birth, YEAR(birth_date) as year_member_birth, HOUR(birth_date) as hour_member_birth, MINUTE(birth_date) as minute_member_birth FROM member WHERE admin = 0 and suppr = 1');

        ?>
        <table style="width:100% ;margin:auto;border:5px solid #b1d1d0;border-radius:5px;">
          <tr style="text-align:center;border:  2px solid #b1d1d0 ; width: 50%;">
            <th style="border:  2px solid #b1d1d0 ;"> Pseudo</th>
            <th style="border:  2px solid #b1d1d0 ;"> Email </th>
            <th style="border:  2px solid #b1d1d0 ;"> Date Anniversaire </th>
            <th style="border:  2px solid #b1d1d0 ;"> Position </th>
            <th style="border:  2px solid #b1d1d0 ;"> Description </th>
            <th style="border:  2px solid #b1d1d0 ;"> Genre </th>
            <th style="border:  2px solid #b1d1d0 ;"> Date de Création </th>
            <th style="border:  2px solid #b1d1d0 ;"> Ajouter </th>
            <th style="border:  2px solid #b1d1d0 ;"> Add Admin </th>
          </tr>
        </section>
        <?php while( ($member1 = $member-> fetch())&&($crea=$creadate1->fetch())&&($creadate=$dateannive->fetch())){?>
          <tr>
            <td style="border:  2px solid #b1d1d0 ;width:10%;"><?php if($member1['premium']==1){ echo $member1['name'];?> <img class='symboles' src="../images/premium1.png"/><?php } else {echo $member1['name'];} ?></td>
            <td style="border:  2px solid #b1d1d0 ;">  <?php echo $member1['email']; ?>  </td>
            <?php
            if($creadate['minute_member_birth']<10){
              $minute_member_birth =  '0'.$creadate['minute_member_birth'];
            } else{
              $minute_member_birth = $creadate['minute_member_birth'];
            }
            if($creadate['month_member_birth']<10){
              $month_member_birth = '0'.$creadate['month_member_birth'];
            } else {
              $month_member_birth = $creadate['month_member_birth'];
            }
            if($creadate['day_member_birth']<10){
              $day_member_birth =  '0'.$creadate['day_member_birth'];
            } else {
              $day_member_birth = $creadate['day_member_birth'];
            }
            if($creadate['hour_member_birth']<10){
              $hour_member_birth =  '0'.$creadate['hour_member_birth'];
            } else {
              $hour_member_birth = $creadate['hour_member_birth'];
            }?>
            <td style="border:  2px solid #b1d1d0 ;">  <?php echo $day_member_birth.'/'.$month_member_birth.'/'.$creadate['year_member_birth']; ?></td>
            <td style="border:  2px solid #b1d1d0 ;">  <?php echo $member1['position']; ?> </td>
            <td style="border:  2px solid #b1d1d0 ;">  <?php echo $member1['description']; ?> </td>
            <td style="border:  2px solid #b1d1d0 ;">  <?php  if($member1['gender']==0){
              echo "Femme";
            }
            else
            {
              echo "Homme";
            }  ; ?> </td>
            <?php
            if($crea['minute_member']<10){
              $minute_member =  '0'.$crea['minute_member'];
            } else{
              $minute_member = $crea['minute_member'];
            }
            if($crea['month_member']<10){
              $month_member = '0'.$crea['month_member'];
            } else {
              $month_member = $crea['month_member'];
            }
            if($crea['day_member']<10){
              $day_member =  '0'.$crea['day_member'];
            } else {
              $day_member = $crea['day_member'];
            }
            if($crea['hour_member']<10){
              $hour_member =  '0'.$crea['hour_member'];
            } else {
              $hour_member = $crea['hour_member'];
            }?>
            <td style="border:  2px solid #b1d1d0 ;"> <?php echo $day_member.'/'.$month_member.'/'.$crea['year_member']; ?></td>
            <td style="border:  2px solid #b1d1d0 ;">  <a href="gestionBO.php?ajoute=<?= $member1['id'];?>">Ajouter</a></td>
            <?php
            if (isset($_GET['ajoute']) AND !empty($_GET['ajoute'])) {
              $id = htmlspecialchars((int) $_GET['ajoute']);
              $delete = $bdd->prepare('UPDATE member SET suppr = ?  WHERE id = ?');
              $delete->execute(array($ajoute,$id));
              header("Location:gestionBO.php");
            } ?>
            <td style="border:  2px solid #b1d1d0 ;"> <a href="gestionBO.php?admin=<?= $member1['id'];?>"> Add Admin </a> </td>
            <?php if(isset($_GET['admin'])AND !empty($_GET['admin'])){
              $id= htmlspecialchars((int) $_GET['admin']);
              $add= $bdd-> prepare('UPDATE member SET admin = ? WHERE id = ?  ');
              $add -> execute(array($admin,$id));
              header("Location:gestionAdminBO.php");
            } ?>
            <?php
          }  ?>
        </tr>
      </table>
    </section>
  </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
<?php  ob_end_flush(); ?>
