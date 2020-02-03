<header>
  <script type="text/javascript" src="../js/jsMenu.js"></script>
  <span onclick="openNav()"> <img src="../images/logomenu.png" alt="Menu" class="openbtn"> </span>
  <div id="navbar">
    <div id="mySidenav" class="sidenav">
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="index.php">ACCUEIL</a>
        <a href="locations.php">LOCATIONS</a>
        <a href="services.php">BIENS & SERVICES</a>
        <a href="evenements.php">EVENEMENTS</a>
        <a href="forum.php">FORUM</a>
        <a id="couleurBarre">______________</a>
      </br>
        <?php
        if(!isset($_SESSION['pseudo'])){?>
          <a href="connexion.php">SE CONNECTER</a>
          <a href="inscription.php">S'INSCRIRE</a>
          <?php
        } else{
          ?>
          <a href="pageProfil.php">Mon profil</a>
          <a href="messagerie.php">Messagerie
  <div id="messagerie">
           <?php

           $req=$bdd->query('SELECT COUNT(id_notif) as number FROM notifications WHERE notifications.status=1 AND notifications.type="message" AND id_receveur='.$_SESSION['id']);
         while($msg = $req -> fetch()){
            echo $msg['number'];
         }
             ?>
          </div>


          <script>

            setInterval('load_notifications_msg()',1500);
            function load_notifications_msg(){
              $('#messagerie').load("load_msg.php");
            }
          </script>
           </a>


          <a href="notifications.php">Notifications
            <div id="notifications">
            <?php

           $sql=$bdd->query('SELECT COUNT(id_notif) as number FROM notifications WHERE notifications.status=1 AND (notifications.type="location" OR notifications.type="echange" OR notifications.type="forum" OR notifications.type="amis") AND id_receveur='.$_SESSION['id']);
            while($notif = $sql -> fetch()){
              echo $notif['number'];
            }
             ?>
          </div>


          <script>

            setInterval('load_notifications()',1500);
            function load_notifications(){
              $('#notifications').load("load_notifications.php");
            }
          </script>
        </a>
          <a class="police" href="listeMembres.php?donnees=bla">Membres</a>
              <?php
              $reponse = $bdd->query("SELECT * FROM member WHERE name='{$_SESSION['pseudo']}'");
              $admin = $reponse -> fetch();
              if($admin['admin']==1){ ?>
                <a href="accueilBO.php">Administration</a>
              <?php } ?>
              <a href="deconnexion.php">Deconnexion</a>
          <?php
        }
        ?>
  </nav>
</div>
</header>
