<center>
<header>
<div class="empstart_header row-fluid">
	<div class="header_up row-fluid">
		<div class="header_logo"></div>
		<div class="visible-desktop">
			<div class="header_link span4">
			<?php 
			$header_link = config_item('header_link');
			if ($header_link && is_array($header_link))
			{
				$first = true;
				foreach ($header_link as $val)
				{
					if ($first)
						$first = false;
					else 
						echo ' | ';
					echo $val;
				}
			}
			?>
			</div>
			<div class="header_link span2">
			<?php 
			$header_sign_link = config_item('header_sign_link');
			if ($header_sign_link && is_array($header_sign_link))
			{
				$first = true;
				foreach ($header_sign_link as $val)
				{
					if ($first)
						$first = false;
					else 
						echo ' | ';
					echo $val;
				}
			}
			?>
			</div>
			<div class="header_image"><img class="header_mark" src="<?php echo config_item('image_url')?>header_mark.png"></div>
		</div>
	</div>
	
	<div class="header_down row-fluid">
		<div class="span2"></div>
		<div class="span2"></div>
		<div class="emp_welcome span4">
			<h1><?php echo $welcome;?>&nbsp;&nbsp;&nbsp;<span><?php echo $first_name.' '.$surname;?></span></h1>
			<hr>
			<span>You are about to record a videointerview as a pre-request for an available position.</span>
		</div>
		
		<div class="span2"></div>
		
		<!--///////////////////////////////Translate///////////////////////////////////////-->		
		<div id="google_translate_element" class="span2"></div>
		<!--///////////////////////////////Translate///////////////////////////////////////-->
		
	</div>
	
	
</div>
</header>


<div class="empstart_contents row-fluid"><!--   ******************************* Employee Start contents ******************************************-->

	<!-- <div class="empstart_left_space span2"></div> -->
	<div class="empstart_contents span8 offset2">	
		<section>
			<div class="row-fluid">
				<h3>How it works</h3>
			</div>
		</section>
		
		<section>
			<div class="span3"><a><img src="<?php echo config_item('image_url')?>emp_btn_1.png"></img></a></div>
			<div class="span3"><a><img src="<?php echo config_item('image_url')?>emp_btn_2.png"></img></a></div>
			<div class="span3"><a><img src="<?php echo config_item('image_url')?>emp_btn_3.png"></img></a></div>
			<div class="span3"><a><img src="<?php echo config_item('image_url')?>emp_btn_4.png"></img></a></div>
		</section>
		
		<section>
	<!--	<a href="site_url + 'employee/recording'" data-role="button">Start now</a>	-->
			<button class="empstart_button btn btn-primary" type="button" onclick="take_photo()">
			<b>Start now</b></button><hr>
		</section>	
	</div>
	<!-- <div class="empstart_right_space span2"></div> -->
</div>

<footer>

</footer>

</center>

<script language="javascript">

	function take_photo() {
		
		location.href ="<?php echo site_url();?>employee/welcome_interview";
	}

</script>
<script language="javascript">
//alert("sdfsd");
//$(document).ready(function() {
//	$('.goog-te-gadget').click(function(e) {
//		alert("sfsds");
//		alert($(".goog-te-gadget:contains('powered')").text());
//		//$('.goog-te-gadget').find(":contains('powered')").css({"font-style":"italic", "font-weight":"bolder"});
//		//$('.goog-te-gadget').text().split(" ").join("</span> <span>").find(":contains('owered')").css({"font-style":"italic", "font-weight":"bolder"});
//		//var newText = $("p").text().split(" ").join("</span> <span>");
//		//newText = "<span>" + newText + "</span>";
//		//
//		//$("p").html( newText )
//		//  .find('span')
//		//  .hover(function() { 
//		//    $(this).addClass("hilite"); 
//		//  },
//		//    function() { $(this).removeClass("hilite"); 
//		//  })
//		//.end()
//		//  .find(":contains('t')")
//		//  .css({"font-style":"italic", "font-weight":"bolder"});
//	});
//}

</script>