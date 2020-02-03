<footer class="page-footer font-small mt-4">
  <div class="container">
    <div class="row">
      <section class="col-md-3 mx-auto">
        <h1>Accueil</h1>
        <ul class="list-unstyled">
          <li><a href="locations.php">Locations</a></li>
          <li><a href="services.php">Biens & Services</a></li>
          <li><a href="evenements.php">Evenements</a></li>
        </ul>
      </section>
      <section class="col-md-3 mx-auto">
        <?php
        if(!isset($_SESSION['pseudo'])){?>
          <h1>On vous attends</h1>
          <ul class="list-unstyled">
            <li><a href="inscription.php">S'inscrire</a></li>
            <li><a href="connexion.php">Se connecter</a></li>
          </ul>
          <?php
        } else{ ?>
          <h1>Mon profil</h1>
        <ul class="list-unstyled">
          <li><a href="pageProfil.php">Ma page</a></li>
          <li><a href="parametresProfil.php">Paramètres</a></li>
          <li><a href="deconnexion.php">Deconnexion</a></li>
        </ul>
        <?php
      }
         ?>
      </section>
      <section class="col-md-3 mx-auto">
        <h1>Liens utiles</h1>
        <ul class="list-unstyled">
          <li><a href="mail.php">Nous contacter</a></li>
          <li><a href="https://www.esgi.fr/">ESGI</a></li>
        </ul>
      </section>
      <section class="col-md-1 mx-auto">
        <a href="mailto:mypenpal.contact@gmail.com" target="_blank"><img src="../images/email.png" class="hover_links" width="50px" height="50px" alt="Un problème? Envoyez nous un email!"></a>
        <a href="https://twitter.com/MPenpal?s=09" target="_blank"><img src="../images/twitter.png" class="hover_links" width="50px" height="50px" alt="Rejoignez nous sur twitter!"></a>
        <a href="https://www.facebook.com/MyPenpal-444438409313479/" target="_blank"><img src="../images/facebook.png" class="hover_links" width="50px" height="50px" alt="Rejoignez nous sur Facebook!"></a>
      </section>
      <section class="col-md-2 mx-auto">
        <a href="index.php"> <img src="../images/logo.png" widht="200px" height="200px" alt=""> </a>
      </section>
    </div>
  </div>
</footer>
