
<style>
 #alert_msg
   {
    display:block;
    position:fixed;
    bottom:50px;
    left:50px;
   }
   .bordure {
     display: table-cell;
     vertical-align: bottom;
     height: auto;
     width:400px;
   }
</style>

<div id="alert_msg">
   <div class="bordure">
     <div class="content">

</div>
</div>
</div>

<script>

setInterval(function(){
load_last_notification_msg();
}, 5000)
;


function load_last_notification_msg()
{
$.ajax({
url:"popup_msg.php",
method:"POST",
success:function(data)
{
 $('.content'). html(data);
}
})
}

</script>
