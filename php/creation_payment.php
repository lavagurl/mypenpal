<?php
//buyer-mypenpal1@gmail.com -- mypenpal
//mypenpal.paypal-facilitator@gmail.com -- oceane012

//-----------API-------------//
// NOM UTILISATEUR : mypenpal.paypal-facilitator_api1.gmail.com
// MDP API : P9D4XK3X69CMTFJY
// SIGNATURE : AzqEpAKkhcmgc3CUqxIVYyi33a6KA5DqITRTdOhE69-Xmk9IgKJwJoBb

//------------SANDBOX API CREDENTIALS-------------//
// CLIENT ID : Af7WutqphFBzC3lqLq7LNJxjrD9k4fnbPyV1O0xIu4bGE5IWxSZZzpsNLrRlBtsN3oquW2dlCwNh7pWJ
// SECRET : EEZ8zywB0uz2ltxfcLXJIr_pr0lTKtgNnqvOLoUnEMYgam7Uzpo1qfj_tt88QFFZpUxabA_UiWp4Zjvo

require_once "connexionBDD.php";
require_once "config_session_paypal.php";
require_once "payPalPayment.php";

$success = 0;
$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
$paypal_response = [];

$payer = new PayPalPayment();
$payer->setSandboxMode(1);
$payer->setClientID("Af7WutqphFBzC3lqLq7LNJxjrD9k4fnbPyV1O0xIu4bGE5IWxSZZzpsNLrRlBtsN3oquW2dlCwNh7pWJ");
$payer->setSecret("EEZ8zywB0uz2ltxfcLXJIr_pr0lTKtgNnqvOLoUnEMYgam7Uzpo1qfj_tt88QFFZpUxabA_UiWp4Zjvo");

$payment_data = [
   "intent" => "sale",
   "redirect_urls" => [
      "return_url" => "http://mypenpal.freeboxos.fr/php/pageProfil.php",
			//"http://localhost/MyPenpal/MyPenpal/php/pageProfil.php",
      "cancel_url" => "http://mypenpal.freeboxos.fr/php/premium.php"
		//	"http://localhost/MyPenpal/MyPenpal/php/premium.php"
   ],
   "payer" => [
      "payment_method" => "paypal"
   ],
   "transactions" => [
      [
         "amount" => [
            "total" => "5.00",
            "currency" => "EUR"
         ],
         "item_list" => [
            "items" => [
               [
                  "sku" => "1PK5Z9",
                  "quantity" => "1",
                  "name" => "Premium MyPenpal",
                  "price" => "5.00",
                  "currency" => "EUR"
               ]
            ]
         ],
         "description" => "Création d'un compte premium sur le site MyPenpal.com"
      ]
   ]
];

$paypal_response = $payer->createPayment($payment_data);
$paypal_response = json_decode($paypal_response);

if (!empty($paypal_response->id)) {
   $insert = $bdd->prepare("INSERT INTO paiements (payment_id, payment_status, payment_amount, payment_currency, payment_date, payer_email) VALUES (:payment_id, :payment_status, :payment_amount, :payment_currency, NOW(), NULL)");

   $insert_ok = $insert->execute(array(
         "payment_id" => $paypal_response->id,
         "payment_status" => $paypal_response->state,
         "payment_amount" => $paypal_response->transactions[0]->amount->total,
         "payment_currency" => $paypal_response->transactions[0]->amount->currency,
      ));

   if ($insert_ok) {
      $success = 1;
      $msg = "";
			$premium = 1 ;
			$insertmbr = $bdd->prepare("UPDATE member SET premium= ? WHERE name='{$_SESSION['pseudo']}' ");
			$insertmbr ->execute(array
			($premium));
   }
} else {
   $msg = "Une erreur est survenue durant la communication avec les serveurs de PayPal. Merci de bien vouloir réessayer ultérieurement.";
}

echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response]);
