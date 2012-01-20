<div style="display:none">
	<div id="terms_of_use" class="popup">

		<h1><?php echo _("Terms of use") ?></h1>
		<h2><?php echo _("Fair usage policy") ?></h2>
		<p><?php echo _("DataWrapper is licensed to visualize data that comes from public, legal sources or your own research. Should we detect uses that might violate rights of organizations or single persons we reserve the right to block an account, notify the owner and ask them to stop using DataWrapper.") ?></p>
		<h2><?php echo _("Limited responsibility") ?></h2>
		<p><?php echo _("This service is provided as is. DataStory will certainly not be held accountable if your data is damaged by a server failure or any other cause.") ?></p>
		<h2><?php echo _("Privacy") ?></h2>
		<p><?php echo _("DataWrapper will not use your private data in any way not necessary for the provision of the Service. However, you have the right to ask for the modification or removal of any personal data in accordance with the laws of Germany.") ?></p>

	</div>
	<div id="impressum" class="popup">

		<h1><?php echo _("Legal imprint") ?></h1>

		<h2><?php echo _("Publisher") ?></h2>
		<p><?php echo _("ABZV • Bildungswerk der Zeitungen, 2011") ?></p>
		<h2><?php echo _("Host") ?></h2>
		<p><?php echo _("CloudControl • Helmholtz-Str. 2-9, D-10587 Berlin") ?></p>
		<h2><?php echo _("Credits") ?></h2>
		<p><?php echo _("Idea/Concept") ?>: Mirko Lorenz, <?php echo _("Development") ?>: Nicolas Kayser-Bril, 2011</p>
	</div>

	<div id="quickstart" class="popup">
		<script type="text/javascript">
			function quickstart_noshow(){
				var checked = $("input[@id='quickstart_noshow_box']:checked").length;
				if (checked){
					$.post("actions/quickstart_noshow.php", { checked: checked },
   						function(data) {
   							if (data != ""){

				     			data = jQuery.parseJSON(data);

				     			if (data.status == 200){
				     				
				     				//changes the text on the page
				     				$("#quickstart_noshow_text1").hide();
				     				$("#quickstart_noshow_text2").show();

				     			}else{
				     				error(data.error);
				     			}

				     		}else{
				     			error();
				     		}
	   					}
	   				);
            
				}else{
					return null;
				}
			}
		</script>

		<h1><?php echo _("Quickstart") ?></h1>

		<h2><?php echo _("Using DataWrapper is simple") ?></h2>
		
		<?php
			//shows only if user hasn't deactivated quickstart 
			if ($user->show_quickstart()):
		?>
		<div id="quickstart_noshow">
			<span id="quickstart_noshow_text1"><input type="checkbox" id="quickstart_noshow_box" onclick="quickstart_noshow()"><?php echo _("Do not show again on start-up.") ?></span>
			<span id="quickstart_noshow_text2" style="display:none;"><?php echo _("This quick tutorial will not be shown again.") ?></span>
		</div>
		<?php
			//ends if user hasn't deactivated quickstart
			endif;
		?>
		<ol>
			<li><?php echo _("Search for a dataset - can be an Excel chart, a Google Table or even a table in any webpage. Make sure that the data has no copyright restrictions for further use. ") ?></li>
			<li><?php echo _("Copy the table ") ?></li>
			<li>
				<?php echo _("Go to DataWrapper and drop the content into the first screen") ?>
				<br>
				<?php echo _("This will normalize the data.") ?>
			</li>
			<li>
				<?php echo _(" Click next and check your data.") ?>
				<br>
				<?php echo _("If it looks very funny, you might have to go back and copy it again.  ") ?>
			</li>
			<li>
				<?php echo _("Click next and you see the options for visualization") ?>
				<br>
				<?php echo _("For this beta release we have limited the options to five. More to come and if you are a coder/designer contact us if you can help here.") ?>
			</li>
			<li><?php echo _("Still on this screen you have options to add a description, a link to the source, etc.") ?></li>
			<li><?php echo _("Click next, check the visualization, copy the embed code and off you go.  ") ?></li>
		</ol>
	</div>

	<div id="about_datawrapper" class="popup">
		
		<h1><?php echo _("About") ?></h1>
		<h3><?php echo _("What is DataWrapper?") ?></h3>

		<p><b><?php echo _("In short: This is a little tool for journalists. It reduces the time to create and embed a simple chart from hours to seconds.") ?></b></p>

		<h3><?php echo _("Motivation") ?></h3>
		<?php echo _("There are many uses of data in journalism. The first step though is to use data more and often as a basis for reporting. Doing this has become easier, because of the large amounts of data becoming available, thanks to the OpenData movement and other initiatives.") ?></p>

		<p><?php echo _("But there are bottlenecks.") ?></p>

		<p><?php echo _("One is that creating even a simple visual chart and embedding it into a story is still too complex and time consuming. Yes, there are extensive other offerings, like IBM ManyEyes or the growing Google Chart API. They are great. But they have downsides, if used by journalists. For example you often have to store your trials data in public, can't get it out again. Plus, control over the look and feel of your charts is limited or complex to change if you are not a coder.") ?></p>

		<h3><?php echo _("Create simple, embeddable charts in seconds, not hours") ?></h3>
		<p><?php echo _("This is what DataWrapper does: This little tool reduces the time needed to create a correct chart and embed it into any CMS from hours to seconds.") ?></p>

		<p><?php echo _("Furthermore, DataWrapper is not a honey-trap. The data you work with or store is yours and yours alone. Trials are not openly published.") ?></p> 

		<p><?php echo _("On top of that, we encourage news organizations to fork DataWrapper via Github and install it on one of your own servers.") ?></p>
		<p><?php echo _("The CSS is accessible, meaning that in one day you can make sure that the charts generated with DataWrapper have your logo, your visual styles and colours.") ?></p> 

		<p><?php echo _("A short tutorial on how to use DataWrapper is here.") ?></p>

		<h3><?php echo _("Background") ?></h3>

		<p><?php echo _("DataWrapper was developed for ABZV, a journalism training organization affiliated to BDVZ (German Association of Newspaper Publishers). It is part of our efforts to develop a comprehensive curriculum for data-driven journalism.") ?></p>

		<h3><?php echo _("Features") ?></h3>

		<p><?php echo _("Use of this tool is free.") ?></p>

		<p><?php echo _("DataWrapper 0.1 is a non-commercial, open source software, licensed under the MIT License.") ?></p>

		<p><?php echo _("DataWrapper uses HTML5 Javascript libraries, namely Highcharts and D3.js, with more to come.") ?></p>

		<p><?php echo _("DataWrapper can be forked on GitHub and installed on your own server.") ?></p>

	</div>
</div>