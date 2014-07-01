<script>	

/* GLOBALS */
var projectCalendar = new Array();
window.currentProjectCalendar = 0;

var projectLabel = new Array();
window.currentProjectLabel = 0;
/* */

String.prototype.spliceS = function( idx, rem, s ) {
	return (this.slice(0,idx) + s + this.slice(idx + Math.abs(rem)));
};

function clone(obj){
	return JSON.parse(JSON.stringify(obj))
}

function submitFrm(form, callback){
	var form = $(form);
	$.ajax( {
	  type: "POST",
	  url: form.attr( 'action' ),
	  data: form.serialize(),
	  success: function( response ) {
		callback(JSON.parse(response));
	  }
	} );
		
	form.find("input[type=text], textarea").val("");
	return false;
}

function openCalendar(name, type, table){
	eval("projectCalendar.push(new "+type+"('projectCalendar['+projectCalendar.length+']'));");
	currentProjectCalendar = projectCalendar.length-1;
	projectCalendar[currentProjectCalendar].table = table;
	projectCalendar[currentProjectCalendar].name = name;
	projectCalendar[currentProjectCalendar].show();	
	projectCalendar[currentProjectCalendar].undoRefresh();	
	mountCalendarFileBar();
}

function createProjectCalendar(type){
	eval("projectCalendar.push(new "+type+"('projectCalendar['+projectCalendar.length+']', '<?php echo $_str['lblCalendar']; ?>'+projectCalendar.length));");
	currentProjectCalendar = projectCalendar.length-1;
	projectCalendar[currentProjectCalendar].show();
	projectCalendar[currentProjectCalendar].undoRefresh();
	mountCalendarFileBar();
}

function selectProjectCalendar(index){
	if (currentProjectCalendar == index){
		renameProjectDialog();
		return;
	}
	currentProjectCalendar = index;
	projectCalendar[currentProjectCalendar].show();
	projectCalendar[currentProjectCalendar].undoRefresh();
	mountCalendarFileBar();
}

function deleteProjectCalendar(index){
	ConfirmBox("<?php echo $_str['deleteCalendarWarning']; ?>".replace("%s",projectCalendar[index].name), function(){
		var previousType = projectCalendar[currentProjectCalendar].type; 
		projectCalendar[index].remove();
		
		if (index != currentProjectCalendar){ 
			mountCalendarFileBar();
			return;
		}
		var newIndex = index;
		for (var i = index-1; i >= 0; i--)
			if (!projectCalendar[i].isRemoved()){
				newIndex = i;
				break;
			}
		if (newIndex == index)
			for (var i = index+1; i < projectCalendar.length; i++)
				if (!projectCalendar[i].isRemoved()){
					newIndex = i;
					break;
				}
		if (newIndex == index){
			createProjectCalendar(previousType);
			return;
		}
		currentProjectCalendar = newIndex;
		projectCalendar[currentProjectCalendar].show();
		projectCalendar[index].undoRefresh();
		mountCalendarFileBar();
	});
}

function mountCalendarFileBar(){
	var html = '';
	for (var i = 0; i < projectCalendar.length; i++){
		if (projectCalendar[i].isRemoved()) continue;
		addClass = (i == currentProjectCalendar ? ' currentItemProject' : '');
		html += '<div class="itemProjectContent'+addClass+'"><div class="itemProject" onclick="selectProjectCalendar('+i+')">'+projectCalendar[i].name+'</div><div class="closeItem" onclick="deleteProjectCalendar('+i+');"></div></div>';
	}
	writeOn('calendarFileBar', html);
}

function createProjectCalendarDialog(){
	var main = $("#dialogNewProject").dialog({
		width: 300, 
		height: 200,
		title: '<?php echo $_str['lblCalendar']; ?>',
		modal: true,
		create: function(){
			document.getElementById("iconCalendarType0").onclick = function(){
				createProjectCalendar('Calendar0');
				main.dialog('close');
			};
			document.getElementById("iconCalendarType1").onclick = function(){
				createProjectCalendar('Calendar1');
				main.dialog('close');
			};		
		}
	});
	
}

