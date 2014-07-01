<script>
function Calendar1(nameOfVar, name, currTable){
	var header = 
	{
	 row: [
	{ id: 0, index: 0, col: 
	[
	{index:0, id:0, attrib: ' align="right" ', html:'<?php echo $_str['lblName'] ?>: '}, 
	{index:1, id:1, html:' <?php echo $_SESSION['namePatient']; ?>'},
	{index:2, id:2, attrib: ' align="right" ', html:'<?php echo $_str['lblRecord'] ?>: '}, 
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
	[{index:0, id:0, attrib: ' align="right" ', html:'<?php echo $_str['lblMonth'] ?>: '},
	{index:1, id:1, selectedIndex: 0, inputOptions: <?php echo $selectMonth; ?>, inputType:'select', html:''},
	{index:2, id:2, attrib: ' align="right" ', html:'<?php echo $_str['lblDate'] ?>: '},
	{index:3, id:3, inputValue: '<?php echo date("d/m/Y"); ?>',  inputAttrib:' type="text" ', inputType:'text', html:''} 
	]}
	]};
	
	var restrictionsAndRecomendations = 
	{
	 row: [
	{ id: 0, index: 0, col: 
	[
	{index:0, id:0, attrib: ' width="50%" ', recommendations: []}, 
	{index:1, id:1, attrib: ' width="50%" ', restrictions: [] }
	]
	}
	]};
	
	var controlScheduleCell = {
	row: [
	{ id: 0, index: 0, col: [{index:0, id:0, html:'<img src="img/toolBar/adicionar-calendario.png" class="tableIcon" width="40px" onclick="'+nameOfVar+'.newSchedule();" />'}] },
	{ id: 1, index: 1, col: [{index:0, id:0, html:'<img src="img/toolBar/excluir-calendario.png" class="tableIcon" width="40px" onclick="'+nameOfVar+'.eraseSchedule();" />'}] }
	]
	
	};
	
	var table = currTable;
	if (typeof(table) == 'undefined')
		table = {
		 row: [
		{ id: 0, index: 0, attrib:' class="standardHeaderCalendar" ', col: [{ index:0, id:0, complexCell: header, attrib: ' colspan="100" '}]
		
		},
		
		{id: 1, index: 1, attrib:' class="standardUsualLineCalendar" ', col: 
		[{index:0, id:0, attrib:' width="220px" ', complexMedicine:{name: '<?php echo $_str['lblTypeMedicine'] ?>', dose: '<?php echo $_str['lblTypeMedicineDose']; ?>'} }, 
		{index:1, id:1,  attrib:' width="100px" ', complexSchedule:{ schedule:'12:00' } }, 
		{index:2, id:2, html:'' }, //margin
		{index:3, id:3, attrib:' class="controlCalendar1 control" ', complexCell: controlScheduleCell }
		]},
		
		{ id: 2, index: 2, col: [{ index:0, id:0, masterPeriodCell:{ firstDay: '<?php echo time(); ?>', lastDay:'<?php echo time()+30*24*60*60; ?>'}, attrib: ' colspan="100" '}]
			
		},
		
		{ id: 3, index: 3, col: [{ index:0, id:0, complexCell: restrictionsAndRecomendations, attrib: ' colspan="100" '}]
		
		}
			
		]};

	var Calendar1 = new Calendar(table, nameOfVar, name);
	
	Calendar1.type = 'Calendar1';
	
	Calendar1.showRestrictions = function (table, name){
		var table = table || this.table;
		var name = name || this.nameOfVar;
		var c = 0;
		for (var i = 0; i < table.row.length; i++)
			for (var j = 0; j < table.row[i].col.length; j++){
				if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
					this.showRestrictions(table.row[i].col[j].complexCell, name+'complex'+c);
					c++;
				}
				if (typeof(table.row[i].col[j].restrictions) != 'undefined'){
					var content = "";
					content += '<div class="title"><?php echo $_str['lblRestrictions']; ?>:</div>';
					content += '<div class="imageSet">';
					for (var restriction = 0; restriction < table.row[i].col[j].restrictions.length; restriction++)
						content+= '<img src="img/restriction/'+table.row[i].col[j].restrictions[restriction]+'.png" />';
					content += '</div>';
					
					document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = 
					'<div class="restrictionsContent">'+content+'</div>';
					
					/*<div class="doseControl control"><img onclick="'+this.nameOfVar+'.setDoseNumber('+i+','+j+
					', 1);" src="img/plusMini.png"><img onclick="'+this.nameOfVar+'.setDoseNumber('+i+','+j+
					', -1);" src="img/minus.jpg"><img onclick="'+this.nameOfVar+'.setDoseImageDialog('+i+','+j+
					');" src="img/pills.jpg"></div>';*/
				}
			}
	}

	Calendar1.showRecommendations = function (table, name){
		var table = table || this.table;
		var name = name || this.nameOfVar;
		var c = 0;
		for (var i = 0; i < table.row.length; i++)
			for (var j = 0; j < table.row[i].col.length; j++){
				if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
					this.showRecommendations(table.row[i].col[j].complexCell, name+'complex'+c);
					c++;
				}
				if (typeof(table.row[i].col[j].recommendations) != 'undefined'){
					var content = "";
					content += '<div class="title"><?php echo $_str['lblRecommendations']; ?>:</div>';
					content += '<div class="imageSet">';
					for (var recommendation = 0; recommendation < table.row[i].col[j].recommendations.length; recommendation++)
						content+= '<img src="img/recommendation/'+table.row[i].col[j].recommendations[recommendation]+'.png" />';
					content += '</div>';
					
					document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = 
					'<div class="recommendationsContent">'+content+'</div>';
					
					/*<div class="doseControl control"><img onclick="'+this.nameOfVar+'.setDoseNumber('+i+','+j+
					', 1);" src="img/plusMini.png"><img onclick="'+this.nameOfVar+'.setDoseNumber('+i+','+j+
					', -1);" src="img/minus.jpg"><img onclick="'+this.nameOfVar+'.setDoseImageDialog('+i+','+j+
					');" src="img/pills.jpg"></div>';*/
				}
			}
	}
	
	Calendar1.refreshMasterPeriodDate = function(row, col){
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
		this.undoRefresh();
		this.show();
		
	}
	
	Calendar1.showMasterPeriodCells = function(){
		for (var i = 0; i < this.table.row.length; i++)
			for (var j = 0; j < this.table.row[i].col.length; j++)
				if (typeof(this.table.row[i].col[j].masterPeriodCell) != 'undefined'){
					var dateFirst = new Date(this.table.row[i].col[j].masterPeriodCell.firstDay*1000);
					var dateLast = new Date(this.table.row[i].col[j].masterPeriodCell.lastDay*1000);
					var firstDayOptions = ''; var lastDayOptions = ''; 
					var firstMonthOptions = ''; var lastMonthOptions = ''; 
					var firstYearOptions = ''; var lastYearOptions = '';			
					var firstDayLimit = getDayLimitByMonth(dateFirst.getMonth());
					for (var k = 1; k <= firstDayLimit; k++){
						var selected = ((dateFirst.getDate() == k) ? "selected" : "");
						firstDayOptions += '<option '+selected+' value="'+k+'">'+k+'</option>';
					}
					var lastDayLimit = getDayLimitByMonth(dateLast.getMonth());
					for (var k = 1; k <= lastDayLimit; k++){
						var selected = ((dateLast.getDate() == k) ? "selected" : "");
						lastDayOptions += '<option '+selected+' value="'+k+'">'+k+'</option>';
					}
					for (var k = 1; k <= 12; k++){
						var selected = ((dateFirst.getMonth() == (k-1)) ? "selected" : "");
						firstMonthOptions += '<option '+selected+' value="'+(k-1)+'">'+k+'</option>';
						selected = ((dateLast.getMonth() == (k-1)) ? "selected" : "");
						lastMonthOptions += '<option '+selected+' value="'+(k-1)+'">'+k+'</option>';
					}
					var dateCurr = new Date(<?php echo time(); ?>*1000);
					
					for (var k = dateCurr.getFullYear(); k <= dateCurr.getFullYear()+parseInt(1); k++){
						var selected = ((dateFirst.getFullYear() == k) ? "selected" : "");
						firstYearOptions += '<option '+selected+' value="'+k+'">'+k+'</option>';
						selected = ((dateLast.getFullYear() == k) ? "selected" : "");
						lastYearOptions += '<option '+selected+' value="'+k+'">'+k+'</option>';
					}	
					var onchange = ' onchange="'+this.nameOfVar+'.refreshMasterPeriodDate('+i+','+j+');" ';
					var content = '<div class="masterPeriodCell">';
					content += '<div class="masterPeriodTextDefine"><?php echo $_str['lblPeriodOfUse']; ?>';
					content += '<select '+onchange+' id="masterPeriodFirstDay">'+firstDayOptions+'</select>';
					content += '/<select '+onchange+' id="masterPeriodFirstMonth">'+firstMonthOptions+'</select>';
					content += '/<select '+onchange+' id="masterPeriodFirstYear">'+firstYearOptions+'</select>';
					content += ' a ';
					content += '<select '+onchange+' id="masterPeriodLastDay">'+lastDayOptions+'</select>';
					content += '/<select '+onchange+' id="masterPeriodLastMonth">'+lastMonthOptions+'</select>';
					content += '/<select '+onchange+' id="masterPeriodLastYear">'+lastYearOptions+'</select>';
					content += '<div class="masterPeriodCheckBoxes">';
					for (var time = parseInt(this.table.row[i].col[j].masterPeriodCell.firstDay); time <= this.table.row[i].col[j].masterPeriodCell.lastDay; time += parseInt(24*60*60)){
						var date = new Date(time*1000);
						content += '<div class="masterPeriodCheckBox">'+date.getUTCDate()+'</div>';
						
					}
					content += '</div>';
					content += '</div>';
					document.getElementById("col"+this.table.row[i].col[j].id+"row"+this.table.row[i].id+this.nameOfVar).innerHTML = content;
				
				}
	}
	
	Calendar1.setComplexScheduleDialog = function(row, col){
		document.getElementById("dialogComplexScheduleConfigHour").value = this.table.row[row].col[col].complexSchedule.schedule.substr(0,2);
		document.getElementById("dialogComplexScheduleConfigMinute").value = this.table.row[row].col[col].complexSchedule.schedule.substr(3,5);
		
		var main = this; 
	
		$("#dialogComplexScheduleConfig").dialog({
			width: 300, 
			height: 300,
			resizable: false,
			modal: true,
			title: '<?php echo $_str['lblCalendar']; ?>',
			buttons: {
				'SaveSchedule':{
					text: '<?php echo $_str['lblSaveSchedule'] ?>',
					click: function(){
						
						var hour = document.getElementById("dialogComplexScheduleConfigHour").value;
						var minute = document.getElementById("dialogComplexScheduleConfigMinute").value;
						main.table.row[row].col[col].complexSchedule.schedule = hour+':'+minute;
						main.showComplexSchedules();
						main.undoRefresh();
						$(this).dialog('close');
					}
				},
				'Cancel':{
					text: '<?php echo $_str['lblCancel'] ?>',
					click: function(){
							$(this).dialog('close');
					}
				}
			}
		});
	}
	
	Calendar1.showComplexMedicines = function(){
		for (var i = 0; i < this.table.row.length; i++)
			for (var j = 0; j < this.table.row[i].col.length; j++)
				if (typeof(this.table.row[i].col[j].complexMedicine) != 'undefined'){
					this.table.row[i].col[j].complexMedicine.name = this.table.row[i].col[j].complexMedicine.name || "";
					this.table.row[i].col[j].complexMedicine.dose = this.table.row[i].col[j].complexMedicine.dose || "";
					document.getElementById("col"+this.table.row[i].col[j].id+"row"+this.table.row[i].id+this.nameOfVar).innerHTML = 
					'<div class="complexMedicine">'+
					'	<div class="name" onclick="'+this.nameOfVar+'.createEditByInput(this, \'table.row['+i+'].col['+j+'].complexMedicine.name\');">'+
							this.table.row[i].col[j].complexMedicine.name+
					'	</div>'+
					'	<div class="dose" onclick="'+this.nameOfVar+'.createEditByInput(this, \'table.row['+i+'].col['+j+'].complexMedicine.dose\');">'+
							this.table.row[i].col[j].complexMedicine.dose+
					'	</div>'+
					'</div>';
				}
	}

	Calendar1.showComplexSchedules = function(){
		for (var i = 0; i < this.table.row.length; i++)
			for (var j = 0; j < this.table.row[i].col.length; j++)
				if (typeof(this.table.row[i].col[j].complexSchedule) != 'undefined'){
					
					document.getElementById("col"+this.table.row[i].col[j].id+"row"+this.table.row[i].id+this.nameOfVar).innerHTML = 
					'<div class="complexSchedule" style="background: '+getBackgroundColorBySchedule(this.table.row[i].col[j].complexSchedule.schedule)+';">'+
					'	<div class="dayturn">'+
							getDayturn(this.table.row[i].col[j].complexSchedule.schedule)+
					'	</div>'+
					'	<div class="complexScheduleClock" onclick="'+this.nameOfVar+'.setComplexScheduleDialog('+i+','+j+');">'+getPeriod(this.table.row[i].col[j].complexSchedule.schedule, 65)+getClock(this.table.row[i].col[j].complexSchedule.schedule, 60)+'</div>'+
					'	<div class="complexScheduleClockNumber" onclick="'+this.nameOfVar+'.setComplexScheduleDialog('+i+','+j+');">'+this.table.row[i].col[j].complexSchedule.schedule+'</div>'+
					'</div>';
				}
	}
	
	Calendar1.print = function(){
		var print = window.open('mainPage.php?m=printCalendar&c=1', '<?php echo $_str['lblPrintCalendar']; ?>', 'height=700,width=1040');
		if (window.focus) { print.focus(); }
	}

	Calendar1.show = function(){
		writeOn("formCalendar", Calendar1.getWriteableTable());
	//	Calendar1.showDoseNumbers();
	//	Calendar1.showSchedules();
	//	Calendar1.showMedicines();
		Calendar1.showRestrictions();
		Calendar1.showRecommendations();
		Calendar1.showInputs();
		Calendar1.showComplexMedicines();
		Calendar1.showComplexSchedules();
		Calendar1.showMasterPeriodCells();

	}

	Calendar1.newSchedule = function(){
		var MAX_SCHEDULES = 6;
		var NUMBER_OF_TDS_THAT_ARENT_A_SCHEDULE_ON_ROW = 3;
		var ROW_OF_SCHEDULES = 1;
		if (table.row[1].col.length-NUMBER_OF_TDS_THAT_ARENT_A_SCHEDULE_ON_ROW >= MAX_SCHEDULES){
			AlertBox("<?php echo $_str['lblYouHaveReachedTheMaxNumberOfSchedules']; ?>");
			return;
		}
		 
		var newSchedule = {index: table.row[ROW_OF_SCHEDULES].col.length-ROW_OF_SCHEDULES, id:table.row[ROW_OF_SCHEDULES].col.length-2,attrib:' width="120px" ', complexSchedule:{ schedule:'12:00' }};
		table.row[ROW_OF_SCHEDULES].col.pop();
		table.row[ROW_OF_SCHEDULES].col.pop();
		table.row[ROW_OF_SCHEDULES].col.push(newSchedule);
		table.row[ROW_OF_SCHEDULES].col.push({index:table.row[ROW_OF_SCHEDULES].col.length, id:table.row[ROW_OF_SCHEDULES].col.length, html:'' }); // margin
		table.row[ROW_OF_SCHEDULES].col.push({index:table.row[ROW_OF_SCHEDULES].col.length, id:table.row[ROW_OF_SCHEDULES].col.length, attrib:' class="controlCalendar1 control" ', complexCell: controlScheduleCell });
		this.undoRefresh();
		Calendar1.show();
	}
	
	Calendar1.eraseSchedule = function(){
		var NUMBER_OF_TDS_THAT_ARENT_A_SCHEDULE_ON_ROW = 3;
		var ROW_OF_SCHEDULES = 1;
		if (table.row[ROW_OF_SCHEDULES].col.length-NUMBER_OF_TDS_THAT_ARENT_A_SCHEDULE_ON_ROW == 1)
			return;
		 
		table.row[ROW_OF_SCHEDULES].col.pop();
		table.row[ROW_OF_SCHEDULES].col.pop();
		table.row[ROW_OF_SCHEDULES].col.pop();
		table.row[ROW_OF_SCHEDULES].col.push({index:table.row[ROW_OF_SCHEDULES].col.length, id:table.row[ROW_OF_SCHEDULES].col.length, html:'' }); // margin
		table.row[ROW_OF_SCHEDULES].col.push({index:table.row[ROW_OF_SCHEDULES].col.length, id:table.row[ROW_OF_SCHEDULES].col.length, attrib:'class="controlCalendar1 control" ', complexCell: controlScheduleCell });
		this.undoRefresh();
		Calendar1.show();
	}
	
	Calendar1.changeDoseType = function(value){
		Calendar1.table.doseType=value;
		this.undoRefresh();
		Calendar1.show();
	}
	
	Calendar1.undoRefresh();
	
	return Calendar1;

}
</script>
