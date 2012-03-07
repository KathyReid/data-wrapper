
			<div id="footer">
				<a href="http://www.abzv.de/" target="_blank"><?php echo _("ABZV") ?></a>
				<span class=".separator"> • </span>
				<a href="#about_Datawrapper" class="fancybox"><?php echo _("About Datawrapper") ?></a>
				<span class=".separator"> • </span>
				<a href="#motivation" class="fancybox"><?php echo _("Motivation") ?></a>
				<span class=".separator"> • </span>
				<a href="#terms_of_use" class="fancybox"><?php echo _("Terms of Use") ?></a>
				<span class=".separator"> • </span>
				<a href="#impressum" class="fancybox"><?php echo _("Legal imprint") ?></a>
				<span class=".separator"> • </span>
				<a href="#quickstart" class="fancybox"><?php echo _("Quickstart") ?></a>
				<span class=".separator"> • </span>
				<a href="#tutorial" class="fancybox"><?php echo _("Tutorial") ?></a>
				<span class=".separator"> • </span>
				<a href="#installation" class="fancybox"><?php echo _("Install") ?></a>
				<span class=".separator"> • </span>
				<a href="https://github.com/n-kb/data-wrapper" target="_blank"><?php echo _("Fork me on GitHub!") ?></a>
				<?php

				//Loads the divs that will appear in the fancybox
				require_once 'contents.php';

				?>
			</div>



		</div>

		<?php if (defined('PIWIK_PATH')): ?>
			<!-- Piwik --> 
			<script type="text/javascript">
			var pkBaseURL = (("https:" == document.location.protocol) ? "https://<?php echo PIWIK_PATH ?>" : "http://<?php echo PIWIK_PATH ?>");
			document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
			</script><script type="text/javascript">
			try {
			var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
			piwikTracker.trackPageView();
			piwikTracker.enableLinkTracking();
			} catch( err ) {}
			</script><noscript><p><img src="http://<?php echo PIWIK_PATH ?>piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
			<!-- End Piwik Tracking Code -->
		<?php endif; ?>


		<!-- Javascript code that require the DOM to be fully loaded -->


		<!-- qTip lib -->
        <script src="js/jquery.qtip-1.0.0-rc3.min.js" type="text/javascript"></script>       
        
        <!-- Fancybox assets -->
        <script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
        <link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

        <!-- The JS function that help navigate the app -->
        <script src="js/navigation.js" type="text/javascript"></script> 
        
        <!-- More general functions for the app -->
        <script src="js/functions.js" type="text/javascript"></script>

        <!-- The JS texts, translated -->
        <script src="js/texts.js.php" type="text/javascript"></script> 
        
    </body>
</html>