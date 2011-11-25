//Shows the attributes specific to column charts
$(".column").removeClass("inactive");

//Prepares Highcharts
options.chart.defaultSeriesType = chart_type;

//Axes
options.xAxis = {};
options.xAxis.categories = new Array();
options.yAxis= {};

//Y axis name
options.yAxis.title = {text: yAxis};

//Tooltip
options.tooltip.formatter = function(){return barTooltip(this); };

var count_rows = 0;

$.each(csv_data, function() {
	//New row

	//if this is the first row, populates the categories
	if (count_rows == 0 && horizontal_headers == 1){
		
		var count_cols = 0;

		$.each(this, function() {

			if (count_cols>0) options.xAxis.categories.push(String(this));

			count_cols++;

		});

	}else{

		var count_cols = 0;
	
		$.each(this, function() {
			//New col

			if (count_cols == 0){
				//if this is the first cell, adds series
				
				options.series.push({name: String(this), data: new Array});

			}else{
				//else, populates the series	
				options.series[options.series.length-1].data.push(parseFloat(this));
			}

			count_cols++;
		});

	}
	count_rows++;
});