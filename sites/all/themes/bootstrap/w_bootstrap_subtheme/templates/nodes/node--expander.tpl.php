<!--Expander / FAQ-->
<?php


/* FAQ Expander Style Formatting */	  
if ($field_styling[0]['value'] == "FAQ"): ?>


	<script type="text/javascript">

		(function ($) {
	      $(document).ready(function() {  
		     $(".faq_item").on("click",function () {
		     	$(this).find(".faq_a").slideToggle(300);
		     	if ($(this).find(".faq_btn").hasClass("expanded")) {
		     		$(this).find(".faq_btn").removeClass("expanded");
		     		$(this).find(".faq_btn").addClass("minimized");
		     	} else {
		     		$(this).find(".faq_btn").removeClass("minimized");
		     		$(this).find(".faq_btn").addClass("expanded");
		     	}
		     	
		     })		
		  });
		}(jQuery));	
	</script>

	<style>
		h3.faq_title {
		    margin-top: 20px;
		    margin-bottom: 10px;
		    clear: both;
		    font-family: 'Adobe Garamond Pro';
		    font-size: 20px;
		    line-height: 24px;
		    font-weight: 400;
		}

		.faqs {
		    margin-bottom: 40px;
		    border-top: 1px solid #000;
		    border-bottom: 1px solid #000;
		}

	   .faq_btn {
		    display: block;
		    width: 30px;
		    height: 30px;
		    margin-right: 12px;
		    padding-left: 1px;
		    float: none;
		    -webkit-box-flex: 0;
		    -webkit-flex: 0 0 auto;
		    -ms-flex: 0 0 auto;
		    flex: 0 0 auto;
		    border: 2px solid #9e9e9e;
		    border-radius: 100px;
		    font-family: Swiss721bt;
		    color: #b1b1b1;
		    font-size: 22px;
		    line-height: 29px;
		    font-weight: 700;
		    text-align: center;
		}

		.faq_btn.minimized {
			transition: transform 500ms;
			transform: rotateX(0deg) rotateY(0deg) rotateZ(0deg);
		}
		.faq_btn.expanded {
			transition: transform 500ms;
    		transform: rotateX(0deg) rotateY(0deg) rotateZ(45deg);
		}
		.faq_q_wrapper {
		    display: -webkit-box;
		    display: -webkit-flex;
		    display: -ms-flexbox;
		    display: flex;
		    padding-top: 8px;
		    padding-bottom: 8px;
		    -webkit-box-align: center;
		    -webkit-align-items: center;
		    -ms-flex-align: center;
		    align-items: center;
		}

		.faq_item {
		    padding: 10px;
		    border-bottom: 1px dashed #8a8a8a;
		}

		.faq_item:last-child {
		    border-bottom: none;
		}

		.faq_q {
		    display: -webkit-box;
		    display: -webkit-flex;
		    display: -ms-flexbox;
		    display: flex;
		    -webkit-box-align: center;
		    -webkit-align-items: center;
		    -ms-flex-align: center;
		    align-items: center;
		    -webkit-box-flex: 1;
		    -webkit-flex: 1;
		    -ms-flex: 1;
		    flex: 1;
		    font-family: Swiss721bt;
		    font-weight: 400;
		}

		.faq_a {		
		    margin-bottom: 10px;
		    margin-left: 41px;
		    font-family: Swiss721bt;
		    font-weight: 300;
		    display: none;
		}


		
    </style>

    <div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h3<?php print $title_attributes; ?> class='faq_title'><?php print $title; ?></h3>
  <?php endif; ?>
  <?php print render($title_suffix); ?>


  <div class="content"<?php print $content_attributes; ?>>



<?php
	$i = 1;
	print "<div class='faqs'>";
	foreach($node->field_text_body['und'] as $expandtext){
		$dom = new DOMDocument();
		$paragraphs = array();
		$dom->loadHTML($expandtext['value']);
		foreach($dom->getElementsByTagName('p') as $node)
		{

		    $paragraphs[] = $dom->saveHTML($node);

		}
		$question = $paragraphs[0];

		$answer = array_slice($paragraphs, 1);
		$answer = implode("\n", $answer);

		$n = $i % 4;
		print "
			<div class='faq_item'>
				<div class='faq_q_wrapper'>
					<div class='faq_btn faq_btn_$n'>+</div>
					<div class='faq_q'>
						$question
					</div>
				</div>
				<div class='faq_a minimized'>
					$answer
				</div>
			</div>";	
		$i++; 
	}

	print "</div>";

/* End of FAQ Expander Style Formatting */

/* other expander formats */
 	else: ?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  <?php endif; ?>
  <?php print render($title_suffix); ?>


  <div class="content"<?php print $content_attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>
  
 	   <script type="text/javascript">
// initialize plugin for Expander (e.g. FAQ more buttons)
	(function ($) {
      $(document).ready(function() {  
	    $('dl.expanderh2 dd').expander({
	      collapseTimer: 0,
		  slicePoint: <?php echo $field_slice_point[0]['value'];?>,
		  widow: <?php echo $field_widow [0]['value'];?>,
		  expandText: '<?php echo $field_expand_button[0]['value'];?>',
		  summaryClass: 'summary',
  		  detailClass: 'detail',
		  expandPrefix: '<?php echo 'trail'.$field_expand_trail[0]['value'];?>',
		  userCollapseText: ' <?php echo $field_collapse_button[0]['value'];?>'/*,
		  expandEffect: 'slideDown',
  		  collapseEffect: 'slideUp'*/
	    });		
	  });
	}(jQuery));
	

	(function ($) {
      $(document).ready(function() {  
	    $('div.expander<?php echo $field_styling[0]['value'];?>').expander({
	 	  collapseTimer: 0,
		  slicePoint: <?php echo $field_slice_point[0]['value'];?>,
		  widow: <?php echo $field_widow [0]['value'];?>,
		  expandText: '<?php echo $field_expand_button[0]['value'];?>',
		  expandPrefix: '<?php echo $field_expand_trail[0]['value'];?>',
		  userCollapseText: ' <?php echo $field_collapse_button[0]['value'];?>'/*,
		  expandEffect: 'slideDown',
  		  collapseEffect: 'slideUp'*/
	    });		
	  });
	}(jQuery));	
	
  </script>
  <?php

		foreach($node->field_text_body['und'] as $expandtext){
			$newtext = $expandtext['value'];

			echo '<div class="expander'.$field_styling[0]['value'].'">';	
			print $newtext;	
			echo '</div>';  
		}
	endif;
	
	?>
    
  </div>




  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>
