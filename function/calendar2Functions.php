<script>
function Calendar2(nameOfVar, name, currTable){
	var header = 
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
		{ id: 0, index: 0, col: [
			{ index:0, id:0, complexCell: header, attrib: ' class="standardHeaderCalendar" colspan="100" '},
			{ attrib:' class="control" ', html:'<img src="img/toolBar/adicionar-calendario.png" class="tableIcon control" width="40px" onclick="'+nameOfVar+'.newRow(1);" />' }
		
		]}]};

	var Calendar2 = new Calendar(table, nameOfVar, name);
	
	Calendar2.type = 'Calendar2';
	
	Calendar2.print = function(){
		var print = window.open('index.php?m=printCalendar&c=2', '<?php echo $_str['lblPrintCalendar']; ?>', 'height=700,width=1040');
		if (window.focus) { print.focus(); }
	}

	Calendar2.show = function(){
		writeOn("formCalendar", Calendar2.getWriteableTable());
		Calendar2.showDoseNumbers();
		Calendar2.showSchedules();
		Calendar2.showMedicines();
		Calendar2.showInputs();
		Calendar2.showPeriodCells();

	}
	
	Calendar2.getComplexMedicineSet = function(row){
		var obj = 
		{
		 row: [
		{ id: 0, index: 0, col: 
		[
		{index:0, id:0, attrib:' colspan="100" class="control" ', html:''} 
		]}
		]};
		return obj;
	}
	
	Calendar2.refreshPeriodDate = function(row, col){
		var firstDate = new Date();
		firstDate.setHours(12);
		firstDate.setDate(document.getElementById("masterPeriodFirstDay").value);
		firstDate.setMonth(document.getElementById("masterPeriodFirstMonth").value);
		firstDate.setFullYear(document.getElementById("masterPeriodFirstYear").value);
		var lastDate = new Date();
		lastDate.setHours(12);
		lastDate.setDate(document.getElementById("masterPeriodLastDay").value);
		lastDate.setMonth(document.getElementById("masterPeriodLastMonth").value);
		lastDate.setFullYear(document.getElementById("masterPeriodLastYear").value);
	/*	if (firstDate.getTime() > lastDate.getTime()){
			AlertBox("<?php echo $_str['dateBeginBiggerThanDateEnd']; ?>");
			this.show();
			return;
		}
	*/	this.table.row[row].col[col].masterPeriodCell.firstDay = firstDate.getTime()/1000;
		this.table.row[row].col[col].masterPeriodCell.lastDay = lastDate.getTime()/1000;
		this.show();
		
	}
	
	Calendar2.showPeriodCells = function(table, name){
		table = table || this.table;
		name = name || this.nameOfVar;
		var c = 0;
		for (var i = 0; i < table.row.length; i++)
			for (var j = 0; j < table.row[i].col.length; j++){
				if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
					this.showPeriodCells(table.row[i].col[j].complexCell, name+'complex'+c);
					c++;
				}
				if (typeof(table.row[i].col[j].periodCell) != 'undefined'){
					content = '<div class="periodCheckBoxes">';
					for (var time = parseInt(table.row[i].col[j].periodCell.firstDay); time <= table.row[i].col[j].periodCell.lastDay; time += parseInt(24*60*60)){
						var date = new Date(time*1000);
						content += '<div class="periodCheckBox">'+date.getUTCDate()+'</div>';
						
					}
					content += '</div>';
					content += '</div>';
					document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = content;
				
				}
			}
	}
	
	Calendar2.newRow = function(position){
		
		
		var controlRowsCell = {
			row: [
			{ id: 0, index: 0, col: [{index:0, id:0, html:'<img src="img/x.png" class="tableIcon" width="40px" onclick="'+nameOfVar+'.eraseRow('+parseInt(Calendar2.table.row.length)+');"  />'}] },
			{ id: 1, index: 1, col: [{index:0, id:0, html:'<img src="img/toolBar/adicionar-calendario.png" class="tableIcon" width="40px" onclick="'+nameOfVar+'.newRow('+parseInt(Calendar2.table.row.length)+');" />'}] }
			]
		};
		
				for (var i = 0; i < Calendar2.table.row.length; i++)
			if (parseInt(Calendar2.table.row[i].index) > parseInt(Calendar2.table.row[position].index))
				Calendar2.table.row[i].index++;
		var newRow = { id: Calendar2.table.row.length, index: parseInt(Calendar2.table.row[position].index)+1, attrib:' class="standardUsualLineCalendar" ', col: 
		[
		{index:0, id:0, attrib:' width="100px" ', schedule: '00:00', html:''},
		{index:1, id:1, attrib: ' colspan="100" ', complexCell: clone(Calendar2.getComplexMedicineSet(Calendar2.table.row.length)) },
		{index:2, id:2, attrib:" class='control' ", complexCell: controlRowsCell},
		]};
		Calendar2.table.row.push(newRow);
		
		Calendar2.newInnerRow(Calendar2.table.row.length-1);
		this.undoRefresh();
		Calendar2.show();
	}
	
	Calendar2.newInnerRow = function(row){
		
		Calendar2.table.row[row].col[1].complexCell.row.pop();
		var newInnerRowObj = 
		{ id: Calendar2.table.row[row].col[1].complexCell.row.length, index: Calendar2.table.row[row].col[1].complexCell.row.length, col: 
		[
		{index:0, id:0, attrib:' width="200px" ', medicineName: '', medicineLabel: '#fff', html:''}, 
		{index:1, id:1, attrib:' width="100px" ', doseNumber: 1, html:'', attrib:" class='doseMeasure' "},
		{index:2, id:2, attrib:' width="600px" ', periodCell: { firstDay: '<?php echo time(); ?>', lastDay:'<?php echo time()+30*24*60*60; ?>'} }
		]};
		
		var newControlButtonObj = 
		{ id: Calendar2.table.row[row].col[1].complexCell.row.length+1, index: Calendar2.table.row[row].col[1].complexCell.row.length+1, col: 
		[
		{index:0, id:0, attrib:' class="control" ', html:'<img src="img/toolBar/adicionar-calendario.png" class="tableIcon control" width="40px" onclick="'+nameOfVar+'.newInnerRow('+row+');" /><img src="img/erase.png" class="tableIcon control" width="40px" onclick="'+nameOfVar+'.eraseInnerRow('+row+');" />'} 
		]};
		
		Calendar2.table.row[row].col[1].complexCell.row.push(newInnerRowObj);
		Calendar2.table.row[row].col[1].complexCell.row.push(newControlButtonObj);
		this.undoRefresh();
		Calendar2.show();
	}
	
	Calendar2.eraseInnerRow = function(row){
		if (Calendar2.table.row[row].col[1].complexCell.row.length <= 2)
			return;
		
		Calendar2.table.row[row].col[1].complexCell.row.pop();
		Calendar2.table.row[row].col[1].complexCell.row.pop();
		
		var newControlButtonObj = 
		{ id: Calendar2.table.row[row].col[1].complexCell.row.length, index: Calendar2.table.row[row].col[1].complexCell.row.length, col: 
		[
		{index:0, id:0, attrib:' class="control" ', html:'<img src="img/toolBar/adicionar-calendario.png" class="tableIcon control" width="40px" onclick="'+nameOfVar+'.newInnerRow('+row+');" /><img src="img/erase.png" class="tableIcon control" width="40px" onclick="'+nameOfVar+'.eraseInnerRow('+row+');" />'} 
		]};
		Calendar2.table.row[row].col[1].complexCell.row.push(newControlButtonObj);
		this.undoRefresh();
		Calendar2.show();
	}

	Calendar2.eraseRow = function(position){
		
		for (var i = 0; i < Calendar2.table.row.length; i++)
			if (parseInt(Calendar2.table.row[i].index) > parseInt(Calendar2.table.row[position].index))
				Calendar2.table.row[i].index--;
		Calendar2.table.row[position].attrib = putCSSOnAttrib(Calendar2.table.row[position].attrib, "display", "none" );
		this.undoRefresh();
		Calendar2.show();
	}
	

	Calendar2.changeDoseType = function(value){
		Calendar2.table.doseType=value;
		Calendar2.show();
	}

	Calendar2.changeScheduleType = function(value){
		Calendar2.table.scheduleType=value;
		Calendar2.show();
	}
	Calendar2.undoRefresh();
	return Calendar2;
}
</script>
