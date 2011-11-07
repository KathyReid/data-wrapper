<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <title><?php echo _("Data Story") ?></title>

        <!-- General styles -->
        <link rel="stylesheet" type="text/css" href="css/stylesheets/general.css" />

        <!-- Specific embed styles -->
        <link rel="stylesheet" type="text/css" href="css/stylesheets/embed.css" />

        <!-- JQuery library -->
        <script src="js/jquery-1.6.4.js" type="text/javascript"></script>

        <!-- JQueryUI library -->
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>       

    </head>


    <body>
	<?php

	require_once("config.php");

	if (isset($_GET["c"])){

		//Retreives the chart id
		$chart_text_id = $_GET["c"];
		$chart_id = alphaID($chart_text_id, true);

		//Looks for the chart in the DB
		$q = "SELECT chart_library, chart_type, chart_js_code FROM charts WHERE chart_id='$chart_id' LIMIT 1";

		if ($result = $mysqli->query($q)) {
			
			//fetches the result
			while ($row = $result->fetch_object()) {

				$chart_library = $row->chart_library;
				$chart_type = $row->chart_type;
				$chart_js_code = $row->chart_js_code;
				
			}

			if ($chart_library == "Highcharts"){
				?>
				<script src="highcharts/highcharts.js" type="text/javascript"></script>
				<script src="js/functions.js" type="text/javascript"></script>
				<script type="text/javascript">
					$(document).ready(function(){

						//init the download CSV button
						$("#export_csv").click(function(){
							window.location.href = 'actions/export.php?c=<?php echo $chart_id ?>';
						});

						var opt = <?php  echo $chart_js_code ?>;

						//Arranges for the Label and Tooltip functions
						<?php if ($chart_type == "column" || $chart_type == "line"): ?>
							opt.tooltip.formatter = function(){return barTooltip(this); };
						<?php elseif ($chart_type == "pie"): ?>
		 					opt.plotOptions.pie.dataLabels.formatter = function(){return pieLabels(this)};
							opt.tooltip.formatter = function(){return pieTooltip(this); };
						<?php endif; ?>

						var chart = new Highcharts.Chart(opt);
					});
				</script>
				<?php
			}


		}else{ //no data could be fetched in DB

			//Displays error
			echo $mysqli->error;
		} 
	?>	
		<div id="chart">
		</div>
		<div id="embed_extras">
			
			<button id="export_csv" class="button">
				<?php echo _("Export data") ?>
			</button>

			<p><?php echo _("Chart created using DataStory, a project by ABZV.") ?></p>

		</div>

		<?php
		}else{ //no GET var
			echo _("Page cannot be displayed.");
		}
		?>

    </body>
</html>