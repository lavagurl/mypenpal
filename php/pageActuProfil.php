<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{

  include('connexionBDD.php');
  $messages = $bdd->query("SELECT DAY(date_post) as day_post, MONTH(date_post) as month_post, YEAR(date_post) as year_post, HOUR(date_post) as hour_post, MINUTE(date_post) as minute_post, contenu, statut, id, pseudo FROM posts_perso WHERE pseudo='{$_SESSION['pseudo']}' ORDER BY id DESC");

  $reponse = $bdd->query("SELECT * FROM member WHERE name='{$_SESSION['pseudo']}'");
  $donnees = $reponse -> fetch();
  $avatar = $donnees['avatar'];
/*
  $likes = $bdd->query('SELECT id from system_like WHERE id_contenu_like='.$id);
  $countLikes = $likes->rowCount();
  $dislike = $bdd->query('SELECT id from system_dislike WHERE id_contenu_dislike='.$id);
  $countDislikes = $dislike->rowCount();*/
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

    <title>Mon profil</title>
  </head>
  <body>
    <?php include('header.php')?>
    <?php include('not.php')?>
    <div class="container" style="text-align:justify;margin-top:2%;">
          <div class="col-sm-4 col-md-9 user-details" style="margin:0 auto;background-color: white;padding:3%;">
            <div class="row">
              <div class="inline_block" style="padding:2%;">
                <img class="rounded mx-auto d-block" src="<?php echo ($avatar) ?>" align="left"  class="rounded mx-auto d-block"  style="height:50%;border-radius:50%;float:left;"/>
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
                  }; ?>
                </ul>
              </div>
            </div>
            <div class="row">
              <div>
                <center>
                <form action="verifPosts.php?pseudo=<?php echo($_SESSION['pseudo']); ?>" method="post">
                  <textarea placeholder="Hey ! Comment vas-tu? Raconte nous ta journée!" name="message_perso" cols="50" rows="10"></textarea>
                </br>
                  <input type="submit" class="btn btn-info" name="send" value="Poster"></input>
                </form>
              </center>
              </div>
            </div>
        </div>
        <div>
        </br>
      </br>
          <?php
          while($message = $messages -> fetch()){
            $id_post = $message['id'];
            $contenu = $message['contenu'];
            $auteur = $message['pseudo'];
              if($message['statut']=='0'){
                ?>
                <div class="block<?php echo $id_message; ?> col-md-6" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;height:200px;">
                    <form class="boutons_modif_suppression" action="verifPosts.php?id_post=<?php echo $id_post ?>" method="post">
                      <p style="float:right;" ><input class="btn btn-info" id="mod" type="submit" name="supprimerPost" value="Supprimer mon post"></input></p>
                    </form>
                  <div>
                    <img  align="left" style="padding:3%;border-radius:50%;" class="rounded mx-auto d-block" src="<?php echo ($avatar) ?>" width="20%" height="20%"/></br>
                    <a style="float:center;" class="pageProfil" href="pageProfilAutre.php?pseudoMembre=<?php echo $auteur ?>"> <?php echo $auteur ?></a>
                  </div>
                  </br>
                    <p><?php echo($contenu); ?></p>
                    <div style="opacity:0.5;font-size:12px;" align="right">
                      <?php
                      if($message['month_post']<10){
                        $month_creation = '0'.$message['month_post'];
                      } else {
                        $month_creation = $message['month_post'];
                      }
                      if($message['day_post']<10){
                        $day_creation =  '0'.$message['day_post'];
                      } else {
                        $day_creation = $message['day_post'];
                      }
                      if($message['minute_post']<10){
                        $minute_creation =  '0'.$message['minute_post'];
                      } else {
                        $minute_creation = $message['minute_post'];
                      }
                      if($message['hour_post']<10){
                        $hour_creation =  '0'.$message['hour_post'];
                      } else {
                        $hour_creation = $message['hour_post'];
                      }
                       ?>
                      <?php  echo 'à '.$hour_creation.'h'.$minute_creation; ?>
                      <?php  echo ' Le '.$day_creation.'/'.$month_creation.'/'.$message['year_post']; ?>
                    </div>
                  </br>

                  </div>
                </br></br>
              <?php
            }
          } ?>

        </div>



    </div>
    <?php include('footer.php')?>
  </body>
  </html>

  <?php
}
?>
