<?php include_once("function/functionLabel.php");?>
	<style>
		.control{ display:none; }
		.labelDiv{ width: 370px !important; }
		body{ background: #fff; padding: 2%; width: 96%; position: relative;}
	</style>
	<div class="label">
		<div class="labelContent">
			<div class="printLabel">
				<div class="labelArea" id="labelArea">
					<div id="labelDiv">
					
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	var label;
	eval("label = clone(window.opener."+window.opener.projectLabel[currentProjectLabel].nameOfVar+".label);");
	var LabelToPrint = new Label(clone(window.opener.projectLabel[currentProjectLabel].nameOfVar)
								 , 'Etiqueta', label);
    LabelToPrint.show(true);
	inputsToTheirValues(document.getElementById('labelArea'));
	window.print();
</script>

