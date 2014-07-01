<div class="calendar" id="page1">
	<div class="calendarContent">
		<div class="toolBar">
			<img src="img/toolBar/adicionar.png" title="<?php echo $_str['lblNew'] ?>" onclick="createProjectCalendarDialog();" />
			<div class="divisor"></div>
			<img src="img/toolBar/salvar.png" title="<?php echo $_str['lblSave'] ?>" onclick="projectCalendar[currentProjectCalendar].save();" />
        	<div class="divisor"></div>
			<img src="img/toolBar/abrir.png" title="<?php echo $_str['lblOpen'] ?>" onclick="document.getElementById('openFileCalendar').click();" />
		    <div class="divisor"></div>
			<img src="img/toolBar/undo.png"  title="<?php echo $_str['lblUndo'] ?>" onclick="projectCalendar[currentProjectCalendar].undo();" />
            <div class="divisor"></div>
			<img src="img/toolBar/print.png" title="<?php echo $_str['lblPrint'] ?>" onclick="projectCalendar[currentProjectCalendar].print();" />
			
            <div class="divisor"></div>
            
            <div class="selector">
            	<div class="title">Tipo de horário:</div>
            	<div class="selectorImg"><img src="img/toolBar/relogio.png" onclick="projectCalendar[currentProjectCalendar].changeScheduleType('image');" /></div>                
            	<div class="selectorImg"><img  src="img/toolBar/numeros.png" onclick="projectCalendar[currentProjectCalendar].changeScheduleType('number');" /></div>
		    </div>

		</div>
		<div class="calendarArea">
			<div class="fileBar" id="calendarFileBar">
			</div>
			<?php include("calendar.php"); ?>
		</div>
	</div>
<script>
	mountCalendarFileBar();
</script>
</div>
