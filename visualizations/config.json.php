
<?php

$file_vis = '{
	"librairies": {
        "highcharts":
        {
            "name": "Highcharts",
            "dependancies": ["highcharts/highcharts.js"],
            "compatibility": {
                "IE": "6.0+",
                "FF": "2.0+",
                "Chrome": "1.0+",
                "Safari": "4.0+" 
            }
        },
        "responsive":
        {
            "name": "Responsive",
            "dependancies": ["responsive/responsive.js"],
            "compatibility": {
                "IE": "9.0+",
                "FF": "3.0+",
                "Chrome": "2.0+"
            }
        },
        "d3":
        {
            "name": "D3.js",
            "dependancies": ["d3/d3.js", "d3/d3.layout.js"],
            "compatibility": {
                "IE": "9.0+",
                "FF": "3.0+",
                "Chrome": "2.0+",
                "Safari": "4.0+" 
            }
        }
    },
    "visualizations":{
        "column":{
            "name": "column",
            "desc": "'.  _('Vertical bar chart').'",
            "library": "highcharts",
            "vis_code": "column.js"
        },
        "bar":{
            "name": "bar",
            "desc": "'.  _('Horizontal bar chart').'",
            "library": "highcharts",
            "vis_code": "column.js"
        },
        "line":{
            "name": "line",
            "desc": "'. _('Line chart').'",
            "library": "highcharts",
            "vis_code": "column.js"
        },
        "pie":{
            "name": "pie",
            "desc": "'. _('Pie chart').'",
            "library": "highcharts",
            "vis_code": "pie.js",
            "resources":{
                "'. _('Understanding Pie Charts').'": "http://eagereyes.org/techniques/pie-charts"
            }
        },
        "responsive_table":{
            "name": "responsive_table",
            "desc": "'.  _('Responsive table').'",
            "library": "responsive",
            "vis_code": "responsive.js"
        },
        "stream":{
            "name": "stream",
            "desc": "'. _('Streamgraph').'",
            "library": "d3",
            "vis_code": "stream.js"
        }

    }
}';

?>