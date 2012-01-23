
<!-- This file holds all HTML contents for the screen "1.INPUT" -->

<script type="text/javascript">

function js_enterScreen_input(){
	
	$("#sample_data_fill").click(function(){
		
		//fills the textarea with sample data
		$("#input_data").val("	2006	2007	2008	2009	2010\r\nInner London	7,1	6,2	5,8	7,3	7,5\r\nÎle de France	7,7	7,1	6,0	7,2	7,8\r\nIstanbul	9,0	7,9	8,5	13,7	11,6\r\nRégion de Bruxelles-Capitale / Brussels Hoofdstedelijk Gewest	15,8	15,5	14,3	14,4	15,5\r\nBerlin	17,9	15,8	14,8	13,2	12,8\r\nHamburg	9,1	8,6	6,4	6,8	7,1\r\n");

		//hides the tutorial button
		$("#sample_data_fill").hide();

		//shows the tutorial explanation
		$("#sample_data_explain").show();
	});
}

</script>
<div class="screen" id="input">

	<div id="explainer"><?php echo _("Paste data here") ?></div>

	<textarea id="input_data"></textarea>

	<div id="sample_data">
		<p id="sample_data_fill"><?php echo _("Try DataWrapper with some sample data") ?></p>
		<p id="sample_data_explain" style="display:none"><?php echo _("Sample data: unemployment among the population age 25 and over in 6 European metropolis. Source: Eurostat.") ?></p>
	</div>

</div>

<!-- End screen "1.INPUT" -->