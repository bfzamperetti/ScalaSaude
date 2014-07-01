<?php include("function/calendar2Functions.php");?>
	<style>
		.control{ display:none; }
		body{ background: #fff; padding: 2%; width: 96%; position: relative;}
	</style>
	<div class="printCalendar">
		<div class="calendar" id="calendar">
			<form id="formCalendar" class="frm">
			</form>
		</div>
	</div>
<script>
	var Calendar2 = new Calendar2();
	eval("Calendar2.table = window.opener."+window.opener.projectCalendar[window.opener.currentProjectCalendar].nameOfVar+".table;");
	Calendar2.show();
	inputsToTheirValues(document.getElementById('calendar'));
	window.print();
</script>
