<?php 
include("function/functionLabel.php");
?>
<div id="labelArea" class="labelArea">
	<div id="labelDiv"></div>
	<script>
		<?php
		if (!isset($_SESSION['projectLabel'])){	
		echo "
			projectLabel[0] = new Label('projectLabel[0]', '".$_str['defaultLabelName']."');	
		";
		} 
		else {
			for ($i = 0; isset($_SESSION['projectLabel'][$i]['label']); $i++)
				echo "projectLabel[".$i."] =  new Label('projectLabel[".$i."]', '".$_SESSION['projectLabel'][$i]['name']."', ".$_SESSION['projectLabel'][$i]['label'].");";
		} 
		?>
		currentProjectLabel = 0;
		projectLabel[0].show();
		
	</script>
</div>
