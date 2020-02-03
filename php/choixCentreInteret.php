<?php session_start();
$date = date("d-m-Y");
$heure = date("H:i");
include('connexionBDD.php');
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Choix centre d'intêret</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/styles2.css">
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon.ico" />
  <script src="../js/jquery.js"></script>
  <script src="../js/centreInteret.js" ></script>
 <style type="text/css">
  .checkbox input[type="checkbox"]{display:none;}
  .checkbox input[type="checkbox"] + label::before{
    content:"";
    display:inline-block;
    width:50px;
    height:20px;
    background:white;
    border-radius:5px;
    border:solid black;
    margin-top: 5px;
    border-width:0.5px;
    position: center;

  }
  .checkbox input[type="checkbox"]:checked + label::before{
    background-color:green;
    padding-top:0.5%;
    padding-bottom:0.5%;
    border:solid;
    border-width:0.5px;
    border-color:black;
    color:white;
    text-align: center;
  }
  .centre {
    width: 13px;
    height: 13px;
    padding: 0;
    margin-top: 5px;
    vertical-align: bottom;
    top: 3px;
    *overflow: hidden;

  }

  label  {

    display: block;
    padding: center;
    text-indent: 15px;
  }

</style>

</head>
<body>
  <?php include('header.php')?>

    <section class="block1 col-md-5" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
      <h2 class="titres"> Centre d'intêret </h2>
    </section>
    <section class="block1" style="border:5px solid #b1d1d0;padding:3%;background:white;border-radius:5px;">
      <div id='container_checkbox'>
        <div class="checkbox_titre">
          <h4> Veuillez choisir au maximum 5 centres d'intêrets parmis ceux proposés. </h4>
        </div>
        <form  action="verifCentre.php" name="centre"  enctype="multipart/form-data" method="post" onsubmit="return VerifCheck(this)">
          <div class ="checkbox">



            <input id="musiquecheck"type="checkbox" name="musique" value="Musique" class"centre" onclick="MusiqueCheck(this)"><label for='musiquecheck'> Musique </label> </input>


            <input id="voyagecheck"type="checkbox" name="voyage" value="Voyage"class"centre" onclick="VoyageCheck(this)"/><label for='voyagecheck'> Voyage </label>


            <input id="nourriturecheck"type="checkbox" name="nourriture" value="Nourriture" class"centre" onclick="NourritureCheck(this)"/><label for='nourriturecheck'> Nourriture </label>


            <input id="sportcheck"type="checkbox" name="sport" value="Sport"class"centre" onclick="SportCheck(this)"/> <label for='sportcheck'> Sport </label>


            <input id="histoirecheck" type="checkbox" name="histoire" class"centre" value="Histoire" onclick="HistoireCheck(this)"/> <label for='histoirecheck'> Histoire </label>


            <input id="languecheck"type="checkbox" name="langues" value="Langues"class"centre" onclick="LanguesCheck(this)"/> <label for='languecheck'> Langue </label>


            <input id="lecturecheck"type="checkbox" name="lectures" value="Lecture" class"centre" onclick="LecturesCheck(this)"/> <label for='lecturecheck'> Lecture </label>


            <input id="culturecheck"type="checkbox" name="culture" value="CultureAsiatique" class"centre" onclick="CultureCheck(this)"/> <label for='culturecheck'> Culture </label>


            <input id="technologiecheck"type="checkbox" name="technologie" value="Technologie" class"centre1" onclick="TechnologieCheck(this)"/> <label for='technologiecheck'> Technologie </label>


            <input id="cinemacheck"type="checkbox" name="cine" value="Cinématographie"class"centre" onclick="CineCheck(this)"/> <label for='cinemacheck'> Cinéma </label>


            <input id="jeuxcheck"type="checkbox" name="jeux" value="JeuxVidéo" class"centre" onclick="JeuxVideoCheck(this)"/> <label for='jeuxcheck'> Jeux Vidéo </label>


            <input id="artcheck"type="checkbox" name="art" value="Art" class"centre" onclick="ArtCheck(this)"/> <label for='artcheck'> Art </label>


            <input id="naturecheck"type="checkbox" name="nature" value="Nature" class"centre" onclick="NatureCheck(this)"/> <label for='naturecheck'> Nature </label>


            <input id="bricolagecheck"type="checkbox" name="bricolage" value="Bricolage"class"centre" onclick="BricolageCheck(this)"/><label for='bricolagecheck'> Bricolage </label>


            <input id="beautecheck"type="checkbox" name="beaute" value="Beauté" class"centre" onclick="BeauteCheck(this)"/><label for='beautecheck'> Beauté </label>

          </div>
          <br>
          <div class="valider">
            <input class="buttons"type ="submit" name="valider" value="valider"/>
          </div>

        </form>
      </div>
    </section>

  <?php include('footer.php')?>
</body>
</html>
