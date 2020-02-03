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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <title>Forum</title>
  </head>
  <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  -->  <!--  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  -->  <!--<script type="text/javascript">
    /*$('a[href^="#"]').click(function(){
      var id = $(this).attr("href");
      var offset = $(id).offset().top
      $('html, body').animate({scrollTop: offset}, 'slow');
      return false;
    });*/

  </script>-->
    <?php include('header.php')?>
    <?php include('not.php') ?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <center>
        <section class="block1 col-md-5" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
          <h1  class="cursor_none">Forum</h1>
        </section>
      </center>
    </br></br>
    <div class="block1" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
      <a href="lire_sujet.php?theme=Musique" class="a_hover"><div class="div_hover" ><h2>Musique</h2></div></a>
      <h5 style="opacity:0.5;margin-top:1%;">Description pour le thème musique :</h5>
      <p id="#musique" style="background-color:#e3f1f2;padding:1%;">Vous jouez d'un instrument ? Vous aimez tout simplement parler de musique ? Venez nous montrer de quoi vous êtes capable ou découvrir les stars de demain !</p>
    </div>
  </br>
  <div class="block2" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
    <a href="lire_sujet.php?theme=Nourriture" class="a_hover"><div class="div_hover" ><h2>Nourriture</h2></div></a>
    <h5 style="opacity:0.5;">Description pour le thème nourriture :</h5>
    <p id="#cuisine" style="background-color:#e3f1f2;padding:1%;">Quoi de mieux que de parler nourriture ? Un sujet sur lequel tout le monde s'entends plus ou moins ! Donnez nous vos meilleurs recettes, postez les photos de vos repas pour nous donner envie. </p>
  </div>
</br>
<div class="block3" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Beauté" class="a_hover"><div class="div_hover" ><h2>Beauté</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème beauté :</h5>
  <p id="#" style="background-color:#e3f1f2;padding:1%;">Ici, venez parler des derniers produits de beauté tendances. Que ce soit des conseils, des tutos ou simplement des demandes d'aide, cette section est faite pour vous !</p>
</div>
</br>
<div class="block4" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Nature" class="a_hover"><div class="div_hover" ><h2>Nature</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème nature :</h5>
  <p id="#nature" style="background-color:#e3f1f2;padding:1%;">Petit moment de détente auprès de Dame Nature ! Partagez nous vos meilleurs conseils pour avoir la main verte!</p>
</div>
</br>
<div class="block5" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Voyage" class="a_hover"><div class="div_hover" ><h2>Voyage</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème voyage :</h5>
  <p id="#voyage" style="background-color:#e3f1f2;padding:1%;">Montrez nous vos voyages. Postez vos plus belles photos et donnez nous des conseils. Que faut-il prendre pour partir en randonné ? Sur quels sites acheter les billets pour un meilleur rapport qualité/prix ? </p>
</div>
</br>
<div class="block6" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Sport" class="a_hover"><div class="div_hover" ><h2>Sport</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème sport :</h5>
  <p id="#sport" style="background-color:#e3f1f2;padding:1%;">Vous êtes sportifs ? Vous cherchez des conseils et vous ne savez pas où poser vos questions ? Entrez dans ce forum pour discuter avec nos membres les plus sportifs !</p>
</div>
</br>
<div class="block7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Histoire" class="a_hover"><div class="div_hover" ><h2>Histoire</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème histoire :</h5>
  <p id="#histoire" style="background-color:#e3f1f2;padding:1%;">Vous êtes un.e passioné.e d'histoire ? Les guerres mondiales ou l'histoire d'un pays en général vous plait et vous aimeriez débattre sur le sujet ? Cette endroit vous est réservé !</p>
</div>
</br>
<div class="block8" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Technologie" class="a_hover"><div class="div_hover" ><h2>Technologie</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème technologie :</h5>
  <p id="#technologie" style="background-color:#e3f1f2;padding:1%;">Apprenez nous à manipuler les dernières technologies ! Donnez nous même quelques tutos.</p>
</div>
</br>
<div class="block9" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Culture" class="a_hover"><div class="div_hover" ><h2>Culture asiatique</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème culture asiatique :</h5>
  <p id="#culture" style="background-color:#e3f1f2;padding:1%;">Passionné.e de mangas, animés ou KPOP ? Cette section est faite pour vous! Partagez les dernières actus de l'extrême Orient ou les meilleures performances de vos stars préférées!</p>
</div>
</br>
<div class="block10" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Lecture" class="a_hover"><div class="div_hover" ><h2>Lecture</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème lecture :</h5>
  <p id="#lecture" style="background-color:#e3f1f2;padding:1%;">Vous vous évadez grâce à vos bouquins? Partagez avec nous vos récents coup de cœur ou vos écrits !</p>
</div>
</br>
<div class="block11" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Langues" class="a_hover"><div class="div_hover" ><h2>Langues</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème langues :</h5>
  <p id="#langues" style="background-color:#e3f1f2;padding:1%;">Polyglotte ? Partagez votre savoir et astuces avec des leçons simples !</p>
</div>
</br>
<div class="block12" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Cinématographie" class="a_hover"><div class="div_hover" ><h2>Cinéma</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème cinéma :</h5>
  <p id="#cinema" style="background-color:#e3f1f2;padding:1%;">Vous êtes un grand cinéphile? Partagez avec nous vos films préférés et vos hypothèses à leur sujet! En entrant, faites attention aux spoilers !</p>
</div>
</br>
<div class="block13" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=JeuxVidéos" class="a_hover"><div class="div_hover"><h2>Jeux vidéos</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème jeux vidéos :</h5>
  <p id="#jeux" style="background-color:#e3f1f2;padding:1%;">Echangez avec une véritable communauté aux goûts variés. Fortnite, League of Legends, PUBG, tous vos conseils seront appréciés !</p>
</div>
</br>
<div class="block12" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
  <a href="lire_sujet.php?theme=Art" class="a_hover"><div class="div_hover"><h2>Art</h2></div></a>
  <h5 style="opacity:0.5;">Description pour le thème art :</h5>
  <p id="#art" style="background-color:#e3f1f2;padding:1%;">Vous aimez l'art sous n'importe quel forme ? Montrez nous le votre, on veut voir votre talent ! Vous ne voulez que discuter et débattre ? Pas de problème, ce soin vous est reservé !</p>
</div>
</br>

          </div>

          <?php
          include('footer.php')
          ?>

        </body>
        </html>

      <?php } ?>
