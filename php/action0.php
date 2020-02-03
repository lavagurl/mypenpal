<?php
session_start();
include('connexionBDD.php');

if(isset($_GET['t'])AND isset($_GET['id'])){
  if(!empty($_GET['t']) AND !empty($_GET['id'])){
    $id = (int)$_GET['id'];
    $gett = (int)$_GET['t'];
    $id_user = $_SESSION['id'];

    $checkCompte = $bdd->query('SELECT id from system_like WHERE id_user ='.$id_user.' AND id_contenu_like='.$id);
    $count = $checkCompte->rowCount();
    $checkCompte2 = $bdd->query('SELECT id from system_dislike WHERE id_user ='.$id_user.' AND id_contenu_dislike='.$id);
    $count2 = $checkCompte2->rowCount();

    $check = $bdd->prepare('SELECT id from forum_sujets WHERE id =?');
    $check->execute(array($id));
    if($check->rowCount() > 0){
      if($gett == 1){
        if($count == 0 && $count2 == 0){
          $insertLike = $bdd->prepare('INSERT INTO system_like (id_contenu_like, id_user) VALUES (:id, :id_user)');
          $insertLike->execute(array
          ("id"=>$id,
          "id_user"=>$id_user
        ));
      } else {
        ?>
        <script type="text/javascript">
        alert("Vous avez déjà donné votre avis!");
        document.location.href = 'pageActuProfilAutre.php?pseudoMembre=<?php echo ($id); ?>';
        </script>
        <?php
      }
    }

    if($gett == 2) {
      if($count2 == 0 && $count == 0){
        $insertDislike = $bdd->prepare('INSERT INTO system_dislike (id_contenu_dislike, id_user) VALUES (:id, :id_user)');
        $insertDislike->execute(array
        ("id"=>$id,
        "id_user"=>$id_user
      ));
    } else {
      ?>
      <script type="text/javascript">
      alert("Vous avez déjà donné votre avis!");
      document.location.href = 'lire_sujet_complet.php?id_sujet=<?php echo ($id); ?>';
      </script>
      <?php
    }
  }
  ?>
  <script type="text/javascript">
  alert("Votre avis a été pris en compte !");
  document.location.href = 'lire_sujet_complet.php?id_sujet=<?php echo ($id); ?>';
  </script>
  <?php
}

}
}

?>
