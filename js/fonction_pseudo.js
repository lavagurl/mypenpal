$(document).ready(function(){


  $('#pseudo').keyup(function(e){
    e.preventDefault();
    var pseudo = $("#pseudo").val();


    if(pseudo!="")
    {

      $.post('verifpseudo.php',{pseudo:pseudo},function(data)
      {
        if (data == "Pseudo indisponible"){
          $('.message').text(data).addClass('busy');
        }else {
          $('.message').text(data).addClass('dispo');
        }

      }
    );
  }else {
    $(".message").text("Veuillez saisir un pseudo").addClass('messagebox');
  }});

});
