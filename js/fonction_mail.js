

$(document).ready(function(){


  $('#email').keyup(function(e){
    e.preventDefault();
    var email = $("#email").val();


    if(email!="")
    {

      $.post('verifmail.php',{email:email},function(data)
      {
        if (data == "Votre email a déjà été utilisé"){
          $('.message1').text(data).addClass('busy');
  
        }else {
          $('.message1').text(data).addClass('dispo');
        }

      }
    );
  }else {
    $(".message1").text("Veuillez saisir un mail").addClass('messagebox');
  }});

});
