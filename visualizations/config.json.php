
<?php

$file_vis = '{
	"librairies": {
        "highcharts":
        {
            "name": "Highcharts",
            "dependancies": "highcharts/highcharts.js"
        },
        "responsive":
        {
            "name": "Responsive",
            "dependancies": "responsive/responsive.js"
        },
        "d3":
        {
            "name": "D3.js",
            "dependancies": "d3/d3.js"
        },
        "d3.layout":
        {
            "name": "D3.layout.js",
            "dependancies": "d3/d3.layout.js"
        }
    },
    "visualizations":{
        "column":{
            "name": "column",
            "desc": "'.  _("Bar chart").'",
            "library": "highcharts",
            "vis_code": "column.js"
        },
        "line":{
            "name": "line",
            "desc": "'. _("Line chart").'",
            "library": "highcharts",
            "vis_code": "column.js"
        },
        "pie":{
            "name": "pie",
            "desc": "'. _("Pie chart").'",
            "library": "highcharts",
            "vis_code": "pie.js"
        },
        "responsive_table":{
            "name": "responsive_table",
            "desc": "'.  _("Responsive table").'",
            "library": "responsive",
            "vis_code": "responsive.js"
        },
        "stream":{
            "name": "stream",
            "desc": "'. _("Streamgraph").'",
            "library": "d3",
            "vis_code": "stream.js"
        }

    }
}';

?>