<?php
session_start();
if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{

  include('connexionBDD.php');
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
$req_messages->closeCursor();

 } ?>
