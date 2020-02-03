function verificationErreur(){
  console.log("salut");
  var recherche = document.getElementById('search');
  if(checkEmpty(recherche.value)==false){
    recherche.style.borderColor='red';
    var error=document.createElement('p');
    error.style.color='red';
    error.innerHTML='Veuillez saisir un mot clé';
    recherche.parentNode.appendChild(error);
      return false;
    }
  return true;
}
  function checkEmpty(recherche){
    return recherche.length>0;
  }
