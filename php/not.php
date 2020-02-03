
<style>
 #alert_popup
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

<div id="alert_popup">
   <div class="bordure">
     <div class="content">

</div>
</div>
</div>

<script>
setInterval(function(){
load_last_notification();
}, 5000)
;

function load_last_notification()
{
$.ajax({
url:"popup.php",
method:"POST",
success:function(data)
{
 $('.content'). html(data);
}
})
}


</script>
