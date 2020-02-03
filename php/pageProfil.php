<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{

  include('connexionBDD.php');


  $reponse = $bdd->query("SELECT * FROM member WHERE name='{$_SESSION['pseudo']}'");
  $donnees = $reponse -> fetch();
  $avatar = $donnees['avatar'];
  //--------------------------------------------------------------------------------------------
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
  //--------------------------------------------------------------------------------------------
  $reponse1 = $bdd->query ("SELECT * FROM hobbies WHERE id_hobbies IN (SELECT hobbies FROM posseder WHERE member IN (SELECT id FROM member WHERE name ='{$_SESSION['pseudo']}'))");


  ?>


  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <title>Mon profil</title>
  </head>
  <body>
    <?php include('header.php')?>
    <?php include('not.php') ?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <div class="block1" style="margin:0 auto;">
          <div class="col-sm-4 col-md-9" style="margin:0 auto;background-color: white;padding:3%;">
            <div class="row">
              <div class="inline_block">
                <img class="rounded mx-auto d-block" src="<?php echo ($avatar) ?>" align="left" class="rounded mx-auto d-block"  style=" margin:0 auto;height:30%;border-radius:20%;float:left;"/>
              </div>
              <div class="inline_block" >
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
                  }; ?>
                </ul>
                <form class="" action="pageActuProfil.php" method="post">
                  <p> <input class="btn btn-info" type="submit" name="" value="Accéder à ma page d'actu">  </p>
                </form>
                <form class="" action="messagerie.php" method="post">
                  <p> <input class="btn btn-info" type="submit" name="" value="Accéder à ma messagerie">  </p>
                </form>
                <form class="" action="pageEspaceProfil.php" method="post">
                  <p> <input class="btn btn-info" type="submit" name="" value="Accéder à mon espace">  </p>
                </form>
              </div>
            </div>
            <div class="" style="">
              <strong>Description :</strong></br></br>
                <p><?php echo nl2br($donnees['description']);?></p>
              </div>
            <div>
              <strong>Centre d'intérêt :</strong>
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
            <div style="float:right;">
              <a class="police" href="parametresProfil.php"><i class="fa fa-gears" style="font-size:36px ;color:black;"></i></a>
            </div><br>
        </div>
    </div>
  </div>
  <?php include('footer.php')?>
</body>
</html>

<?php
}
?>
