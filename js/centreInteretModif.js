//------------------Création de la variable de comptage des checkbox---------





//var nbCheck = document.getElementsByTagName('input').checked ;

var nbCheck = 0;
console.log(nbCheck);
//-------------------- Verification des checkbox -----------------//

function MusiqueCheck()
{

  if (document.centre.musique.checked==true){
    nbCheck +=1;
    console.log(nbCheck);
  }
  else{
    //  nbCheck -=1 ;
    console.log(nbCheck);
  }
}

function VoyageCheck()
{
  if (document.centre.voyage.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //nbCheck -= 1;
    console.log(nbCheck);
  }
}
function NourritureCheck()
{
  if (document.centre.nourriture.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //nbCheck -= 1;
    console.log(nbCheck);
  }
}
function SportCheck()
{
  if (document.centre.sport.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //  nbCheck -= 1;
    console.log(nbCheck);
  }
}
function HistoireCheck()
{
  if (document.centre.histoire.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //  nbCheck -=1;
    console.log(nbCheck);
  }
}
function LanguesCheck()
{
  if (document.centre.langues.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{

    //  nbCheck -= 1;
    console.log(nbCheck);
  }
}
function LecturesCheck()
{
  if (document.centre.lectures.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    ///  nbCheck -= 1;
    console.log(nbCheck);
  }
}
function CultureCheck()
{
  if (document.centre.culture.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //  nbCheck -= 1;
    console.log(nbCheck);
  }
}
function TechnologieCheck()
{
  if (document.centre.technologie.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //  nbCheck -= 1;
    console.log(nbCheck);
  }
}
function CineCheck()
{
  if (document.centre.cine.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //  nbCheck -= 1;
    console.log(nbCheck);
  }
}
function JeuxVideoCheck()
{
  if (document.centre.jeux.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //nbCheck -= 1;
    console.log(nbCheck);
  }
}
function ArtCheck()
{
  if (document.centre.art.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //  nbCheck -= 1;
    console.log(nbCheck);
  }
}
function NatureCheck()
{
  if (document.centre.nature.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //    nbCheck -= 1;
    console.log(nbCheck);
  }
}
function BricolageCheck()
{
  if (document.centre.bricolage.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //  nbCheck -= 1;
    console.log(nbCheck);
  }
}
function BeauteCheck()
{
  if (document.centre.beaute.checked==true){
    nbCheck +=1;
    console.log(nbCheck);

  }
  else{
    //  nbCheck -= 1;
    console.log(nbCheck);
  }
}

//------------- Fonction de verification 0 > checkbox < 5 --------------//

function VerifCheck ()
{
  if ( nbCheck < 0  || 15 < nbCheck  ) {

    console.log(nbCheck);
    alert("Veuillez chosir entre 1 et 5 centres d'intêrets");
    return false;

  } else{

    return true ;

  }
}
