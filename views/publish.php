<!-- This file holds all HTML/JS contents for the screen "6.PUBLISH" -->


<script src="js/stripslashes.js" type="text/javascript"></script>
<script type="text/javascript">

var chart_text_id = "";

function js_enterScreen_publish(){

	//init the download CSV button
	$("#export_csv").click(function(){
		window.location.href = 'actions/export.php?c=' + chart_id;
	});

	$.post("actions/publish.php", { chart_id: chart_id, action: "current" },
   		function(data) {

   			loader_hide();

   			if (data != ""){

     			data = jQuery.parseJSON(data);

     			if (data.status == 200){
     				
     				if (data.chart_library == "Highcharts"){
	     				//empties the previous options
	     				options = {};

	     				//renders the chart based on data from the DB (not the client)
	     				options = data.chart_js_code;

	     				//Adds the functions for the visualisation
	     				if (data.chart_type == "pie"){
	     					
	     					//Tooltip
							options.tooltip.formatter = function(){return pieTooltip(this); };

	     				}else if (data.chart_type == "column" || data.chart_type == "line"){
	     					//Tooltip
							options.tooltip.formatter = function(){return barTooltip(this); };
	     				}
						
						options.chart.renderTo = "publish_chart";

						//init the iframe customizators
						$("#iframe_h").val($("#embed").height());
						$("#iframe_w").val($("#embed").width());

						render_chart();
					}

					//Gets the chart ID
					chart_text_id = data.chart_text_id;
					update_dimensions();

     			}else{
     				error(data.error);
     			}

     		}else{
     			error();
     		}

   		});
}

function update_dimensions(){

	//provides the URL
	var direct_link_url = "<?php echo BASE_DIR ?>"+"?c="+chart_text_id;
	$("#direct_link_url").html(direct_link_url);

	//Makes the iframe embed code
	var iframe_h = $("#iframe_h").val();
	var iframe_w = $("#iframe_w").val();
	var extra_h = $("#embed_extras").height();

	//Sets the embed div size
	$("#embed").height(iframe_h);
	$("#embed").width(iframe_w);

	//The chart size is as big as the embed div minus the size of the extra info.
	$("#publish_chart").height(iframe_h - extra_h);
	$("#publish_chart").width(iframe_w);

	var iframe_code = "<iframe src='<?php echo BASE_DIR ?>"+"?c="+chart_text_id+"' height='"+ iframe_h +"' width='"+ iframe_w +"' frameborder='0' scrolling='no'></iframe>";

	$("#iframe_code").val(iframe_code);

	render_chart();

}

</script>
<div class="screen" id="publish">

	<div id="explainer"><?php echo _("Publish and embed!") ?></div>

	<p><?php echo _("Direct access URL") ?></p>
	<div id="direct_link_url"></div>

	<p><?php echo _("Embed code") ?>

	<br><span class="embed_customization">
		<?php echo _("Embed width") ?>
		<input type="text" id="iframe_w" class="embed_customizator" value="400" onfinishinput="update_dimensions()"/>
		<?php echo _("Embed height") ?>
		<input type="text" id="iframe_h" class="embed_customizator" value="300" onfinishinput="update_dimensions()"/>
		</span>
	</p>

	
	<textarea id="iframe_code" readonly></textarea>

	<div id="embed">
		
		<div id="publish_chart" class="publish_chart"></div>

		<div id="embed_extras">
			
			<button id="export_csv" class="button">
				<?php echo _("Export data") ?>
			</button>

			<p><?php echo _("Chart created using DataStory, a project by ABZV.") ?></p>

		</div>
	</div>
</div>