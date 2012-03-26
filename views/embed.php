<?php

	require_once("config.php");

	if (isset($_GET["c"])){

		//Retreives the chart id
		$chart_text_id = $_GET["c"];

		$chart_id = alphaID($chart_text_id, true);

		$chart = new Chart($mysqli);

		$chart->setID($chart_id);

		$chart->refreshData();

		//Sets the appropriate language
		setLanguage($chart->lang);

		?>


	<!DOCTYPE html>
	<html>
	    <head>

	        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

	        <title><?php echo _("Chart created with Datawrapper") ?></title>

	        <!-- General styles -->
	        <link rel="stylesheet" type="text/css" href="css/stylesheets/general.css" />

	        <!-- Specific embed styles -->
	        <link rel="stylesheet" type="text/css" href="css/stylesheets/embed.css" />

	        <!-- JQuery library -->
	        <script src="js/jquery-1.6.4.js" type="text/javascript"></script>

	        <!-- JQueryUI library -->
	        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>     

	        <!-- Notifications library -->
	        <script src="js/notifications/js/notification.js" type="text/javascript"></script>  

	        <!-- Notifications CSS -->
	        <link href="js/notifications/main.css" rel="stylesheet" type="text/css" media="screen">

	        <?php
	         /* Adds the JS files for the vis libs */

			//Fetches the JSON that holds the data about the visualisations
			require_once('visualizations/config.json.php');

			//Convert file into JSON
			$json_vis=json_decode($file_vis);

			
			//Loop through the libs  in the JSON
			foreach($json_vis->librairies as $librairy){

				//Loop throught the dependancies array
				foreach($librairy->dependancies as $dependancy){

					//Adds the lib
					echo '<script src="visualizations/'. $dependancy .'" type="text/javascript"></script>';

				}
			}

			?>
			<script src="js/functions.js" type="text/javascript"></script>

	    </head>


    	<body>
			<script type="text/javascript">

			function test_fullscreen(){
				 if(window.frameElement == null){
				 	$("#fullscreen").hide();
				 }
			}

			function fullscreen(){

				//stores init chart h & w values
				window.chart_init_h = $("#chart").height();
				window.chart_init_w = $("#chart").width();
				window.chart_init_color = $("#chart").css("background-color");

				var fullscreen_el = document.getElementById('chart');

			    if(fullscreen_el.webkitRequestFullScreen) {
			        fullscreen_el.webkitRequestFullScreen();
			    }
			    else {
			        fullscreen_el.mozRequestFullScreen();
			    }
			}

			function resize() {
			    $("#chart").width("100%");
			    $("#chart").height("100%");
			}

			function on_fullscreen_change() {
			    if(document.mozFullScreen || document.webkitIsFullScreen) {
			        resize();
			        $("#chart").css("background-color", "#fff");
			    }
			    else {
			        $("#chart").width(window.chart_init_w);
			        $("#chart").height(window.chart_init_h);
			        $("#chart").css("background-color", window.chart_init_color);
			    }

			    makechart();
			}

			function makechart(){

				<?php if ($chart->desc != ""): ?>
					//Shows the chart description
					var desc = "<?php echo $chart->desc ?>",
						title = "<?php echo $chart->title ?>";
					
					<?php if ($chart->show_desc == true): ?>
						showChartDesc(title, desc);
					<?php endif; ?>

					//init the show desc button
					$("#show_desc").click(function(){
						showChartDesc(title, desc);
					});

				<?php endif; ?>

				var opt = <?php echo $chart->js_code ?>;

				//Arranges for the Label and Tooltip functions
				<?php if ($chart->type == "column" || $chart->type == "line"): ?>
					opt.tooltip.formatter = function(){return barTooltip(this); };
				<?php elseif ($chart->type == "pie"): ?>
					opt.tooltip.formatter = function(){return pieTooltip(this); };
				<?php endif; ?>

				//Sets the chart's height with a 5px buffer
				var chart_h = $("html").height() - $("#embed_extras").height() - 5;
				$("#chart").height(chart_h);

				//gets the theme
				var theme = "<?php echo $chart->theme ?>";
 				
 				render_chart(opt, theme);
			}

			$(document).ready(function(){

				//init the download CSV button
				$("#export_csv").click(function(){
					window.location.href = 'actions/export.php?c=<?php echo $chart_id ?>';
				});

				//add exception for IE
				if (! ($.browser.msie) ) {
					//init the fullscreen button and behaviors
					document.addEventListener('mozfullscreenchange', on_fullscreen_change);
					document.addEventListener('webkitfullscreenchange', on_fullscreen_change);
				}

				$("#fullscreen").click(function(){

					if (! ($.browser.msie) ) {
						fullscreen();
					}else{

						//For IE, we just throuw in a normal pop-up
						var url = window.location;
	                    var windowName = "popUp";
	                    var windowSize = "width=800,height=500";
	 
	                    window.open(url, windowName, windowSize);
					}
					
				});

				test_fullscreen();

				makechart();

			});
		</script>

		<?php if ($chart->desc != ""): ?>
			<div id="show_desc">`</div>
		<?php endif; ?>

		<div id="chart">

		</div>
		<div id="embed_extras">
			<div class="logo">
			</div>
			<?php if ($chart->source != ""): ?>
				<p class="source">
					<span id="source"><?php echo $chart->source ?></span>

					<?php if ($chart->source_url != ""): ?>
						<span id="source_url">(<a href="<?php echo $chart->source_url ?>" class="source_url"><?php echo _("Link") ?></a>)</span>
					<?php endif; ?>
				
				</p>
			<?php endif; ?>

			<button id="fullscreen" class="button">
				<?php echo _("Fullscreen") ?>
			</button>

			<button id="export_csv" class="button">
				<?php echo _("Export data") ?>
			</button>

			<div id="promo_embed"><?php printf(_("Chart created with %sDatawrapper%s."), "<a href='http://www.Datawrapper.de' target='_blank'>", "</a>") ?></div>

		</div>

		<?php
		}else{ //no GET var
			echo _("Page cannot be displayed.");
		}
		?>

		<?php if (defined('PIWIK_PATH')): ?>
			<!-- Piwik Image Tracker -->
			<img src="http://<?php echo PIWIK_PATH ?>piwik.php?idsite=1&rec=1" style="border:0" alt="" />
			<!-- End Piwik -->
		<?php endif; ?>
		
    </body>
</html>