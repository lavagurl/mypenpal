<?php
session_start();
include('connexionBDD.php');
$pseudoparam = $_GET['pseudoMembre'];
if($pseudoparam == $_SESSION['pseudo']){
  header("Location: pageActuProfil.php");
} else {
  $reqpsd = $bdd->prepare("SELECT * FROM member WHERE name = ?");
  $reqpsd -> execute(array("$pseudoparam"));
  $pseudoexist = $reqpsd->rowCount();
  if($pseudoexist == 0){
    ?>
    <script type="text/javascript">
    alert("|| ERREUR || Ce membre n'existe plus !");
    document.location.href = 'pageActuProfilAutre.php?pseudoMembre='.$pseudoparam;
    </script>
    <?php
  }
  $reponse = $bdd->query("SELECT * FROM member WHERE name='$pseudoparam'");
  $donnees = $reponse -> fetch();
  $messages = $bdd->query("SELECT DAY(date_post) as day_post, MONTH(date_post) as month_post, YEAR(date_post) as year_post, HOUR(date_post) as hour_post, MINUTE(date_post) as minute_post, contenu, statut, id, pseudo FROM posts_perso WHERE pseudo='$pseudoparam' ORDER BY id DESC");
  $reqPosts = $bdd->query("SELECT * FROM posts_perso WHERE pseudo= '$pseudoparam'");
  $postsExist = $reqPosts->rowCount();
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

    <title><?php echo $donnees['name'] ?></title>
  </head>
  <body>
    <?php include('header.php')?>
    <?php include('not.php')?>
    <div class="container" style="text-align:justify;margin-top:2%;">
        <?php
        $amis = $bdd->query("SELECT * FROM amis WHERE (pseudo_membre1 = '{$_SESSION['pseudo']}' AND pseudo_membre2 ='${pseudoparam}') OR (pseudo_membre2 = '{$_SESSION['pseudo']}' AND pseudo_membre1 ='${pseudoparam}')");
        $reqAmis = $amis->rowCount();
        if($reqAmis < 1){ ?>
          <div class="col-sm-4 col-md-9" style="margin:0 auto;background-color: white;padding:3%;">
            <p>Vous n'êtes pas amis avec cette personne ! </p>
          </div>
        <?php } else { ?>
          <div class="col-sm-4 col-md-9 user-details" style="margin:0 auto;background-color: white;padding:3%;">
            <div class="row">
              <div class="inline_block">
                <img src="<?php echo $donnees['avatar']; ?>" align="left" class="rounded mx-auto d-block"  style="height:50%;border-radius:50%;float:left;"/>
              </div>
              <div class="inline_block" style="float:right;margin-right:5%;" >
                <ul class="list-unstyled">
                  <li><strong>Pseudo :</strong> <?php echo $donnees['name']; ?></li></br>
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
                <form class="" action="pageProfilAutre.php?pseudoMembre=<?php echo $donnees['name']; ?>" method="post">
                  <input type="submit"  class="btn btn-info" value="Retour au profil">
                </form>
              </div>
            </div>
        </div>
        </br>
      </br>
      <?php
      if($postsExist > 0){

                while($message = $messages -> fetch()){
                  if($message['statut']=='0'){
                    $id = $message['id'];
                  $contenu = $message['contenu'];
                  $auteur = $message['pseudo'];
                      ?>
                      <div class="block1 col-md-6" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;height:200px;">
                        <div>
                          <img  align="left" style="padding:3%;border-radius:50%;" src="<?php echo ($donnees['avatar']) ?>"  class="rounded mx-auto d-block" width="30%" height="30%"/></br>
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
                        </div>
                      </br></br>
                    <?php
                    }
                  }
      } else{
        ?>
        <section class="titre">
          <h4><?php echo ($pseudoparam); ?> n'a encore rien posté !</h4>
        </section>
        <?php
        }
    } ?>
    </div>
    <?php include('footer.php')?>
  </body>
  </html>

  <?php
}
?>
