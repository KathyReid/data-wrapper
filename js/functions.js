

/*
 * @desc: Triggers error messages
 * @param1: The message to be displayed
 * @returns: Nothing
 *
 */

function error(msg){

	$('#error').html("");

	if(msg == "" || msg == undefined){
		msg = "Oops, that's not supposed to happen.";
	}

    $('#error').html(msg);
    $('#error').show();
    $('#error').effect("bounce", {
        times:3
    }, 300);

}


/*
 * @desc: Checks if the param is a numeric value
 * @param1: A variable of any type
 * @returns: true if n is a number, false otherwise
 *
 */

 function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

/*
 * @desc: Rounds number with precision
 * @param1: The number to be rounded
 * @param2: The precision (decimals)
 * @returns: The rounded number
 *
 */

 function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}


/****************************************************************/
/* These functions have to do with Highchart (tooltip & labels) */
/****************************************************************/

function pieLabels(value) {return '<b>'+ value.point.name +'</b>: '+ roundNumber(value.percentage, 2) +' %';}

function pieTooltip(value) { return '' + value.point.name + ': ' + value.y ; }

function barTooltip(value) { return '' + value.x +': '+ value.y ; }

/****************************************************************/
/* These functions show/hide the loading animations             */
/****************************************************************/

function loader_show(){
	$("#black_veil").fadeIn("fast", function(){
		
	});
	$("#loader").show();
}

function loader_hide(){

	$("#loader").hide();
	$("#black_veil").fadeOut("fast");
}

function initInputs(){
	$(document).find("input").each(function(){
		var default_content = jQuery(this).val();
		jQuery(this).focus(function(){
			if (jQuery(this).val() == default_content){
				jQuery(this).val("");
			}
		});
		jQuery(this).blur(function(){
			if (jQuery(this).val() == ""){
				jQuery(this).val(default_content);

				//Updates the graph
				if(typeof update_options == 'function') update_options();
				
			}
		});
	});
}

function render_chart(opt, theme){

	//gets chart width & height
	var render_div = opt.chart.renderTo;
	var chart_w = $("#"+ render_div).width();
	var chart_h = $("#"+ render_div).height();

	//Sets the correct dimensions for the chart
	opt.chart.width = chart_w;
	opt.chart.height = chart_h;

	if(typeof theme == 'string'){
		//If a theme is specified
		
		$.getScript('highcharts/themes/' + theme + '.js', function(){
			//Once the theme is loaded, renders chart
			chart = new Highcharts.Chart(opt, function (chart){

				if (theme != "default"){
					//Add logo to the chart

					//Renders the logo
					chart.renderer.image('highcharts/themes/'+theme+'.gif', chart_w-120, chart_h-30, 101, 18)
        			.add(); 
        		}
        	});
		});

	}else{
		//If no theme is specified
		chart = new Highcharts.Chart(opt);
	}

}