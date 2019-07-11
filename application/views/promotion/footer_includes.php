<script src="<?php echo base_url();?>js/jquery.singlePageNav.min.js"></script>
        <script>

            // Prevent console.log from generating errors in IE for the purposes of the demo
            if ( ! window.console ) console = { log: function(){} };

            // The actual plugin
            $('.single-page-nav').singlePageNav({
                offset: $('.single-page-nav').outerHeight(),
                filter: ':not(.external)',
                updateHash: true,
                beforeStart: function() {
                    console.log('begin scrolling');
                },
                onComplete: function() {
                    console.log('done scrolling');
                }
            });
        </script>
 <script type="text/javascript" src="<?php echo base_url();?>js/jquery-confirm.min.js"></script>
<!--<script type="text/javascript">
	$('.apple_alert').on('click', function () {
		$.alert({
			title: 'Download App!',
			content: 'App will coming soon!',
			confirm: function () {
			}		});
	});
</script>-->

<script type="text/javascript" src="<?php echo base_url();?>js/jquery.smartmenus.js"></script>
<script type="text/javascript">
$(function() {
$('#main-menu').smartmenus({
subMenusSubOffsetX: 1,
subMenusSubOffsetY: -8
});
});
</script>
<link href="<?php echo base_url();?>css/sm-core-css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>css/sm-blue.css" rel="stylesheet" type="text/css" />
<!--menu-->

<script type="text/javascript">
var navigation1 = responsiveNav(".nav-1");
</script>
<?php //include('info_links.php')?>