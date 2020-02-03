<?php
session_start();
include('connexionBDD.php');
$sql =  ('SELECT goods.name as name, goods.description as description, member.name as member_id, goods.position as position FROM goods INNER JOIN member ON goods.member= member.id ORDER BY date_du_post DESC');
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/styles2.css">
	<link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<title>Biens & Services</title>
</head>
<body>
	<?php include('header.php') ?>
	<?php include('not.php') ?>
	<div class="container" style="text-align: justify;margin-top:2%;">
		<h1>Liste des propositions de biens et services</h1>
		<script src="../js/erreur.js"></script>

		<form action="recherche.php" method="get">
			Recherche: <input type="text" name="search" placeholder="Recherche"/>
			<input type="submit" value="Rechercher" />

		</form>
		<br>	<br>	<br>	<br>	<br>
    <p>
      <?php
					foreach  ($bdd->query($sql) as $row) {

						 	echo $row['member_id']."<br>";
							echo "Lieu: ".$row['position']."<br>";
			        echo $row['name'] ."<br>" ;
			        echo  $row['description'] ."<br>"; ?>	<input type="submit" value="Je suis interessé(e)" onclick=""/>
								<br><br> <?php
						}
        ?>

    </p>
</div>
<?php include('footer.php') ?>
</body>
</html>
