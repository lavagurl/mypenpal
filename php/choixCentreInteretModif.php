<?php session_start();
$date = date("d-m-Y");
$heure = date("H:i");
include('connexionBDD.php');
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Choix centre d'intêret</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles2.css">
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon.ico" />
  <script src="../js/jquery.js"></script>
  <script src="../js/centreInteretModif.js" ></script>
  <style type="text/css">
  .checkbox input[type="checkbox"]{display:none;}
  .checkbox input[type="checkbox"] + label::before{
    content:"";
    display:inline-block;
    width:50px;
    height:20px;
    background:white;
    border-radius:5px;
    border:solid black;
    margin-top: 5px;
    border-width:0.5px;
    position: center;

  }
  .checkbox input[type="checkbox"]:checked + label::before{
    background-color:green;
    padding-top:0.5%;
    padding-bottom:0.5%;
    border:solid;
    border-width:0.5px;
    border-color:black;
    color:white;
    text-align: center;
  }
  .centre {
    width: 13px;
    height: 13px;
    padding: 0;
    margin-top: 5px;
    vertical-align: bottom;
    top: 3px;
    *overflow: hidden;

  }

  label  {

    display: block;
    padding: center;
    text-indent: 15px;
  }

</style>

</head>
<body>
  <?php include('header.php')?>

  <section class="block1 col-md-5" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
    <h2 class="titres"> Centre d'intêret </h2>
  </section>
  <section class="block1" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
    <div id='container_checkbox'>
      <div class="checkbox_titre">
        <h4> Veuillez choisir des centres d'intêrets parmis ceux proposés. </h4>
      </div>
      <form  action="verifmodifcentre.php" name="centre"  enctype="multipart/form-data" method="post" onsubmit="return VerifCheck(this)">
        <div class ="checkbox">
          <h4> Vos centres d'intêrets sont : </h4>
          <?php    $reponse1 = $bdd->query ("SELECT * FROM hobbies WHERE id_hobbies IN (SELECT hobbies FROM posseder WHERE member IN (SELECT id FROM member WHERE name ='{$_SESSION['pseudo']}'))");
          while ($donnees1 = $reponse1->fetch())
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
          $reponse = $bdd->query ("SELECT * FROM hobbies WHERE id_hobbies IN (SELECT hobbies FROM posseder WHERE member IN (SELECT id FROM member WHERE name ='{$_SESSION['pseudo']}'))");
          $donnees = $reponse->fetch();

          if($donnees["name"]=='Musique'){ ?>
            <input id="musiquecheck"type="checkbox" name="musique" value="Musique" class"centre" onclick="MusiqueCheck(this)" checked /><label for='musiquecheck' > Musique </label>
          <?php $donnees = $reponse->fetch(); } else {?>
            <input id="musiquecheck"type="checkbox" name="musique" value="Musique" class"centre" onclick="MusiqueCheck(this)"/><label for='musiquecheck'> Musique </label>
            <?php
          }

          if($donnees["name"]=='Voyage'){ ?>
            <input id="voyagecheck"type="checkbox" name="voyage" value="Voyage"class"centre" onclick="VoyageCheck(this)" checked/><label for='voyagecheck' > Voyage </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="voyagecheck"type="checkbox" name="voyage" value="Voyage"class"centre" onclick="VoyageCheck(this)"/><label for='voyagecheck'> Voyage </label>
            <?php
          }

          if($donnees["name"]=='Nourriture'){ ?>
            <input id="nourriturecheck"type="checkbox" name="nourriture" value="Nourriture" class"centre" onclick="NourritureCheck(this)" checked/><label for='nourriturecheck'> Nourriture </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="nourriturecheck"type="checkbox" name="nourriture" value="Nourriture" class"centre" onclick="NourritureCheck(this)"/><label for='nourriturecheck'> Nourriture </label>
            <?php
          }

          if($donnees["name"]=='Sport'){ ?>
            <input id="sportcheck"type="checkbox" name="sport" value="Sport"class"centre" onclick="SportCheck(this)" checked/> <label for='sportcheck'> Sport </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="sportcheck"type="checkbox" name="sport" value="Sport"class"centre" onclick="SportCheck(this)"/> <label for='sportcheck'> Sport </label>
            <?php
          }

          if($donnees["name"]=='Histoire'){ ?>
            <input id="histoirecheck" type="checkbox" name="histoire" class"centre" value="Histoire" onclick="HistoireCheck(this)" checked/> <label for='histoirecheck'> Histoire </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="histoirecheck" type="checkbox" name="histoire" class"centre" value="Histoire" onclick="HistoireCheck(this)" /> <label for='histoirecheck'> Histoire </label>
            <?php
          }

          if($donnees["name"]=='Langues'){ ?>
            <input id="languecheck"type="checkbox" name="langues" value="Langues"class"centre" onclick="LanguesCheck(this)" checked/> <label for='languecheck'> Langue </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="languecheck"type="checkbox" name="langues" value="Langues"class"centre" onclick="LanguesCheck(this)"/> <label for='languecheck'> Langue </label>
            <?php
          }

          if($donnees["name"]=='Lecture'){ ?>
            <input id="lecturecheck"type="checkbox" name="lectures" value="Lecture" class"centre" onclick="LecturesCheck(this)" checked/> <label for='lecturecheck'> Lecture </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="lecturecheck"type="checkbox" name="lectures" value="Lecture" class"centre" onclick="LecturesCheck(this)"/> <label for='lecturecheck'> Lecture </label>
            <?php
          }

          if($donnees["name"]=="CultureAsiatique"){ ?>
            <input id="culturecheck"type="checkbox" name="culture" value="CultureAsiatique" class"centre" onclick="CultureCheck(this)" checked/> <label for='culturecheck'> Culture Asiatique </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="culturecheck"type="checkbox" name="culture" value="CultureAsiatique" class"centre" onclick="CultureCheck(this)"/> <label for='culturecheck'> Culture Asiatique </label>
            <?php
          }

          if($donnees["name"]=='Technologie'){ ?>
            <input id="technologiecheck"type="checkbox" name="technologie" value="Technologie" class"centre" onclick="TechnologieCheck(this)" checked/> <label for='technologiecheck'> Technologie </label>
          <?php $donnees = $reponse->fetch(); } else { ?>
            <input id="technologiecheck"type="checkbox" name="technologie" value="Technologie" class"centre" onclick="TechnologieCheck(this)"/> <label for='technologiecheck'> Technologie </label>
            <?php
          }

          if($donnees["name"]=='Cinématographie'){ ?>
            <input id="cinemacheck"type="checkbox" name="cine" value="Cinématographie"class"centre" onclick="CineCheck(this)" checked/> <label for='cinemacheck'> Cinématographie </label>
          <?php $donnees = $reponse->fetch();} else  { ?>
            <input id="cinemacheck"type="checkbox" name="cine" value="Cinématographie"class"centre" onclick="CineCheck(this)"/> <label for='cinemacheck'> Cinématographie </label>
            <?php
          }

          if($donnees["name"]=='JeuxVidéo') { ?>
            <input id="jeuxcheck"type="checkbox" name="jeux" value="JeuxVidéo" class"centre" onclick="JeuxVideoCheck(this)" checked/> <label for='jeuxcheck'> Jeux Vidéo </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="jeuxcheck"type="checkbox" name="jeux" value="JeuxVidéo" class"centre" onclick="JeuxVideoCheck(this)"/> <label for='jeuxcheck'> Jeux Vidéo </label>
            <?php
          }

          if($donnees["name"]=='Art') { ?>
            <input id="artcheck"type="checkbox" name="art" value="Art" class"centre" onclick="ArtCheck(this)" checked/> <label for='artcheck'> Art </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="artcheck"type="checkbox" name="art" value="Art" class"centre" onclick="ArtCheck(this)"/> <label for='artcheck'> Art </label>
            <?php
          }

          if($donnees["name"]=='Nature') { ?>
            <input id="naturecheck"type="checkbox" name="nature" value="Nature" class"centre" onclick="NatureCheck(this)" checked/> <label for='naturecheck'> Nature </label>
          <?php $donnees = $reponse->fetch();} else {  ?>
            <input id="naturecheck"type="checkbox" name="nature" value="Nature" class"centre" onclick="NatureCheck(this)"/> <label for='naturecheck'> Nature </label>
            <?php
          }

          if($donnees["name"]=='Bricolage') { ?>
            <input id="bricolagecheck"type="checkbox" name="bricolage" value="Bricolage"class"centre" onclick="BricolageCheck(this)" checked/> <label for='bricolagecheck'> Bricolage </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="bricolagecheck"type="checkbox" name="bricolage" value="Bricolage"class"centre" onclick="BricolageCheck(this)"/><label for='bricolagecheck'> Bricolage </label>
            <?php
          }

          if($donnees["name"]=='Beauté') { ?>
            <input id="beautecheck"type="checkbox" name="beaute" value="Beauté" class"centre" onclick="BeauteCheck(this)" checked/> <label for='beautecheck'> Beauté </label>
          <?php $donnees = $reponse->fetch();} else { ?>
            <input id="beautecheck"type="checkbox" name="beaute" value="Beauté" class"centre" onclick="BeauteCheck(this)"/><label for='beautecheck'> Beauté </label>
            <?php
          } ?>
        </div>
        <br>
        <div class="valider">
          <input class="buttons"type ="submit" name="valider" value="valider"/>
        </div>

      </form>
    </div>
  </section>

  <?php include('footer.php')?>
</body>
</html>
