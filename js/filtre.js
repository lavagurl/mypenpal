function filtre(){
  var position=document.getElementById("position");
//  console.log(position);
  var room=document.getElementById("room");
  var price=document.getElementById("price");
  var type=document.getElementById("type");
  var hotels= document.getElementById("hotels").children;

    for (var i = 0; i < hotels.length; i++){
      console.log(room.value);
      console.log(hotels[i].getAttribute('room'));
      if (hotels[i].getAttribute('type') == type.value  || type.value == "0"){
        if(hotels[i].getAttribute('room') == room.value || room.value == "0"){
          if(hotels[i].getAttribute('price') == price.value  || price.value == "0"){
            if(hotels[i].getAttribute('position') == position.value || position.value == "0"){
              hotels[i].style.display = "block";

            }else{
              hotels[i].style.display = "none";
            }
          }else{
            hotels[i].style.display = "none";
          }
        }else{
          hotels[i].style.display = "none";
        }
      }else{
        hotels[i].style.display = "none";
      }
    }


}
