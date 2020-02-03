<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location:connexion.php");
}else{

  include('connexionBDD.php');

  $dates_creation = $bdd->query("SELECT DAY(creation_date) as day_creation, MONTH(creation_date) as month_creation, YEAR(creation_date) as year_creation FROM member WHERE name='{$_SESSION['pseudo']}'");
  $date_inscription = $dates_creation ->fetch();
  $day_creation = $date_inscription['day_creation'];
  $month_creation = $date_inscription['month_creation'];
  $year_creation = $date_inscription['year_creation'];

  if($month_creation<10){
    $month_creation = '0'.$month_creation;
  } else {
    $month_creation = $month_creation;
  }
  if($day_creation<10){
    $day_creation =  '0'.$day_creation;
  } else {
    $day_creation = $day_creation;
  }

  $id = $_SESSION['id'];
  $reponse = $bdd->query("SELECT * FROM member WHERE name='{$_SESSION['pseudo']}'");
  $donnees = $reponse -> fetch();
  $reponse1 = $bdd->query ("SELECT * FROM hobbies WHERE id_hobbies IN (SELECT hobbies FROM posseder WHERE member IN (SELECT id FROM member WHERE name ='{$_SESSION['pseudo']}'))");
  if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])){
    $tailleMax = 2097125;
    $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
    if($_FILES['avatar']['size'] <= $tailleMax){
      $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'],'.'), 1));
      if(in_array($extensionUpload, $extensionsValides)){
        $chemin = "../images/avatars/".$_SESSION['pseudo'].".".$extensionUpload;
        $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin);
        if($resultat){

          $updateavatar = $bdd->prepare("UPDATE member SET avatar = :avatar WHERE id = $id");
          $updateavatar->execute(array(
            "avatar"=> $chemin
          ));
          header("Location:pageProfil.php");
        }
        else{
          ?>
          <script type="text/javascript">
          alert("Erreur lors de l'importation");
          document.location.href = 'parametresProfil.php';
          </script>
          <?php
        }
      }
      else{
        ?>
        <script type="text/javascript">
        alert('Votre photo de profil doit être au format jpg, jpeg, gif ou png');
        document.location.href = 'parametresProfil.php';
        </script>
        <?php
      }
    }
    else {
      ?>
      <script type="text/javascript">
      alert('Votre photo de profil ne doit pas dépasser 2Mo');
      document.location.href = 'parametresProfil.php';
      </script>
      <?php
    }
  }
  ?>


  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/styles2.css">
    <title>Paramètres</title>
  </head>
  <body>
    <?php include('header.php')?>
    <?php include('not.php') ?>

    <div class="container" style="text-align: justify;margin-top:2%;">
      <div class="block1" style="margin:0 auto;">
          <div class="col-sm-4 col-md-9" style="margin:0 auto;background-color: white;padding:3%;">
            <div class="row">
              <div class="inline_block">
              <img class="rounded mx-auto d-block" src="<?php echo $donnees['avatar'] ?>" align="left" class="img-reponsive"  style=" margin:0;padding: 0;height:30%;border-radius:40%;float:left;"/></br>
              <form action="" method="POST" enctype="multipart/form-data">
                <input type="file" name="avatar" value="" ></input>
                <input type="submit" name="" value="Envoyez"></input>
              </form>
            </div>
            <div class="inline_block" style="float:right;margin-right:5%;" >
              <ul class="list-unstyled">
                <li><strong>Pseudo :</strong> <?php echo $_SESSION['pseudo']; ?></li></br>
                <li><strong>Pays :</strong> <?php echo $donnees['position']; ?></li></br>
                <li><strong>Sexe :</strong> <?php  if($donnees['gender']==0){?>
                  <img class="symboles" src="../images/femme.png" alt="Femme" style="width:20px;height:20px;"/>
                <?php  }
                else
                { ?>
                  <img class="symboles" src="../images/homme.png" alt="Homme" style="width:20px;height:20px;"/>
                <?php  }  ; ?></li></br>
                <li><strong>Premium :</strong> <?php if($donnees['premium']==0){
                  echo "Je ne suis pas premium !";
                } else {
                  echo "Je suis premium !";
                }; ?>  <a class="police" href="premium.php"><i class="fa fa-gears" style="font-size:24px ;color:black;"></i></a>
              </ul>
            </div>
          </div>
          <div class="" style="">
            <strong>Description :</strong></br></br>
            <div class="infos2">
              <?php if(isset($_POST['modifier'])) {
                $description = htmlspecialchars($_POST['description']);
                $insertmbr = $bdd->prepare("UPDATE member SET description= ? WHERE name='{$_SESSION['pseudo']}' ");
                $insertmbr ->execute(array
                ($description)
              );
              header("Location: pageProfil.php");
            } ?>
            <?php echo $donnees['description'];?>
          </br>
        </br>
        <form class="" action="" method="post">
          <textarea id="news" cols="50" rows="10" name="description"></textarea>
          <input id="mod" type="submit" name="modifier" value="Modifier"></input>
        </form>
      </div>
    </div>
    <div>
      <strong>Centre d'intérêt :</strong>
      <?php if($donnees['premium']==1){ ?>
        <a class="police" href="choixCentreInteretModif.php"><i class="fa fa-gears" style="font-size:24px ;color:black;"></i></a>
      <?php } ?>
    </br>
    <?php while ($donnees1 = $reponse1->fetch())
    {?>
      <ul class="list-unstyled" style="display:inline-block;">
        <li> <?php
        if($donnees1['name'] == "Musique"){ ?>
          <img class="icones" src="../images/centres/musique.png" alt="Musique"/>
          <?php
        }
        if($donnees1['name'] == "Voyage"){  ?>
          <img class="icones" src="../images/centres/voyage.png" alt="Voyage"/>
          <?php
        }
        if($donnees1['name'] == "Nourriture"){ ?>
          <img class="icones" src="../images/centres/cuisine.png" alt="Cuisine"/>
          <?php
        }
        if($donnees1['name'] == "Sport"){ ?>
          <img class="icones" src="../images/centres/sport.png" alt="Sport"/>
          <?php
        }
        if($donnees1['name'] == "Histoire"){ ?>
          <img class="icones" src="../images/centres/histoire.PNG" alt="Histoire"/>
          <?php
        }
        if($donnees1['name'] == "Langues"){ ?>
          <img class="icones" src="../images/centres/langue.PNG" alt="Langues"/>
          <?php
        }
        if($donnees1['name'] == "Lecture"){ ?>
          <img class="icones" src="../images/centres/lecture.PNG" alt="Lecture"/>
          <?php
        }
        if($donnees1['name'] == "CultureAsiatique"){ ?>
          <img class="icones" src="../images/centres/culture.PNG" alt="Culture asiatique"/>
          <?php
        }
        if($donnees1['name'] == "Technologie"){ ?>
          <img class="icones" src="../images/centres/technologie.PNG" alt="Technologie"/>
          <?php
        }
        if($donnees1['name'] == "Cinématographie"){ ?>
          <img class="icones" src="../images/centres/cinema.PNG" alt="Cinema"/>
          <?php
        }
        if($donnees1['name'] == "JeuxVidéo"){ ?>
          <img class="icones" src="../images/centres/jeux.PNG" alt="Jeux"/>
          <?php
        }
        if($donnees1['name'] == "Art"){ ?>
          <img class="icones" src="../images/centres/art.PNG" alt="Art"/>
          <?php
        }
        if($donnees1['name'] == "Nature"){ ?>
          <img class="icones" src="../images/centres/nature.PNG" alt="Nature"/>
          <?php
        }
        if($donnees1['name'] == "Bricolage"){ ?>
          <img class="icones" src="../images/centres/bricolage.PNG" alt="Bricolage"/>
          <?php
        }
        if($donnees1['name'] == "Beauté"){ ?>
          <img class="icones" src="../images/centres/beaute.PNG" alt="Beaute"/>
          <?php
        }

        ; ?></li>
      </ul>
      <?php
    }
    ?>
  </div>
    <div align="left">Membre depuis le : <?php  echo $day_creation.'/'.$month_creation.'/'.$year_creation; ?></div>

  </div>
  </div>
  </div>
<?php include('footer.php')?>
</body>
</html>

<?php
}
?>
