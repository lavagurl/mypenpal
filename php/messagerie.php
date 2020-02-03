<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{

  include('connexionBDD.php');

  $amis = $bdd ->query("SELECT * FROM amis WHERE pseudo_membre1='{$_SESSION['pseudo']}'");
  $reqAmis = $bdd->prepare("SELECT * FROM amis WHERE pseudo_membre1='{$_SESSION['pseudo']}'");
  $reqAmis -> execute(array("{$_SESSION['pseudo']}"));
  $amisExist = $reqAmis->rowCount();
  $messages = $bdd->query("SELECT * FROM messagerie_privee WHERE mp_receveur ='{$_SESSION['pseudo']}'");
  $reqMessages = $bdd->prepare("SELECT * FROM messagerie_privee WHERE mp_receveur ='{$_SESSION['pseudo']}'");
  $reqMessages -> execute(array("{$_SESSION['pseudo']}"));
  $messageExist = $reqMessages->rowCount();
  $updateMp = $bdd->prepare("UPDATE `messagerie_privee` SET `mp_lu` = '1' WHERE mp_receveur = ?");
  $updateMp ->execute(array
  ($_SESSION['pseudo']));

  $updateNotifMp = "UPDATE notifications SET status = 0 WHERE notifications.id_receveur = '{$_SESSION['id']}' AND notifications.type='message'";
  $req=$bdd->prepare($updateNotifMp);
  $req->execute();
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

    <title>Messagerie</title>
  </head>
  <body>
    <?php include('header.php')?>
    <?php include('not.php')?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <center>
        <section class="block1 col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
          <h1 class="titres">Votre messagerie privée</h1>
        </section>
      </center>
      <div class="row">
        <div class="col-md-6">
          <h3  class="cursor_none" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;"> Vos messages privés : </h3>
          <?php
          if($messageExist>0){
            while ($message = $messages->fetch()) {
              if($message['mp_lu']=='0'){
                $id_message = $message['mp_id']; ?>

                <article class="message design-block">
                  <ul class="list-unstylled">
                    <li><strong> De :</strong><a class="pageProfil" href="pageProfilAutre.php?pseudoMembre=<?php echo ($message['mp_expediteur']); ?>"> <?php echo ($message['mp_expediteur']); ?></a></li>
                    <li><strong> Objet : </strong><?php echo ($message['mp_titre']); ?></li>
                    <li><strong> Date : </strong><?php echo ($message['mp_time']); ?></li>
                  </ul>
                  <form class="" action="messagerie_mp.php?envoyeur=<?php echo ($message['mp_expediteur']); ?>" method="post">
                    <input type="submit" class="btn btn-info" name="consulter" value="Lire"/>
                  </form>
                </article>
              </a>
              <?php

            }
          }
        }else{ ?>
          <article class="message design-block">
            <p>Vous n'avez pas de nouveau message !</p>
          </article>
          <?php
        } ?>
      </div>
      <div class="col-md-6" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
        <center><h3  class="cursor_none" style="padding:1%;"> Vos amis : </h3></center>
        <div class="row">
          <?php
          if($amisExist>0){
            while($ami = $amis->fetch()){
              $infos_expediteur=$bdd->query("SELECT * from member WHERE name='{$ami['pseudo_membre2']}'");
              $info_exp = $infos_expediteur -> fetch();
              $avatar = $info_exp['avatar'];
              ?>
              <form class="" action="messagerie_mp.php?envoyeur=<?php echo($ami['pseudo_membre2']); ?>" method="get">
                <div class="col-md-8" style="list-style-type:none;border:3px solid #cce0df; padding:2%;margin:1%">
                  <center><img src="<?php echo ($avatar); ?>" alt="">
                    <style media="screen">
                    div >center> img{
                      padding: 1%;
                      width:10%;
                      height:10%;
                      border-radius: 50px;
                    }
                    </style>
                    <strong><a align="right" class="pageProfil" href="pageProfilAutre.php?pseudoMembre=<?php echo ($ami['pseudo_membre2']); ?>"> <?php echo ($ami['pseudo_membre2']); ?></a></strong></br>
                    <a href="messagerie_mp.php?envoyeur=<?php echo($ami['pseudo_membre2']); ?>"> <button type="button" class="btn btn-info" name="button">Suivre la conversation</button></a>
                  </center>
                </div>
              </form>
            </br>
            <?php
          }
          ?>

        </div>
        <?php
      }else{ ?>
        <section class="message design-block">
          <p>Vous n'avez pas encore d'amis !</p>
        </section>
      <?php  }

      ?>
    </div>
  </div>

</div>
<?php include('footer.php')?>
</body>
</html>

<?php
}
?>
