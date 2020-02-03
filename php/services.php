<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="../css/styles2.css">
 <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


	<title>Biens & Services</title>
</head>
<body>
  <style media="screen">
  body{
color:#258784;
background-color: #C3D7D7;
position: relative;
}
  </style>
	<?php include('header.php')?>
   <?php include('not.php') ?>
     <div class="container" style="text-align: justify;margin-top:2%;">
       <center>
       <section class="block1 col-md-5" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
         <h1  class="cursor_none">Biens & Services</h1>
       </section>
       </center>
     </br>
    <section class="block1 col-md-12" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;height:200px;">
		<form action="recherche.php" method="get">
			Recherche: <input type="text" id="search" name="search" placeholder="Recherche"/>
			<input type="submit" value="Rechercher" />

		</form>
		<br>	<br>

		<a class="btn btn-info a_hover2" style="color:white;" href="formulaireBiens.php">Créer ma propre annonce</a>
			<br>
      </section>
      <br>	<br>
      <div class="row">
      <?php
			$sql =  ('SELECT goods.id_goods as id_goods, goods.name as name, goods.description as description, member.name as member_id, goods.position as position,member.email as email, goods.completer as completer FROM goods INNER JOIN member ON goods.member= member.id ORDER BY date_du_post DESC');


            foreach  ($bdd->query($sql) as $row) {
              if($row['completer']=='0'){


              echo('<div class="block col-md-3 design-block"><section class="form">');
						 	echo '<b>'.$row['member_id']."</b><br>";
							echo "<b>Ville:  </b>".$row['position']."<br>";
			        echo $row['name'] ."<br>" ;
			        echo nl2br($row['description']) ."</br></br>"; ?>
              <a class="btn btn-info a_hover2" style="color:white;" href="mail_location.php?id=<?php echo $row['id_goods']; ?>&nom=<?php echo $row['name']; ?>&type=echange">Je suis interessé(e)</a>
								<br><br>
              </section></div><?php
              }
          }
        ?>
      </div>
</div>
</div>
<?php include('footer.php')?>
</body>
</html>

<?php } ?>
