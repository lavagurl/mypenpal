//-------------Fonction surligne ------------

function surligne(champ, erreur)
{
   if(erreur)
     champ.style.border = "3px solid #d6486e";
  // champ.style.backgroundColor = "#d18478";
  else
   //champ.style.backgroundColor = "#03D201r";
    champ.style.border ="2px solid #03D201r";
}

// ----------Verification pseudo------------

function verifPseudo(champ)
{
   if(champ.value.length < 2 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
 {
  surligne(champ, false);
      return true;
   }
}

//-------------Verification mot de passe -----------
function verifMdp(champ)
{
   if(champ.value.length < 6 || champ.value.length > 25)
   {
      surligne(champ, true);
      return false;
   }
   else
 {
  surligne(champ, false);
      return true;
   }
}

function verifMdp2(champ)
{
  var n1 = document.inscription.mdp;
  var n2 = document.inscription.conf_mdp;

  if (n1.value == n2.value){

  surligne(champ, false);
  return true;
  }
  else{
  surligne(champ, true);
  return false;
}
}

// -------------- Verification email ------------
function verifMail(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
    surligne(champ, false);
      return true;
   }
}

function verifMail2(champ)
{
  var n1 = document.inscription.email;
  var n2 = document.inscription.conf_email;

  if (n1.value == n2.value){

  surligne(champ, false);
  return true;
  }
  else{
  surligne(champ, true);
  return false;
}
}

//---------------Verification checkbox--------------

function verifBox (champ)
{
  if (document.inscription.condition.checked==false){
    alert("Veuillez accepter les conditions");
    return false;
  }
  else{
      return true;
  }
  }

//-------------Verification pays------------------

function verifCountry(champ)
{
  var c1 = document.inscription.country;
  if( c1.value==""){
    surligne (champ,true);
    return false;
  }
  else{
    surligne(champ,false);
    return true;
  }

}

//------------------Verification Date Naissance ------------





//--------------- Verification total ------------

function verifForm(f)
{
   var pseudoOk = verifPseudo(f.pseudo);
   var mailOk = verifMail(f.email);
   var mail2Ok = verifMail2(f.conf_email);
   var mdpOk = verifMdp(f.conf_mdp);
   var mdp2Ok = verifMdp2(f.mdp);
   var checkOk = verifBox(f.condition);
   var countryOk = verifCountry(f.country);



   if(countryOk == true && checkOk == true && pseudoOk == true && mailOk == true && mail2Ok == true && mdpOk == true && mdp2Ok == true)
      return true;
   else
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
}

//------------- Redirection vers page d'acceuil après s'être enregistré---------


/*function redirect(){
var redirect = "../php/Acceuil.php";
document.location.href(redirect);


}*/