function renameProjectDialog(){
	document.getElementById("dialogRenameProjectNew").value = projectCalendar[currentProjectCalendar].name;
	var main = this; 
	$("#dialogRenameProject").dialog({
		width: 400, 
		height: 300,
		resizable: false,
		buttons: {
				"Update":{ 
					text: "<?php echo $_str['lblUpdate']; ?>",
					click: function() {
						if (document.getElementById("dialogRenameProjectNew").value == '') return;
						projectCalendar[currentProjectCalendar].name = document.getElementById("dialogRenameProjectNew").value;
						mountCalendarFileBar();
						$(this).dialog('close');
					}
				},
				"Cancel":{
					
					text: "<?php echo $_str['lblCancel'] ?>",
					click: function() {
						$(this).dialog('close');
					}
				}
		}
	});
	
}

function toValidFileName(str){
	for (var character = 0; character < str.length; ++character){
		if (str[character] >= 'a' && str[character] <= 'z') continue;
		if (str[character] >= 'A' && str[character] <= 'Z')	continue;
		if (str[character] >= '0' && str[character] <= '9')	continue;
		if (str[character] == '.' || str[character] == '-')	continue;
		var accents = "éúíóáÉÚÍÓÁèùìòàÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄ";
		var charWithAccent = false;
		for (var pos = 0; pos < accents.length; pos++) 
			if (str[character] == accents[pos]){
				charWithAccent = true;
				break;
			}
		if (charWithAccent)
			continue;
		str = str.substr(0, character) + '_' + str.substr(character+1);
	}
	return str;
}

function inputsToTheirValues(root){
	
	$('INPUT').each(function(){
		var text = $(this).val();
		$(this).replaceWith('<span>'+text+'</span>');
	});
	
	$('SELECT').each(function(){
		var text = $(this).find(':selected').text();
		$(this).replaceWith('<span>'+text+'</span>');
	});
}

function getClock(time, size){
	var hour = time.substr(0,2);
	var minute = time.substr(3,2);
	if (hour > 11){ 
		hour = parseInt(hour)-12;
		if (hour<10) hour = '0'+hour;
	}
	var folder = 'clock';
	if (size > 90)
		folder = 'bigClock';
	return '<div class="clock" style="width: '+size+'px; height: '+size+'px"><img src="img/'+folder+'/clock.png" width="'+size+'px" /><img src="img/'+folder+'/m'+minute+'.png" width="'+size+'px" /><img src="img/'+folder+'/h'+hour+'.png" width="'+size+'px" /></div>';
}

function getDayturn(time){
	var hour = time.substr(0,2);
	if (hour == 0)
		return '<?php echo $_str['lblMidnight'] ?>';
	if (hour < 6)
		return '<?php echo $_str['lblDawn'] ?>';
	if (hour < 12)
		return '<?php echo $_str['lblMorning'] ?>';
	if (hour == 12)
		return '<?php echo $_str['lblNoon'] ?>';
	if (hour < 19)
		return '<?php echo $_str['lblAfternoon'] ?>';
	if (hour < 24)
		return '<?php echo $_str['lblNight'] ?>';
	return '';
}

function getBackgroundColorBySchedule(time){
	var hour = time.substr(0,2);
	if (hour == 0)
		return '#167c91';
	if (hour < 6)
		return '#105d6d';
	if (hour < 12)
		return '#bbe3f9';
	if (hour == 12)
		return '#fff391';
	if (hour < 19)
		return '#f7b49d';
	if (hour < 24)
		return '#10a7c7';
	return '';
}

function getPeriod(time, size){
	var img = 'sun';
	var hour = time.substr(0,2);
	if (hour > 17 || hour < 6)
	img = 'moon';
	return '<div class="period"><img src="img/'+img+'.png" width="'+size+'px" ></div>';
}

function timeToDate(time){
	var date = new Date(time*1000);
	return (date.getUTCDate()+1)+'/'+(date.getMonth()+1)+'/'+date.getFullYear();
}

function getDayLimitByMonth(month){
	if (month == '0' || month == '2' || month == '4' || month == '6' || month == '7' || month == '9' || month == '11')
		return 31;
	if (month == '1')
		return 28;
	return 30;
}

function writeOn(id, text){
	document.getElementById(id).innerHTML=text;
}
	
