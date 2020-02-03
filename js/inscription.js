//-------------Fonction surligne ------------

function surligne(champ, erreur)
{
  if(erreur)
  champ.style.border = "3px solid #d6486e";
  // champ.style.backgroundColor = "#d18478";
  else
  // champ.style.backgroundColor = "#03D201r";
  champ.style.border ="2px solid green";

}



// ----------Verification pseudo------------

function verifPseudo(champ)
{
  var regex = new RegExp("^[a-zA-Z0-9]{5,25}$","g");
  if(!regex.test(champ.value))
  {
    surligne(champ, true);
    document.getElementById("erreur").innerHTML ='Votre pseudo doit contenir entre 5 et 25 caractère sans caractère spéciaux !';
    return false;

  }
  else
  {
    surligne(champ, false);
    document.getElementById("erreur").innerHTML ='';
    return true;


  }
}




//-------------Verification mot de passe -----------
function verifMdp(champ)
{
  var regex = new RegExp("^[a-zA-Z0-9]{6,25}$","g");
  if(!regex.test(champ.value))
  {
    surligne(champ, true);
    document.getElementById("erreur2").innerHTML ='Votre mot de passe doit contenir entre 6 et 25 caractère sans caractère spéciaux !';
    return false;

  }
  else
  {
    surligne(champ, false);
    champ.style.border ="3px solid #03D201r";
    document.getElementById("erreur2").innerHTML ='';
    return true;
  }
}

function verifMdp2(champ)
{
  var n1 = document.inscription.mdp;
  var n2 = document.inscription.conf_mdp;

  if (n1.value == n2.value){

    surligne(champ, false);
  document.getElementById("erreur2").innerHTML ='';
    return true;
  }
  else{
    surligne(champ, true);
      document.getElementById("erreur2").innerHTML ='Votre mot de passe doit être identique!';
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
      document.getElementById("erreur3").innerHTML ='Veuillez entrer une adresse mail valide';
    return false;
  }
  else
  {
    surligne(champ, false);
      document.getElementById("erreur3").innerHTML ='';
    return true;
  }
}

function verifMail2(champ)
{
  var n1 = document.inscription.email;
  var n2 = document.inscription.conf_email;

  if (n1.value == n2.value){

    surligne(champ, false);
      document.getElementById("erreur3").innerHTML ='';
    return true;
  }
  else{
    surligne(champ, true);
      document.getElementById("erreur3").innerHTML ='Votre adresse mail doit être identique';
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



//------------------Verification Date Naissance ------------

function verifBirth(champ)
{
  var c1 = document.inscription.dateNaissance;
  if( c1.value==""){
    surligne (champ,true);
        document.getElementById("erreur4").innerHTML ='Veuillez entrer une date de naissance';
    return false;
  }
  else{
    surligne(champ,false);
        document.getElementById("erreur4").innerHTML ='';
    return true;
  }

}



//--------------- Verification total ------------

function verifForm(f)
{
  var pseudoOk = verifPseudo(f.pseudo);
  var mailOk = verifMail(f.email);
  var mail2Ok = verifMail2(f.conf_email);
  var mdpOk = verifMdp(f.conf_mdp);
  var mdp2Ok = verifMdp2(f.mdp);
  var checkOk = verifBox(f.condition);
  var birthOk = verifBirth(f.dateNaissance);


  if(birthOk == true && checkOk == true && pseudoOk == true && mailOk == true && mail2Ok == true && mdpOk == true && mdp2Ok == true)
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



//-------------------- Fonction pseudo identique ---------------
/*$(document).ready(function(){

  $('#pseudo').keyup(function(){

    var pseudo = $("#pseudo").val();

      if(pseudo!="")
      {

        $.post('verifInscription.php'{pseudo:pseudo},function(data){

            $('.message').text(data);


        });
      }
  });
});
*/
