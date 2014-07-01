<script>
function Label(nameOfVar, name, currLabel){
	
	this.previousLabel = [];
	this.nameOfVar = nameOfVar;
	this.name = name;
	this.visualLabel = false; //labels for people with eye disease
	
	this.defaultLabel = { 
			color: '0', 
			medicineName: '<?php echo $_str['lblMedicineName'] ?>', 
			dose: '10mg', 
			posology: '<?php echo $_str['lblSixInSixHours']; ?>', 
			remark: 'Observação',
			schedule: '00:00'
		};	

	this.label = currLabel;
	
	if (typeof(this.label) == 'undefined'){
		this.label = new Array()
		this.label.push(clone(this.defaultLabel));
	}
	
	/*
	this.save = function (){
		document.getElementById("dialogSaveProjectNew").value = projectCalendar[currentProjectCalendar].name;
		var main = this; 
		(function(){ 
			var dialog = new DialogBox({
			div: document.getElementById('dialogSaveProject'),
			width: 300, 
			height: 100,
			buttons: [
				{
					text: '<?php echo $_str['lblUpdate']; ?>',
					click: function(){
						main.name = document.getElementById("dialogSaveProjectNew").value;						
						mountCalendarFileBar();
						dialog.close();
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
				{
					text: '<?php echo $_str['lblCancel'] ?>',
					click: function(){
							dialog.close();
					}
				}
			]
		});
		})();
		
	} 
	*/

	this.newLabel = function (){
		this.label.push(clone(this.label[this.label.length-1]));
		this.show();		
		this.undoRefresh();
	}	

	this.show = function(){
		writeOn("labelDiv", this.getWriteableLabel());
			
	}
	
	this.undoRefresh = function(){
		this.previousLabel.push(JSON.parse(JSON.stringify(this.label)));
		if (this.previousLabel.length > <?php echo $_config["undoLimit"]; ?>)
			this.previousLabel.shift();
		
		var main = this;
		
		var matches = main.nameOfVar.match(/[(\d+)]/); /* extract index */
		var index = Number(matches[0]);
		
		/* update PHP */
		$.ajax({
		  type: "POST",
		  url: "updateLabelSession.php",
		  data: { label: JSON.stringify(main.label), index: index, name: main.name }
		})
	}

	this.undo = function(){
		if (this.previousLabel.length>1){
			this.previousLabel.pop();
			this.label = this.previousLabel[this.previousLabel.length-1];
		}
		this.show();
	}
	
	this.changeLabelType = function(type){
		this.visualLabel = type;
		this.show();
	}
	
	this.print = function(){
		var print = window.open('mainPage.php?m=printLabel', '<?php echo $_str['lblPrintLabel']; ?>', 'height=700,width=1040');
		if (window.focus) { print.focus(); }
	}
	
	this.getWriteableLabel = function (){
		var res = "";
		if (this.visualLabel == 'true'){
			for (var lbl = 0; lbl < this.label.length; lbl++){
				res += 
				'<div class="labelDiv" title="<?php echo $_str['lblClickToEdit...']; ?>">'+
					'<div class="labelMedicineColor" onclick="'+this.nameOfVar+'.setLabelColorDialog('+lbl+');" style="background: '+this.label[lbl].color+'"></div>'+
					'<div class="deleteLabel control" onclick="'+this.nameOfVar+'.deleteLabel('+lbl+');"></div>'+
					'<div class="labelMedicineName" onclick="'+this.nameOfVar+'.createEditByInput(this,\'label['+lbl+'].medicineName\');">'+this.label[lbl].medicineName+'</div>'+
					'<div class="scheduleImage"  onclick="'+this.nameOfVar+'.setScheduleDialog('+lbl+');">'+getPeriod(this.label[lbl].schedule, 50)+getClock(this.label[lbl].schedule, 55)+'</div>'+
					'<div class="labelRemark" onclick="'+this.nameOfVar+'.createEditByInput(this,\'label['+lbl+'].remark\');">'+this.label[lbl].remark+'</div>'+
				'</div>';
			}
		}
		else {
			for (var lbl = 0; lbl < this.label.length; lbl++){
				res += 
				'<div class="labelDiv" title="<?php echo $_str['lblClickToEdit...']; ?>">'+
					'<div class="deleteLabel control"><img onclick="'+this.nameOfVar+'.deleteLabel('+lbl+');" src="img/toolBar/excluir-calendario.png" /></div>'+
					'<div class="labelMedicineName" onclick="'+this.nameOfVar+'.createEditByInput(this,\'label['+lbl+'].medicineName\');">'+this.label[lbl].medicineName+'</div>'+
					'<div class="labelDose" onclick="'+this.nameOfVar+'.createEditByInput(this,\'label['+lbl+'].dose\');">'+this.label[lbl].dose+'</div>'+
					'<div class="labelMedicineColor" onclick="'+this.nameOfVar+'.setLabelColorDialog('+lbl+');"><img src="img/color/'+this.label[lbl].color+'.png" width="100%" height="100%" /></div>'+
					'<div class="labelPosology" onclick="'+this.nameOfVar+'.createEditByInput(this,\'label['+lbl+'].posology\');">'+this.label[lbl].posology+'</div>'+
					'<div class="labelRemark" onclick="'+this.nameOfVar+'.createEditByInput(this,\'label['+lbl+'].remark\');">'+this.label[lbl].remark+'</div>'+
				'</div>';
			}
		}
		return res;
	}
	
	this.setLabelColorDialog = function(lbl){
		var main = this;
		
		$("#dialogLabelChooseColor").dialog({ 
			width: 300, 
			height: 300,
			resizable: false,
			modal: true,
			buttons: {
				'Cancel': {
					text: '<?php echo $_str['lblCancel'] ?>',
					click: function(){
						$(this).dialog('close');
					}
				}
			}
		});	
			
		var nodes = document.getElementById('dialogLabelChooseColor').childNodes;
		for (var node = 0; node < nodes.length; node++){
			nodes[node].onclick = function(){
				var color = this.id.split('#');
				main.label[lbl].color = color[1];
				main.show();
				main.undoRefresh();
				$("#dialogLabelChooseColor").dialog('close');
			}
		}
		
	}
	
	this.deleteLabel = function(lbl){
		this.label.splice(lbl,1);
		if (this.label.length == 0)
			this.label.push(clone(this.defaultLabel));
		
		this.show();
		this.undoRefresh();
	}

	this.createEditByInput = function(content, propertyToEdit){
		if (content.firstChild != null) 
			if (content.firstChild.tagName == 'FORM') 
				return;
		var main = this;
		var previousValue = content.innerHTML;
		var form = document.createElement('form');
		form.onsubmit = function(){ main.editByInput(form,propertyToEdit); return false; }
		form.action = "#";
		var input = document.createElement('input');
		input.type="text";
		input.onblur = function(){ form.onsubmit(); }
		input.value = content.firstChild.data;
		form.appendChild(input);
		content.removeChild(content.firstChild);
		content.appendChild(form);
		content.firstChild.firstChild.focus();
	}
	
	this.editByInput = function(form, propertyToEdit){
		var newValue = form.firstChild.value;
		form.parentNode.innerHTML = newValue;
		eval(this.nameOfVar+'.'+propertyToEdit+'="'+newValue+'";');
		this.undoRefresh();
	}
	
	this.previousLabel.push(JSON.parse(JSON.stringify(this.label)));

}
</script>
