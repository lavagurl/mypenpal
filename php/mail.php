
  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/styles2.css">
    <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon.ico" />
  
    <title>Nous contacter</title>
  </head>

  <body>

    <?php include('header.php')?>
      
      <div class="container" style="text-align: justify;margin-top:2%;" >
        <center>
          <section class="block1 col-md-7" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
            <h1>Nous contacter</h1>
          </section>

      </br></br>
      <div class="block1 col-md-6" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
        <h4>VEUILLEZ REMPLIR TOUS LES CHAMPS </h4>
        <form action="mail_contact.php" method="post">
          Votre nom: <input type="text" name="name" placeholder="Votre nom"/><br>
          Votre mail: <br><span id="erreur3"></span><br><input type="text" name="email" placeholder="Votre mail" onblur="verifMail(this)"/><br><br>
          <textarea name="message" cols="30" rows="5" placeholder="Votre message"></textarea></br>
          <input class="btn btn-info a_hover2" style="color:white;" type="submit" value="Envoyer"/>
        </form>
      </div>
      </center>
    </div>
    <?php include('footer.php')?>
</body>
  </html>

<script type="text/javascript">
function verifMail(champ)
{
  var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
  if(!regex.test(champ.value))
  {

      document.getElementById("erreur3").innerHTML ='Veuillez entrer une adresse mail valide';
    return false;
  }
  else
  {
      document.getElementById("erreur3").innerHTML ='';
    return true;
  }
}

function verifForm(f)
{

  var mailOk = verifMail(f.email);



  if( mailOk == true)
  return true;
  else
  {
    alert("Veuillez remplir correctement tous les champs");
    return false;
  }
}

</script>


