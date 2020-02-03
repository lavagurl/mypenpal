<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
    <title>Accueil</title>
  </head>
  <body>
    <?php include('header.php')?>
    <div class="container" style="text-align: justify;margin-top:2%;">
      <section class="block1" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
        <h3>QU'EST CE QUE MY PENPAL ?</h3>
      </br>
      <article>MyPenpal est un site de correspondance, permettant aux utilisateurs
        de rencontrer des étrangers résidant dans le monde entier et d’échanger avec eux.
        Les utilisateurs seront répartis par centres d’intérêts.</article>
      </section>
    </br>
    <section class="block2" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
      <h3>COMMENT FONCTIONNE LE SITE ?</h3>
    </br>
    <article><h4> <a href="inscription.php"> <button type="button" class="btn btn-info" name="button">Inscris toi !</button> </a></h4><p>Clique sur le bouton "s'inscrire" qui se trouve
      plus haut et remplis le formulaire d'inscription.</p></article></br>
      <article><h4>Selectionne tes centres d'interets !</h4><p>Lors de ton inscription,
        selectionne tous tes centres d'intérêts.</p></article></br>
        <article><h4>Rencontre et echange avec les autres!</h4><p>Une fois inscris sur notre site,
          tu pourras partager, apprendre et même créer des liens avec les autres membres. </p></article>
        </section>
      </br>
      <section class="block3" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
        <h3>POURQUOI AVOIR CREE CE SITE?</h3>
      </br>
      <article><h4>Pouvoir rapprocher les gens virtuellement, de pays differents !</h4>
        <p>N'as-tu jamais rêvé de cuisiner un plat d'un pays différent et que l'on
          t'explique parfaitement la recette typique?</p></article></br>
          <article><h4>Echanger du savoir faire et des biens !</h4><p>Vous souhaitez échanger votre
            t-shirt contre celui d'un autre membre? Vous avez besoin de cours de
            soutien en maths et vous savez jardiner ? Et bien sur My Penpal,
            vous pouvez échanger des biens ou même des services, sans que le mot "argent" soit employé.</p></article></br>
            <article><h4>Apprendre une nouvelle langue !</h4><p>Quoi de mieux pour apprendre
              une langue que de la pratiquer régulièrement avec quelqu'un d'autre?</p></article></br>
              <article><h4>Et meme voyager !</h4><p>Vous souhaitez voyager dans un autre pays, mais vous n'avez
                pas les moyens de vous prendre un hotel ? My Penpal dispose d'un service d'échange de
                propriété pour les globe trotters intéressés.</p></article></br>
              </section>
            </div>
          </br>
          <?php include('footer.php')?>
        </body>
        </html>

        <?php
      }else{
        include('connexionBDD.php');
        ?>
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
          <link rel="stylesheet" href="../css/styles2.css">
          <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
          <title>Accueil</title>
        </head>
        <body>
          <?php include('header.php')?>
          <?php include('not.php')?>
          <div class="container" style="text-align: justify;margin-top:2%;">
            <section class="block1 col-md-9" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
              <h1  class="cursor_none">Bienvenue <?php echo ($_SESSION['pseudo']); ?>, sur My Penpal !</h1>
            </section>
          </br>
        </br>
        <div class="block3 col-md-6" style="margin:0 auto;border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
          <div>
            <div id="titre_chatbox" align="center">CHATBOX</div>
          </br></br>
          <div id="chatboxInex">
            <?php
            $req_messages=$bdd->query('SELECT content, DAY(creation_date) as day_chat, MONTH(creation_date) as month_chat, YEAR(creation_date) as year_chat, HOUR(creation_date) as hour_chat, MINUTE(creation_date) as minute_chat, name_user  FROM messages_chat ORDER BY id ASC');
            while($message=$req_messages->fetch()){
              ?>
              <script type="text/javascript">
              </script>
              <?php
              $psd=$message['name_user'];
              $pseudomembre = $bdd->query("SELECT premium from member where name='${psd}'");
              $pseudo = $pseudomembre->fetch();

              if($message['minute_chat']<10){
                $minute_chat =  '0'.$message['minute_chat'];
              } else{
                $minute_chat = $message['minute_chat'];
              }
              if($message['month_chat']<10){
                $month_chat = '0'.$message['month_chat'];
              } else {
                $month_chat = $message['month_chat'];
              }
              if($message['day_chat']<10){
                $day_chat =  '0'.$message['day_chat'];
              } else {
                $day_chat = $message['day_chat'];
              }
              if($message['hour_chat']<10){
                $hour_chat =  '0'.$message['hour_chat'];
              } else {
                $hour_chat = $message['hour_chat'];
              }
              ?>
            <div>
              <div style="background-color:#c7e0db;padding:1%;">
                <strong><a class="pageProfil" href="pageProfilAutre.php?pseudoMembre=<?php echo $message['name_user']; ?>"><?php  if($pseudo['premium']==1){ echo $message['name_user'];?> <img class='symboles' src="../images/premium1.png"/><?php
                } else { echo $message['name_user'];} ?></a></strong>
              </div>
              <div class="message_chatbox">
                <div class="contenu"><?php echo nl2br($message['content']); ?></div>
                <div align="right" class="hour_day"><?php echo 'à '.$hour_chat.'h'.$minute_chat; ?> Le <?php echo $day_chat.'/'.$month_chat.'/'.$message['year_chat']; ?></div>
              </div>
            </div>
            </br>
            <?php
            }
            $req_messages->closeCursor();?>

          </div>
          <div id="message_box">
            <form action="" method="post" align="center">
              <input type="hidden" name="name_user" value="<?php echo $_SESSION['pseudo']; ?>">
              <textarea width="500px" style="float:left;margin-right:-500px;" name="message"></textarea>
              <input type="submit" value="Envoyer !" class="btn btn-outline-info">
            </form>
          </div>
        </div>
      </div>
    </br>
  </br>
  <?php

  if(empty($_POST['message'])){
  }else{
    $req=$bdd->prepare('INSERT INTO messages_chat (content, name_user, creation_date) VALUES (:content, :name_user, NOW())');
    $req->execute(array(
      'content'=>htmlspecialchars($_POST['message']),
      'name_user'=>htmlspecialchars($_POST['name_user'])
    ));

  }

  ?>
  <script type="text/javascript">
  document.getElementById('chatboxInex').scrollTop = document.getElementById('chatboxInex').scrollHeight;
  setInterval('actu_chat()',0.5);
  function actu_chat(){
    $('#chatboxInex').load("chatboxActu.php");
  }

</script>
</div>
<?php include('footer.php')?>
</body>
</html>
<?php
}
?>
