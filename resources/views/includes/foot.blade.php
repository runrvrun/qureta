<!-- SCRIPTS -->
<script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/easing.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/1.8.2.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/ui.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/superfish.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/customM.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/mobilemenu.js') }}"></script>

<!--[if lt IE 9]> <script type="text/javascript" src="js/html5.js"></script> <![endif]-->
<script type="text/javascript" src="{{ URL::asset('js/mypassion.js?v=13') }}"></script>

<script>
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
