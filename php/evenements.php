<?php
session_start();
$month = date('m');
$year = date('Y');

if(!isset($_SESSION['pseudo'])){
  header("Location: connexion.php");
}else{
  include('connexionBDD.php');

?><?php




?>
<!DOCTYPE html>
<html>
 <head>
  <title>Evenements</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


  <script>

  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
   monthNames: ['Janvier','Fevrier','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
    monthNamesShort: ['Jan','Fev','Mar','Avr','Mai','Juin','Juil','Aou','Sep','Oct','Nov','Dec'],
    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
    dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
    },
    firstDay:1,
    events: 'date.php',
    eventLimit: true,
    eventClick:function(event,jsEvent,view){
      document.location.href="eventDetails.php?id="+event.id;
console.log(event.title);
}

  });

});

</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

<link rel="stylesheet" href="../css/styles2.css">
  <link rel="SHORTCUT ICON" href="../images/logo.ico" type="favicon" />
 <title>Evenements</title>
</head>
<body>
  <style media="screen">
  body{
background-color: #C3D7D7;
position: relative;
color : #144745;

}
  </style>
  <?php include('header.php'); ?>
  <?php include('not.php') ?>
  <div id ="main">
  <div class="container" style="text-align: justify;margin-top:2%;">
    <div id="calendar"/>
</div>
    </div>

<?php include('footer.php')?>


</body>
</html>
<?php } ?>
