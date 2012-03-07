<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <title><?php echo _("Datawrapper, a project by ABZV") ?></title>

        <!-- General styles -->
        <link rel="stylesheet" type="text/css" href="css/stylesheets/general.css" />

        <!-- Vis_list styles -->
        <link rel="stylesheet" type="text/css" href="css/stylesheets/vis_list.css" />

        <!-- JQuery library -->
        <script src="js/jquery-1.6.4.js" type="text/javascript"></script>

        <!-- JQueryUI library -->
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

        <!-- Loads Favicon -->
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

    </head>


    <body>
    
	    <script type="text/javascript">

	     $(document).ready(function() {
	        
            //Init all inputs fields so they react properly onBlur
            initInputs();

            //Init the buttons in the header
            initHeader();

            //Loads the fancybox
            $("a.fancybox").fancybox({
                'hideOnContentClick': true
            });

            //init the error box
            $('#error').click(function() {
                $(this).hide();
            });		

            //loads the list of visualizations
            $.post('actions/user.php',{action:"list_vis"}, function(data){
                if (data != ""){
                    data = jQuery.parseJSON(data);

                    if (data.status == 200){
                        
                        //appends the list of vis to the div
                        $.each(data.vis, function(key, value){
                            
                            $("#vis_list_inform").append(value);
                            
                        });

                        //init tooltips
                        initTooltips();

                        //init delete chart actions
                        initDeleteChart();

                    }else{
                        error(data.message);
                    }
                }else{
                    error();
                }
            });

	     });

	    </script>

        <div id="container">
    	    <div id="error" style="display:none;"><?php echo _("Errors are displayed here") ?></div>

            <!-- Start header -->
        	<?php require_once "header.php" ?>
            <!-- End header -->

            <!-- A div that serves for popups and loading screens -->
            <div id="black_veil"></div>


            <div id="delete_chart">
                <p><?php echo _("Do you really want to delete this chart?") ?></p>
                <span class="chart_title"></span>
                <button id="delete_OK"><?php echo _("Yes") ?></button>
                <button id="delete_NO"><?php echo _("No") ?></button>
            </div>

        	<div id="screen_container">

                <div id="vis_list">
                    <h1><?php echo _("Your visualizations") ?></h1>

                    <!-- List of visualizations goes here -->
                    <div id="vis_list_inform"></div>

                </div>

        	</div>

            <!-- Start Footer -->
            <?php require_once "views/footer.php"; ?>