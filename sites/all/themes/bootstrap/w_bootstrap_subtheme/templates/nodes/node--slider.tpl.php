<style>
	.wellesley-slider {
		height:250px;
		overflow:hidden;
		/*padding-top: 20px;*/
	}
	.wellesley-nav {
		font-size:32px;
		text-align:center;
		/*margin:21px 0 0;*/
		padding-bottom: 15px;
		/*padding-top: 15px;*/
	}
	.wellesley-nav a {
		color:#d0cfcf !important;
		text-decoration:none;
		margin:0 4px 0 5px;
	}
	.wellesley-nav a.active, .wellesley-nav a:hover {
		color:#024a92 !important;
		text-decoration:none;
	}
	.slider-calendar {
		margin:0 0 0 8px;
	}
	.caption {
		position:absolute;
		display:none;
		color:#fff;
		bottom:0;
		padding:5px 12px;
		font-size:11px;
	}
	.caption.with-calendar {
		font-size:18px;
		line-height:18px;
		padding:10px 12px;
	}
	.caption.with-calendar span {
		padding:0 26px 0 0;
		background:url("/sites/all/misc/calendar_hover.png")  right 6px no-repeat;
		background:url("/sites/all/sites/all/sites/all/sites/all/sites/all/misc/calendar.png")  right 6px no-repeat;
	}
	#maincontent .img:hover .caption.with-calendar span.with-link {
		background:url("/sites/all/misc/calendar_hover.png")  right 6px no-repeat;
	}
	#maincontent .caption a {
		font-weight:normal;
		color:#fff;
	}
	#maincontent .img:hover a  {
		color:#00aeea !important;
	}
	.current.with-link img {
		cursor:pointer;
	}
	.slider-wrapper .caption a:hover {
		color: #009df5;
	}
	.slider-wrapper .caption a:visited {
		color: #fff;
	}
	
	.slider-wrapper .caption a:hover {
		color: #009df5;
	}

</style>
<?php 
// empty h2 to get the vertical align correct 
?>
<h2></h2>
<div class="wellesley-slider">
  <?php
	foreach($node->field_slider['und'] as $image){
		$width = round($image['width'] * 250 / $image['height']);
		//$ilink = $image['alt'];
		$ialt = $image['alt'];
		$ititle = $image['title'];

		print '<div class="img'.($ilink?' with-link':'').'" style="position:relative; height:250px">'.theme_image_style(array('style_name' => 'slider', 'path' => $image['uri'], 'width'=>$width, 'height' => 250,'alt' => $ialt));

		if($ititle){
			$calendar = strpos($ititle, '#')>-1;

			$ititle = str_replace('#','', $ititle);

			print '<div class="caption'.($calendar?' with-calendar':'').'" style="background:url(/sites/all/misc/opacity.png); width:'.($width-24).'px"><span'.($ilink?' class="with-link"':'').'>'.($ilink?l($ititle, $ilink, array('html'=>true)):$ititle);
			print '</span></div>';
		} elseif($ilink){
			print '<div style="display:none">'.l('link', $ilink).'</div>';
		}
		print '</div>';
	}

	?>
</div>
<div class="wellesley-nav hidden-xs hidden-sm">
</div>
<?php
if(node_access("update",$node)){
	print l("edit slider","node/".$node->nid.'/edit');
}
?>
<script type="text/javascript" src="/sites/all/themes/bootstrap/w_bootstrap_subtheme/js/slider.js"></script>