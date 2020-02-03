/*
function button(){
var i=document.getElement
var request = new XMLHttpRequest();
request.onreadystatechange = function() {
  if(request.readyState == 4) {
    var notifs = document.getElementById('notifs');
    notifs.innerHTML = request.responseText;
  }
};
request.open('GET','getNotif.php?offset='+i+'&limit=10');
request.send();

}*/

$(document).ready(function(){
  var off=0;
  $.ajax({
    type:"GET",
    url:"getNotif.php",
   data:{
      'offset':0,
      'limit':10
    },
    success:
    function(data){
      console.log(" jalk");
      $('body').append(data);
      off=off+10;
  }
  });

$("#button").click(function () {
$.ajax({
  type:"GET",
  url:"getNotif.php",
 data:{
    'offset': off,
    'limit':10
  },
  success:
  function(data){
    console.log("chala");
    $('body').append(data);
    off=off+10;
}
});


});
});
