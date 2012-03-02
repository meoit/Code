<?php
if (!defined('VALIDREQUEST')) die ('Access Denied.');
function plugin_highslide_firstheader ($str) {
$str.=<<<eot
<link rel="stylesheet" type="text/css" href="plugin/highslide/highslide.css" />
<script type="text/javascript" src="plugin/highslide/highslide.js"></script>
<script type="text/javascript">
	hs.graphicsDir = 'plugin/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.wrapperClassName = 'dark borderless floating-caption';
	hs.fadeInOut = true;
	hs.dimmingOpacity = .75;
	
	if (hs.addSlideshow) hs.addSlideshow({
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: .6,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
</script>
eot;
	return $str;
}

?>