<?php 
include("function/calendar0Functions.php");
include("function/calendar1Functions.php"); 
include("function/calendar2Functions.php"); 
?>
<div id="calendarTableArea" class="calendarTableArea">
	<form id="formCalendar" class="frmCalendar1">
    
	</form>
	<script>
		currentProjectCalendar = 0; 
		<?php
		if (!isset($_SESSION['projectCalendar'])){	
		echo "
			projectCalendar[0] = new Calendar0('projectCalendar[0]', '".$_str['defaultCalendarName']."');	
		";
		} 
		else {
			echo "currentProjectCalendar = ".$_SESSION['projectCalendar']['current']."; ";
			for ($i = 0; isset($_SESSION['projectCalendar'][$i]['table']); $i++)
				echo "projectCalendar[".$i."] =  new ".$_SESSION['projectCalendar'][$i]['type']."('projectCalendar[".$i."]', '".$_SESSION['projectCalendar'][$i]['name']."', ".$_SESSION['projectCalendar'][$i]['table'].");";				
		} 
		?> 
		projectCalendar[currentProjectCalendar].show(); 
		
	</script>
</div>
