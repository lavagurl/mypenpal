<?php
session_start();
//require_once "config_session_paypal.php";
include('connexionBDD.php');?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
 <link rel="stylesheet" href="../css/styles2.css">
  <script src="https://www.paypalobjects.com/api/checkout.js"></script>
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
  <title>premium</title>
</head>
<body>

  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js%22%3E"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js%22%3E"></script>-->
  <?php include('header.php')?>


  <div class="container" style="text-align: justify;margin-top:2%;">
    <section class="sectionTitres">
    <h1  style="text-align:center;border:5px solid #b1d1d0;padding:2px;background:white;border-radius:5px;"> Premium </h1>
    </section>

    <section class="block1" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;text-align:center;">
      <h4> Passage de votre compte prémium pour un montant de 5€ voici les avantages proposés : <br>
        - Réduction sur les prix des locations. <br>
        - Modification possible des centres d'intérêts sans limite de nombre.<br>
      </h4> <br>

      <div id="bouton-paypal"></div>
    </section>


    <script>
    paypal.Button.render({
      env: 'sandbox', // Ou 'production',
      commit: true, // Affiche le bouton  "Payer maintenant"
      style: {
        color: 'silver', // ou 'blue', 'silver', 'black'
        size: 'responsive', // ou 'responsive', 'medium', 'large'
        label:'paypal'
        // Autres options de style disponibles ici : https://developer.paypal.com/docs/integration/direct/express-checkout/integration-jsv4/customize-button/
      },
      payment: function() {
        // On crée une variable contenant le chemin vers notre script PHP côté serveur qui se chargera de créer le paiement
        var CREATE_URL = 'http://mypenpal.freeboxos.fr/php/creation_payment.php';
      //  "http://localhost/MyPenpal/MyPenpal/php/creation_payment.php";
        // On exécute notre requête pour créer le paiement
        return paypal.request.post(CREATE_URL)
        .then(function(data) { // Notre script PHP renvoie un certain nombre d'informations en JSON (vous savez, grâce à notre echo json_encode(...) dans notre script PHP !) qui seront récupérées ici dans la variable "data"
        console.log(data);
        if (data.success) { // Si success est vrai (<=> 1), on peut renvoyer l'id du paiement généré par PayPal et stocké dans notre data.paypal_reponse (notre script en aura besoin pour poursuivre le processus de paiement)
        return data.paypal_response.id;
      } else { // Sinon, il y a eu une erreur quelque part. On affiche donc à l'utilisateur notre message d'erreur généré côté serveur et passé dans le paramètre data.msg, puis on retourne false, ce qui aura pour conséquence de stopper net le processus de paiement.
      alert(data.msg);
      return false;
    }
  });
},
onAuthorize: function(data, actions) {
  // On indique le chemin vers notre script PHP qui se chargera d'exécuter le paiement (appelé après approbation de l'utilisateur côté client).
  var EXECUTE_URL = 'http://mypenpal.freeboxos.fr/php/execution_payment.php';
    //"http://localhost/MyPenpal/MyPenpal/php/execution_payment.php";
  // On met en place les données à envoyer à notre script côté serveur
  // Ici, c'est PayPal qui se charge de remplir le paramètre data avec les informations importantes :
  // - paymentID est l'id du paiement que nous avions précédemment demandé à PayPal de générer (côté serveur) et que nous avions ensuite retourné dans notre fonction "payment"
  // - payerID est l'id PayPal de notre client
  // Ce couple de données nous permettra, une fois envoyé côté serveur, d'exécuter effectivement le paiement (et donc de recevoir le montant du paiement sur notre compte PayPal).
  // Attention : ces données étant fournies par PayPal, leur nom ne peut pas être modifié ("paymentID" et "payerID").
  var data = {
    paymentID: data.paymentID,
    payerID: data.payerID
  };
  // On envoie la requête à notre script côté serveur
  return paypal.request.post(EXECUTE_URL, data)
  .then(function (data) { // Notre script renverra une réponse (du JSON), à nouveau stockée dans le paramètre "data"
  console.log(data);
  if (data.success) { // Si le paiement a bien été validé, on peut par exemple rediriger l'utilisateur vers une nouvelle page, ou encore lui afficher un message indiquant que son paiement a bien été pris en compte, etc.
  window.location.replace("http://mypenpal.freeboxos.fr/php/pageProfil.php");
//  window.location.replace("http://localhost/MyPenpal/MyPenpal/php/pageProfil.php");
  alert("Paiement approuvé ! Merci !");
} else {
  // Sinon, si "success" n'est pas vrai, cela signifie que l'exécution du paiement a échoué. On peut donc afficher notre message d'erreur créé côté serveur et stocké dans "data.msg".
  alert(data.msg);
}
});
},
onCancel: function(data, actions) {
  alert("Paiement annulé : vous avez fermé la fenêtre de paiement.");
},
onError: function(err) {
  alert("Paiement annulé : une erreur est survenue. Merci de bien vouloir réessayer ultérieurement.");
}
}, '#bouton-paypal');
</script>

</div>
    <?php include('footer.php')?>
</body>
</html>