function putCSSOnAttrib(str, cssProperty, cssValue ){
	var style = str.toUpperCase().indexOf("style".toUpperCase());
	if (style != -1){
		var iniPos = str.indexOf('"', style);
		var finalPos = str.indexOf('"', iniPos+1);
		var css = str.substr(iniPos, finalPos-iniPos);
		var property = css.toUpperCase().indexOf(cssProperty.toUpperCase());
		if (property != -1){
			var iniPos2 = css.indexOf(':', property);
			var finalPos2 = css.indexOf(';', iniPos2);
			var dotAndComa = '';
			if (finalPos2 == -1){ 
				finalPos2 = finalPos;
				dotAndComa = ';';
			}
			css = css.spliceS(parseInt(iniPos2)+1,finalPos2-iniPos2-1,cssValue+dotAndComa);
			return str.spliceS(iniPos, finalPos-iniPos, css); 
		} else {
			css = '"'+cssProperty+':'+cssValue+'; '+css.substr(1);
			return str.spliceS(iniPos, Math.min(finalPos-iniPos, str.length - iniPos), css); 
		}
	} else {
		return str += ' style="'+cssProperty+':'+cssValue+';" ';
	}
	return str;
}	

function Calendar(table, nameOfVar, name){
	this.table = table;
	this.previousTable = [];
	this.previousTable.push(JSON.parse(JSON.stringify(this.table)));
	this.nameOfVar = nameOfVar;
	this.name = name;
	
	this.save = function (){
		document.getElementById("dialogSaveProjectNew").value = projectCalendar[currentProjectCalendar].name;
		var main = this; 
		$("#dialogSaveProject").dialog({
			width: 300, 
			height: 300,
			buttons: {
				
				'Update':{
					text: '<?php echo $_str['lblUpdate']; ?>',
					click: function(){
						main.name = document.getElementById("dialogSaveProjectNew").value;						
						mountCalendarFileBar();
						$(this).dialog('close');
						var form = document.createElement("form");
						form.action = 'save.php';
						form.method = 'post';
						var content = document.createElement("input");
						content.type = 'hidden';
						content.value = JSON.stringify(main.table);
						content.name = 'content';
						var type = document.createElement("input");
						type.type = 'hidden';
						type.value = main.type;
						type.name = 'type';
						var name = document.createElement("input");
						name.type = 'hidden';
						name.value = toValidFileName(main.name);
						name.name = 'name';
						form.appendChild(name);
						form.appendChild(type);
						form.appendChild(content);
						document.body.appendChild(form);
						form.submit();
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
	
	this.remove = function(){
		this.table = 'removed';
		this.undoRefresh();
	}
	
	this.isRemoved = function(){
		return (this.table == 'removed');
	}
	
	
	this.undoRefresh = function(){
		this.previousTable.push(JSON.parse(JSON.stringify(this.table)));
		if (this.previousTable.length > <?php echo $_config["undoLimit"]; ?>)
			this.previousTable.shift();
		
		var main = this;
		
		var matches = main.nameOfVar.match(/[(\d+)]/); /* extract index */
		var index = Number(matches[0]);
		
		/* update PHP */
		$.ajax({
		  type: "POST",
		  url: "updateCalendarSession.php",
		  data: { table: JSON.stringify(main.table), index: index, name: main.name, type: main.type, current: window.currentProjectCalendar }
		})
	}

	this.undo = function(){
		if (this.previousTable.length>1){
			this.previousTable.pop();
			this.table = this.previousTable[this.previousTable.length-1];
		}
		this.show();
	}
	
	this.getCurrPositionInComplexCells = function(name){
		var res = 'this.table';
		while (true){
			if (name.indexOf("complex") == -1) break;
			name = name.substr(name.indexOf("complex")+7);
			var numComplex = (name.indexOf("complex") == -1) ? name : name.substr(0, name.indexOf("complex")); 
			var currComplex = -1;
			var found = false;
			for (var i = 0; i < eval(res+'.row.length'); i++){
				for (var j = 0; j < eval(res+'.row['+i+'].col.length'); j++){
						if (typeof(eval(res+'.row['+i+'].col['+j+'].complexCell')) != 'undefined') currComplex++;
						if (currComplex == numComplex){
							found = true;
							res += ".row["+i+"].col["+j+"].complexCell";
							break;
						}
				}
				if (found) break;
			}
		}
		return res;
	}	 
	 /* This function will create a html table by a coxtext tree received on parameter "table", 
	 * the ID of the table will be "tbl"+nameForIDs, the ID of each TR will be "row"+id_of_row+nameForIDs
	 * the id of each TD will be "col"+id_of_col+"row"+id_of_row+nameForIDs
	 * */
	
	this.getWriteableTable = function (table, name){
		var table = table || this.table;
		var name = name || this.nameOfVar;
		var c = 0;
		if (typeof(table.attrib) == 'undefined') 
			table.attrib = "";
		var res = "<table "+table.attrib+" id=\"tbl"+name+"\">";
		var printrow = table.row.slice();
		printrow.sort(function(a,b){return parseInt(a.index, 10) - parseInt(b.index, 10)});
		for (var i = 0; i < printrow.length; i++){
			if (typeof(printrow[i].attrib) == 'undefined') 
				printrow[i].attrib = "";
			res += "<tr "+printrow[i].attrib+" id=\"row"+printrow[i].id+name+"\">";
			for (var j = 0; j < printrow[i].col.length; j++){
				if (typeof(printrow[i].col[j].attrib) == 'undefined') 
					printrow[i].col[j].attrib = "";
				res += "<td "+printrow[i].col[j].attrib+" id=\"col"+printrow[i].col[j].id+"row"+printrow[i].id+name+"\">";
				
				if (typeof(printrow[i].col[j].complexCell) != 'undefined'){
					var complex = printrow[i].col[j].complexCell;
					complex.attrib = ' class="complexCell" ';
					res += this.getWriteableTable(complex, name+'complex'+c);
					c++;
				}
				else 
					res += printrow[i].col[j].html;
				res += "</td>";
			}
			res += "</tr>";
		}
		res += "</table>";
		return res;
	}


/* Shows and sets for each kind of field */
/*
	this.setDoseNumber = function(row, col, n, name){
		name = name || this.nameOfVar;
		eval("var mainTable = "+this.getCurrPositionInComplexCells(name)); 
		mainTable.row[row].col[col].doseNumber+=n;
		
		if (mainTable.row[row].col[col].doseNumber < 0)
			mainTable.row[row].col[col].doseNumber = 0;
		this.showDoseNumbers();
		this.undoRefresh();
	}
*/

	this.setDoseImageDialog = function(row, col, name){
		name = name || this.nameOfVar;
		eval("var mainTable = "+this.getCurrPositionInComplexCells(name)); 
		if (mainTable.row[row].col[col].doseImage != mainTable.row[row].col[col].doseImageDefault){
			document.getElementById("doseImageSelected").innerHTML = '<img src="<?php echo $_config['pillImgUrl']; ?>'+mainTable.row[row].col[col].doseImage+'.png" width="30px" />';
			document.getElementById("doseNameSelected").innerHTML = mainTable.row[row].col[col].doseName;
		}
		document.getElementById("dialogChooseDoseImageSelected").value = mainTable.row[row].col[col].doseImage;
		document.getElementById("dialogChooseDoseNameSelected").value = mainTable.row[row].col[col].doseName;
		var main = this;
		$("#dialogChooseDoseImage").dialog({
			width: 300, 
			height: 400,
			resizable: false,
			modal: true,
			title: '<?php echo $_str['lblCalendar']; ?>',
			buttons: {
				'MedicineUpdate':{
					text: '<?php echo $_str['lblMedicineUpdate']; ?>',
					click: function(){		
		
						var doseImage = document.getElementById("dialogChooseDoseImageSelected").value;
						var doseName = document.getElementById("dialogChooseDoseNameSelected").value;
						if (!document.getElementById("dialogChooseDoseImageToAll").checked){
							mainTable.row[row].col[col].doseImage = doseImage;
							mainTable.row[row].col[col].doseName = doseName;
						}
						else
							for (var i = 0; i < mainTable.row.length; i++)
								if (mainTable.row[i].index >= mainTable.row[row].index)
									if (typeof(mainTable.row[i].col[col].doseImage) != 'undefined'){
										mainTable.row[i].col[col].doseImage = doseImage;
										mainTable.row[i].col[col].doseName = doseName;
									}
						main.showDose();
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
	
	this.showDose = function (table, name){
		table = table || this.table;
		name = name || this.nameOfVar;
		var c = 0;
		for (var i = 0; i < table.row.length; i++)
			for (var j = 0; j < table.row[i].col.length; j++){
				if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
					this.showDose(table.row[i].col[j].complexCell, name+'complex'+c);
					c++;
				}
				var content = "";
				if (typeof(table.row[i].col[j].doseImage) != 'undefined'){
					content = '<img onclick="'+this.nameOfVar+'.setDoseImageDialog('+i+','+j+
				', \''+name+'\');" class="doseImage" src="<?php echo $_config['pillImgUrl']; ?>'+table.row[i].col[j].doseImage+'.png" />';

					document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = 
				'<div class="doseImageContent">'+content+'</div><div class="doseNameContent">'+table.row[i].col[j].doseName+'</div>';
				}
			}
	}
	
	this.createEditByInput = function(content, propertyToEdit){
		$(content).data("modified", $(content).data("modified") || false);
		
		if ($(content).data("modified") == false){
			$(content).data("defaultText", $(content).text());
			$(content).data("modified", true);
			newValue = '';
		}
		else {
			newValue = $(content).text();
		}
			
		if ($(content).children().first() != null) 
			if ($(content).children().first().prop("tagName") == 'FORM') 
				return;
				
		var main = this;
		var form = $('<form action="#"></form>');
		form.submit(function(event) {
			main.editByInput(content, propertyToEdit);
			event.preventDefault();
		}); 
		
		var input = $('<input class="dynamicInput" type="text" value="'+newValue+'"  />');
		input.blur(function(){ form.submit(); });
		form.append(input);
		$(content).html(form);
		$(content).children().first().children().first().focus();
	
	}
	
	this.editByInput = function(content, propertyToEdit){
		var input = $(content).children().first().children().first();
		if (input.val().length == 0){
			$(content).data("modified", false);
			newValue = $(content).data("defaultText");
		}
		else {
			newValue = input.val();
		}
		
		$(content).html(newValue);
		eval(this.nameOfVar+'.'+propertyToEdit+'="'+newValue+'";');
		
	}
		
	this.showInputs = function (table, name){
		var table = table || this.table;
		var name = name || this.nameOfVar;
		var c = 0;
		for (var i = 0; i < table.row.length; i++)
			for (var j = 0; j < table.row[i].col.length; j++){
				if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
					this.showInputs(table.row[i].col[j].complexCell, name+'complex'+c);
					c++;
				}
				if (typeof(table.row[i].col[j].inputType) != 'undefined'){
					if (table.row[i].col[j].inputType == 'text'){
						table.row[i].col[j].inputAttrib = table.row[i].col[j].inputAttrib || '';
						document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = '<input '+table.row[i].col[j].inputAttrib+' value="'+table.row[i].col[j].inputValue+'" onchange="'+this.nameOfVar+'.changeInput(this,\'col'+table.row[i].col[j].id+'row'+table.row[i].id+name+'\')" />';		
					}
					if (table.row[i].col[j].inputType == 'select'){
						table.row[i].col[j].inputAttrib = table.row[i].col[j].inputAttrib || '';
						var select = '<select '+table.row[i].col[j].inputAttrib+' onchange="'+this.nameOfVar+'.changeInput(this, \'col'+table.row[i].col[j].id+'row'+table.row[i].id+name+'\')" >';
						for (var k = 0; k < table.row[i].col[j].inputOptions.length; k++){
							var s = ''
							if (k == table.row[i].col[j].selectedIndex)
								s = ' selected = "true" ';
							select += '<option '+s+' value="'+table.row[i].col[j].inputOptions[k].value+'">'+table.row[i].col[j].inputOptions[k].html+'</option>';	
						}
						select += '</select>';
						document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = select;		
					}
				}
			}
	}

	this.changeInput = function(obj, name, table){
		var table = table || this.table;
		var nextComplex = name.split("complex")[1];
		if (typeof(nextComplex)=='undefined'){
			var row = name.split(this.nameOfVar)[0];
			row = row.split("row")[1];
			var col = name.split("row")[0];
			col = col.split("col")[1];
			if (table.row[row].col[col].inputType == 'text')
				table.row[row].col[col].inputValue = obj.value;
			if (table.row[row].col[col].inputType == 'select')
				table.row[row].col[col].selectedIndex = obj.selectedIndex;
		}
		else {
			var c = 0;
			for (var i = 0; i < table.row.length; i++)
				for (var j = 0; j < table.row[i].col.length; j++)
					if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
						if  (c == nextComplex){
							var firstpos = name.indexOf("complex");
							this.changeInput(obj, name.substr(0, firstpos) + name.substr(name.indexOf("complex", firstpos+1)), table.row[i].col[j].complexCell);
							return;
						}
						c++;
					}
		}
	}

	this.setScheduleDialog = function(row, col){
		document.getElementById("dialogScheduleConfigHour").value = this.table.row[row].col[col].schedule.substr(0,2);
		document.getElementById("dialogScheduleConfigMinute").value = this.table.row[row].col[col].schedule.substr(3,5);
		
		var main = this; 
		$("#dialogScheduleConfig").dialog({
			width: 300, 
			height: 300,
			resizable: false,
			modal: true,
			title: '<?php echo $_str['lblCalendar']; ?>',
			buttons: {
				'SaveSchedule': {
					text: '<?php echo $_str['lblSaveSchedule'] ?>',
					click: function(){
						
						var hour = document.getElementById("dialogScheduleConfigHour").value;
						var minute = document.getElementById("dialogScheduleConfigMinute").value;
						if (!document.getElementById("dialogScheduleConfigToAll").checked)
							main.table.row[row].col[col].schedule = hour+':'+minute;
						else
							for (var i = 0; i < main.table.row[row].col.length; i++)
								if (typeof(main.table.row[row].col[i].schedule) != 'undefined')
									main.table.row[row].col[i].schedule = hour+':'+minute;
						main.showSchedules();
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

	this.showSchedules = function(table, name){
		var table = table || this.table;
		var name = name || this.nameOfVar;
		this.table.scheduleType = this.table.scheduleType || 'image';
		var c = 0;
		for (var i = 0; i < table.row.length; i++)
			for (var j = 0; j < table.row[i].col.length; j++){
				if (typeof(table.row[i].col[j].complexCell) != 'undefined'){
					this.showSchedules(table.row[i].col[j].complexCell, name+'complex'+c);
					c++;
				}
				if (typeof(table.row[i].col[j].schedule) != 'undefined'){
					switch (this.table.scheduleType){
						case 'number':
							document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = 
							'<div class="scheduleNumber"  onclick="'+name+'.setScheduleDialog('+i+','+j+');">'+table.row[i].col[j].schedule+'</div>'
						;
						break;
						case 'image':
							document.getElementById("col"+table.row[i].col[j].id+"row"+table.row[i].id+name).innerHTML = 
						'<div class="scheduleImage"  onclick="'+name+'.setScheduleDialog('+i+','+j+');">'+getPeriod(table.row[i].col[j].schedule, 50)+getClock(table.row[i].col[j].schedule, 55)+'</div>'
						;
						break;
					}
				}
			}
	}
	
	this.changeScheduleType = function(value){
		this.table.scheduleType=value;
		this.show();
	}

}

function ConfirmBox(text, functionConfirm, functionCancel){
	functionConfirm = functionConfirm || function(){};
	functionCancel = functionCancel || function(){};
	
	var div = $('<div class="divsForDialogs"></div>');
	$(div).html(text);
	$(document.body).append(div);
	var main = this; 
	div.dialog({
		width: 300, 
		height: 300,
		resizable: false,
		modal: true,
		title: '<?php echo $_str['lblConfirm']; ?>',
		buttons: {
			'Confirm': {
				text: '<?php echo $_str['lblConfirm']; ?>',
				click: function(){
					functionConfirm();
					$(this).dialog('close');
				}
			},
			'Cancel': {
				text: '<?php echo $_str['lblCancel'] ?>',
				click: function(){
						if (typeof(functionCancel) != 'undefined')
							functionCancel();
						$(this).dialog('close');
				}
			}
		}
	});
}

function AlertBox(text, functionOk){
	functionOk = functionOk || function(){};
	var main = this; 
	var div = $('<div class="divsForDialogs"></div>');
	$(div).html(text);
	$(document.body).append(div);
	div.dialog({
		width: 300, 
		height: 300,
		resizable: false,
		modal: true,
		title: '<?php echo $_str['lblConfirm']; ?>',
		buttons: {
			'Ok':{
				text: '<?php echo $_str['lblOk']; ?>',
				click: function(){
					functionOk();
					$(this).dialog('close');
				}
			}
		}
	});
}
</script>
