<?php include_once("function/calendar1Functions.php");?>
	<style>
		.control{ display:none; }
		body{ background: #fff; padding: 2%; width: 96%; position: relative;}
	</style>
	<div class="calendar">
		<div class="calendarContent">
			<div class="printCalendar">
				<div class="calendarTableArea" id="calendarTableArea">
					<form id="formCalendar" class="frmCalendar1">
					</form>
				</div>
			</div>
		</div>
	</div>
<script>
	var tableToPrint;
	eval("tableToPrint = window.opener."+window.opener.projectCalendar[window.opener.currentProjectCalendar].nameOfVar+".table;");
	var Calendar1 = new Calendar1(window.opener.projectCalendar[window.opener.currentProjectCalendar].nameOfVar,
								  'Calendar', tableToPrint);
    Calendar1.show(true);
	inputsToTheirValues(document.getElementById('calendarTableArea'));
	window.print();
</script>
