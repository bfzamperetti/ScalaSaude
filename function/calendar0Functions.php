<script>
function Calendar0(nameOfVar, name, currTable){
	var complexCell = 
	{
	 row: [
	{ id: 0, index: 0, col: 
	[
	{index:0, id:0, attrib: ' align="right" ', html:'<?php echo $_str['lblName'] ?>:'}, 
	{index:1, id:1, html:' <?php echo $_SESSION['namePatient']; ?>'},
	{index:2, id:2, attrib: ' align="right" ', html:'<?php echo $_str['lblRecord'] ?>:'}, 
	{index:3, id:3, inputValue: '', inputType:'text',  inputAttrib:' type="text" ', html:''}
	]},
	
	<?php
	$selectMonth = '[';
	for ($i = 1; $i <= 12; $i++){
	    if ($i != 1) $selectMonth .= ',';
		$selectMonth .= '{ value: '.$i.', html:\''.$_str['month'][$i].'\'}';
	}
	$selectMonth .= ']';			
	?>
	
	{id: 1, index: 1, col: 
	[{index:0, id:0, attrib: ' align="right" ', html:'<?php echo $_str['lblMonth'] ?>:'},
	{index:1, id:1, selectedIndex: 0, inputOptions: <?php echo $selectMonth; ?>, inputType:'select', html:''},
	{index:2, id:2, attrib: ' align="right" ', html:'<?php echo $_str['lblDate'] ?>:'},
	{index:3, id:3, inputValue: '<?php echo date("d/m/Y"); ?>',  inputAttrib:' type="text" ', inputType:'text', html:''} 
	]}
	]};
	
	var table = currTable;
	if (typeof(table) == 'undefined')
		table = {
		 row: [
		{ id: 0, index: 0, col: [{ index:0, id:0, complexCell: complexCell, attrib: ' class="standardHeaderCalendar" colspan="100" '}]
		
		},
		
		{id: 1, index: 1, col: 
		[{index:0, id:0, attrib:' class="headerMed" rowspan="2" ', html:'<?php echo $_str['lblMedicine'] ?>'},
		{index:1, id:1, attrib:' class="headerQuantity" rowspan="2" ', html:'<?php echo $_str['lblQuantity']; ?>'},
		{index:1, id:1, attrib:' class="headerDose" rowspan="2" ', html:'<?php echo $_str['lblDose'] ?>'},
		{index:2, id:2, attrib:' class="headerSchedule"colspan="8" ', html:'<?php echo $_str['lblSchedule'] ?>'}
		]},
		
		
		{id: 2, index: 2, col: 
		[{index:0, id:0, attrib:'class="calendarDays"',html:'<?php echo $_str['week'][1] ?>'}, 
		{index:1, id:1, attrib:'class="calendarDays"',html:'<?php echo $_str['week'][2] ?>'}, 
		{index:2, id:2, attrib:'class="calendarDays"',html:'<?php echo $_str['week'][3] ?>'}, 
		{index:3, id:3, attrib:'class="calendarDays"',html:'<?php echo $_str['week'][4] ?>'}, 
		{index:4, id:4, attrib:'class="calendarDays"',html:'<?php echo $_str['week'][5] ?>'}, 
		{index:5, id:5, attrib:'class="calendarDays"',html:'<?php echo $_str['week'][6] ?>'}, 
		{index:6, id:6, attrib:'class="calendarDays"',html:'<?php echo $_str['week'][7] ?>'},
		{index:7, id:7, attrib: ' class="control" ', html:''}, 
		]}
			
		]};
	
	
	var Calendar0 = new Calendar(table, nameOfVar, name);
	
	Calendar0.type = 'Calendar0';
	
	Calendar0.print = function(){
		var print = window.open('mainPage.php?m=printCalendar&c=0', '<?php echo $_str['lblPrintCalendar']; ?>', 'height=700,width=1040');
		if (window.focus) { print.focus(); }
	}
	
	Calendar0.clearDefaultTexts = function(table, name){
		var table = table || Calendar0.table;
		var name = name || Calendar0.nameOfVar;
		var c = 0;
		for (var i = 0; i < table.row.length; i++)
			for (var j = 0; j < table.row[i].col.length; j++){
				if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
					Calendar0.showQuantities(table.row[i].col[j].complexCell, name+'complex'+c);
					c++;
				}
				for (var key in table.row[i].col[j]) {
					if (table.row[i].col[j].hasOwnProperty(key) && table.row[i].col[j].hasOwnProperty(key+'Default')) {
						if (table.row[i].col[j][key] ==  table.row[i].col[j][key+'Default']){
						//	 document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML='';
						} 
					}
				}
				
			}	
	}

	Calendar0.show = function(print){
		var print = print || false; 
		writeOn("formCalendar", Calendar0.getWriteableTablePersonalized(print));
		Calendar0.showDose();
		Calendar0.showInputs();
		Calendar0.showSchedules();
		Calendar0.showMedicines();
		Calendar0.showQuantities();
		Calendar0.showRecommendRestrict();
		if (print)
			Calendar0.clearDefaultTexts();
	}
	
	Calendar0.showQuantities = function(table, name){
		var table = table || Calendar0.table;
		var name = name || Calendar0.nameOfVar;
		var c = 0;
		
		for (var i = 0; i < table.row.length; i++)
			for (var j = 0; j < table.row[i].col.length; j++){
				if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
					Calendar0.showQuantities(table.row[i].col[j].complexCell, name+'complex'+c);
					c++;
				}
				if (typeof(table.row[i].col[j].quantity) != 'undefined'){
					document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = 
					'<div class="editableTextField" onclick="'+Calendar0.nameOfVar+'.createEditByInput(this, \'table.row['+i+'].col['+j+'].quantity\');">'+
							table.row[i].col[j].quantity+
					'</div>';
				}
			}
	}
	
	Calendar0.showRecommendRestrict = function(table, name){
		var table = table || Calendar0.table;
		var name = name || Calendar0.nameOfVar;
		var c = 0;
		
		for (var i = 0; i < table.row.length; i++)
			for (var j = 0; j < table.row[i].col.length; j++){
				if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
					Calendar0.showRecommendRestrict(table.row[i].col[j].complexCell, name+'complex'+c);
					c++;
				}
				if (typeof(table.row[i].col[j].recommendRestrict) != 'undefined'){
					document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = 
					'<div class="editableTextField recommendAndRestrictText" onclick="'+Calendar0.nameOfVar+'.createEditByInput(this, \'table.row['+i+'].col['+j+'].recommendRestrict\');">'+
							table.row[i].col[j].recommendRestrict+
					'</div>';
				}
			}
	}
	
	Calendar0.setMedicineLabelDialog = function(row, col, name){
		
		$('#selectedLabel').html('<img src="img/color/'+Calendar0.table.row[row].col[col].medicineLabel+'.png" width="100%" height="100%" />');
		document.getElementById('dialogMedicineInputLabel').value=Calendar0.table.row[row].col[col].medicineLabel;
		var main = this;
		$("#dialogMedicineLabel").dialog({
			width: 300, 
			height: 300,
			resizable: false,
			modal: true,
			title: '<?php echo $_str['lblCalendar']; ?>',
			buttons: {
				'MedicineLabelUpdate': {
					text: '<?php echo $_str['lblMedicineUpdate']; ?>',
					click: function(){
						var labelColor = document.getElementById("dialogMedicineInputLabel").value;
						Calendar0.table.row[row].col[col].medicineLabel = labelColor;
						main.showMedicines();
						main.undoRefresh();
						$(this).dialog('close');
					}
				},
				'Cancel': {
					text: '<?php echo $_str['lblCancel'] ?>',
					click: function(){
						$(this).dialog('close');
					}
				}
			}
		});	
	}
	
	Calendar0.showMedicines = function(table, name){
		table = table || Calendar0.table;
		name = name || Calendar0.nameOfVar;
		var c = 0;
		for (var i = 0; i < table.row.length; i++)
			for (var j = 0; j < table.row[i].col.length; j++){
				if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
					Calendar0.showMedicines(table.row[i].col[j].complexCell, name+'complex'+c);
					c++;
				}
				if (typeof(table.row[i].col[j].medicineName) != 'undefined'){
					document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = 
					'<div class="editableTextField" onclick="'+name+'.createEditByInput(this, \'table.row['+i+'].col['+j+'].medicineName\');">'+
							table.row[i].col[j].medicineName+
					'</div><br />'+
					'<div class="editableTextField" onclick="'+name+'.createEditByInput(this, \'table.row['+i+'].col['+j+'].medicineDosage\');">'+
							table.row[i].col[j].medicineDosage+
					'</div>'+
					'<div class="medicineLabel"><img  onclick="'+name+'.setMedicineLabelDialog('+i+','+j+',\''+name+'\');" src="img/color/'+table.row[i].col[j].medicineLabel+'.png" width="100%" height="100%" /></div>'
				}
			}
	}
	
	Calendar0.getWriteableTablePersonalized = function(print){
			var html = Calendar0.getWriteableTable();
			if (!print)
				html += '<img width="40px" src="img/toolBar/adicionar-calendario.png" class="downCalendarButton" onclick="'+nameOfVar+'.newRow();" />';
			return html;
	}
	
	Calendar0.positionUp = function(row){
		if (Calendar0.table.row[row].index == 3) return;
		var rowUp;
		for (rowUp = 0; rowUp < Calendar0.table.row.length; rowUp++){
				if (Calendar0.table.row[rowUp].index == Calendar0.table.row[row].index-2){
					Calendar0.table.row[rowUp].index+=2;
					Calendar0.table.row[rowUp+1].index+=2;
				}
		}
		Calendar0.table.row[row].index-=2;
		Calendar0.table.row[row+1].index-=2;
		this.undoRefresh();
		Calendar0.show();
	}
	
	Calendar0.positionDown = function(row){
		if (Calendar0.table.row[row].index == Calendar0.table.row.length-1) return;
		for (var rowDown = 0; rowDown < Calendar0.table.row.length; rowDown++){
				if (Calendar0.table.row[rowDown].index == Calendar0.table.row[row].index+2){
					Calendar0.table.row[rowDown].index-=2;
					Calendar0.table.row[rowDown+1].index-=2;
				}
		}
		Calendar0.table.row[row].index+=2;
		Calendar0.table.row[row+1].index+=2;
		this.undoRefresh();
		Calendar0.show();
	}
		
	Calendar0.newRow = function(){
		
		
		var controlRowsCell = {
			row: [
			{ id: 0, index: 0, col: [{index:0, id:0, html:'<img src="img/toolBar/excluir-calendario.png" class="tableIcon" style="float:right;" width="20px" onclick="'+nameOfVar+'.eraseRow('+parseInt(Calendar0.table.row.length)+');"  />'}] },
			{ id: 1, index: 1, col: [{index:0, id:0, html:'<img src="img/arrow-up.png" class="tableIcon" width="40px" onclick="'+nameOfVar+'.positionUp('+parseInt(Calendar0.table.row.length)+');" />'}] },
			{ id: 2, index: 2, col: [{index:0, id:0, html:'<img src="img/arrow-down.png" class="tableIcon" width="40px" onclick="'+nameOfVar+'.positionDown('+parseInt(Calendar0.table.row.length)+');" />'}] }
			]
		};
		
		newIndex = 0;
		for (var i = 0; i < Calendar0.table.row.length; i++)
			if (Calendar0.table.row[i].index >= newIndex)
				newIndex = Calendar0.table.row[i].index+1; 
		
		var newRow = { 
		id: Calendar0.table.row.length, index: newIndex, attrib:' class="standardUsualLineCalendar" ', col: 
		[{index:0, id:0, medicineName: '<?php echo $_str['lblMedicine']; ?>', medicineNameDefault: '<?php echo $_str['lblMedicine']; ?>', medicineDosage: '<?php echo $_str['lblDosage']; ?>', medicineDosageDefault: '<?php echo $_str['lblDosage']; ?>', medicineLabel: '0', html:''},
		{index:1, id:1, quantity: '<?php echo $_str['lblQuantity']; ?>...', quantityDefault: '<?php echo $_str['lblQuantity']; ?>...', html:'' },
		{index:2, id:2, doseImage: 'add', doseImageDefault: 'add', doseName: '<?php echo $_str['lblAdd']; ?>', doseNameDefault: '<?php echo $_str['lblAdd']; ?>', html:'', attrib:" class='doseMeasure' "},
		{index:3, id:3, schedule: '00:00', html:''},
		{index:4, id:4, schedule: '00:00', html:''},
		{index:5, id:5, schedule: '00:00', html:''},
		{index:6, id:6, schedule: '00:00', html:''},
		{index:7, id:7, schedule: '00:00', html:''},
		{index:8, id:8, schedule: '00:00', html:''},
		{index:9, id:9, schedule: '00:00', html:''},
		{index:10, id:10, attrib:" class='control' ", complexCell: controlRowsCell}
		]};
		
		var newRowObsArea = { 
		id: Calendar0.table.row.length+1, index: newIndex+1, attrib:' class="standardUsualLineCalendar" ', col: 
		[{index:0, id:0, attrib:" colspan='13' ", recommendRestrict: '<?php echo $_str['lblRestrictionsAndRecommendations']; ?>...', recommendRestrictDefault: '<?php echo $_str['lblRestrictionsAndRecommendations']; ?>...', html:''},
		]};
		
		
		Calendar0.table.row.push(newRow);
		Calendar0.table.row.push(newRowObsArea);
		this.undoRefresh();
		Calendar0.show();
	}

	Calendar0.eraseRow = function(position){
		ConfirmBox('<?php echo $_str['lblAreYouSureYouWantToEraseThisMedicine']; ?>', function(){
			for (var i = 0; i < Calendar0.table.row.length; i++)
				if (parseInt(Calendar0.table.row[i].index) > parseInt(Calendar0.table.row[position].index))
					Calendar0.table.row[i].index--;
			Calendar0.table.row[position].attrib = putCSSOnAttrib(Calendar0.table.row[position].attrib, "display", "none" );
			Calendar0.table.row[position+1].attrib = putCSSOnAttrib(Calendar0.table.row[position].attrib, "display", "none" );
			Calendar0.undoRefresh();
			Calendar0.show();
		});
	}

	Calendar0.changeDoseType = function(value){
		Calendar0.table.doseType=value;
		Calendar0.show();
	}

	Calendar0.undoRefresh();
	return Calendar0;
}
</script>
