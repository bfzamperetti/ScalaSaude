<div class="label" id="page2">
	<div class="labelContent">
		<div class="toolBar">
			<img src="img/toolBar/adicionar.png" title="<?php echo $_str['lblNew'] ?>" onclick="createLabelDialog();" />
			<div class="divisor"></div>
			<img src="img/toolBar/salvar.png" title="<?php echo $_str['lblSave'] ?>" onclick="projectLabel[currentProjectLabel].save();" />
			<div class="divisor"></div>
			<img src="img/toolBar/abrir.png" title="<?php echo $_str['lblOpen'] ?>" onclick="document.getElementById('openFileLabel').click();" />
			<div class="divisor"></div>
			<img src="img/toolBar/undo.png" title="<?php echo $_str['lblUndo'] ?>" onclick="projectLabel[currentProjectLabel].undo();" />
			<div class="divisor"></div>
			<img src="img/toolBar/print.png" title="<?php echo $_str['lblPrint'] ?>" onclick="projectLabel[currentProjectLabel].print();" />
			<div class="divisor"></div>
			<img src="img/toolBar/adicionar-calendario.png" onclick="projectLabel[currentProjectLabel].newLabel();" />
			<div class="divisor"></div>
			<div class="selector">
            	<div class="title">Tipo de etiqueta:</div>
            	<div class="radioOpt">normal <input type="radio" name="configLabelType" onclick="projectLabel[currentProjectLabel].changeLabelType(this.value);" value="false" checked /></div>
				<div class="radioOpt">visual <input type="radio" name="configLabelType" onclick="projectLabel[currentProjectLabel].changeLabelType(this.value);" value="true"  /></div>                
            </div>
		
		</div>
		<div class="fileBar" id="labelFileBar">
		</div>
		<?php include("label.php"); ?>
	</div>
</div>
