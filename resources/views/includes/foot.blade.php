<!-- SCRIPTS -->
<script type="text/javascript" src="{{ URL::asset('js/easing.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/1.8.2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/ui.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/superfish.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/customM.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/mobilemenu.js') }}"></script>

<!--[if lt IE 9]> <script type="text/javascript" src="js/html5.js"></script> <![endif]-->
<script type="text/javascript" src="{{ URL::asset('js/mypassion.js?v=13') }}"></script>

<script>
function avaError(image){image.onerror="";image.src="/uploads/avatar/noavatar.jpg";return true;}
/* dropdown menu */
$("#notifbtn").click(function(e) {
    $("#notifdropdown").toggle();
    $("#userdropdown").hide();
    e.stopPropagation();
});
$("#userbtn").click(function(e) {
    $("#userdropdown").toggle();
    $("#notifdropdown").hide();
    e.stopPropagation();
});
$(document.body).click( function(e) {
    $('.dropdown-content').hide();
});
</script>
<!-- mobile menu animation -->
<script type="text/javascript">
function sidebar(){
  $('#sidebar-mobile').removeClass('animate-sidebar-back');
  $('#sidebar-overlay').removeClass('overlay-deactive');
  $('#sidebar-mobile').addClass('animate-sidebar');
  $('#sidebar-overlay').addClass('overlay-active');
  $('#sidebar-mobile').css('width', '78vw');
}
function sidebarBack(){
  $('#sidebar-mobile').removeClass('animate-sidebar');
  $('#sidebar-overlay').removeClass('overlay-active');
  $('#sidebar-overlay').addClass('overlay-deactive');
  $('#sidebar-mobile').addClass('animate-sidebar-back');
  $('#sidebar-mobile').css('width', '0');
  setTimeout(function() {
    $('#sidebar-overlay').removeClass('overlay-deactive');
  }, 260);
}
$( ".collapsed" ).click(function() {
  $(this.getAttribute('data-target')).toggle(function() {
    // Animation complete.
  });
});
</script>
