<div id="openDiv" class="divsForDialogs">
	<form id="openCalendar" action="open.php" method="post" target="openFrame" enctype="multipart/form-data">
		<input type="file" name="openFile" id="openFileCalendar" onchange="document.getElementById('openCalendar').submit();"/>
	</form>
	<iframe name="openFrame">
	
	</iframe>
</div>

<div id="dialogScheduleConfig" class="divsForDialogs">
	<?php echo $_str['lblTime']; ?>: 
	<select id="dialogScheduleConfigHour" onchange="document.getElementById('chooseClock').innerHTML = getPeriod(document.getElementById('dialogScheduleConfigHour').value+':'+document.getElementById('dialogScheduleConfigMinute').value, 100)+getClock(document.getElementById('dialogScheduleConfigHour').value+':'+document.getElementById('dialogScheduleConfigMinute').value, 100)">
		<?php
		for ($i = 0; $i < 24; $i++){
			if ($i < 10)
				$i = '0'.$i;
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		?>
	</select>
	:
	<select id="dialogScheduleConfigMinute" onchange="document.getElementById('chooseClock').innerHTML = getPeriod(document.getElementById('dialogScheduleConfigHour').value+':'+document.getElementById('dialogScheduleConfigMinute').value, 100)+getClock(document.getElementById('dialogScheduleConfigHour').value+':'+document.getElementById('dialogScheduleConfigMinute').value, 100)">
		<?php
		for ($i = 0; $i < 60; $i+=15){
			if ($i < 10) 
				$i = '0'.$i;
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		?>
	</select>
	<br />
	<input id="dialogScheduleConfigToAll" type="checkbox" CHECKED />
	<?php echo $_str['scheduleToAll'] ?> <br />
	<div id="chooseClock" class="dialogScheduleConfigChooseClock">
		<script>
			document.write(getPeriod(document.getElementById('dialogScheduleConfigHour').value+':'+document.getElementById('dialogScheduleConfigMinute').value, 100));
			document.write(getClock(document.getElementById('dialogScheduleConfigHour').value+':'+document.getElementById('dialogScheduleConfigMinute').value, 100));
		</script>
	</div>
</div>

<div id="dialogComplexScheduleConfig" class="divsForDialogs">
	<?php echo $_str['lblTime']; ?>: 
	<select id="dialogComplexScheduleConfigHour" onchange="document.getElementById('chooseComplexClock').innerHTML = getPeriod(document.getElementById('dialogComplexScheduleConfigHour').value+':'+document.getElementById('dialogComplexScheduleConfigMinute').value, 100)+getClock(document.getElementById('dialogComplexScheduleConfigHour').value+':'+document.getElementById('dialogComplexScheduleConfigMinute').value, 100)">
		<?php
		for ($i = 0; $i < 24; $i++){
			if ($i < 10)
				$i = '0'.$i;
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		?>
	</select>
	:
	<select id="dialogComplexScheduleConfigMinute" onchange="document.getElementById('chooseComplexClock').innerHTML = getPeriod(document.getElementById('dialogComplexScheduleConfigHour').value+':'+document.getElementById('dialogComplexScheduleConfigMinute').value, 100)+getClock(document.getElementById('dialogComplexScheduleConfigHour').value+':'+document.getElementById('dialogComplexScheduleConfigMinute').value, 100)">
		<?php
		for ($i = 0; $i < 60; $i+=15){
			if ($i < 10) 
				$i = '0'.$i;
			echo '<option value="'.$i.'">'.$i.'</option>';
		}
		?>
	</select>
	<br />
	<div id="chooseComplexClock" class="dialogScheduleConfigChooseClock">
		<script>
			document.write(getPeriod(document.getElementById('dialogComplexScheduleConfigHour').value+':'+document.getElementById('dialogComplexScheduleConfigMinute').value, 100));
			document.write(getClock(document.getElementById('dialogComplexScheduleConfigHour').value+':'+document.getElementById('dialogComplexScheduleConfigMinute').value, 100));
		</script>
	</div>
</div>

<div id="dialogMedicineLabel" class="divsForDialogs">
	<?php echo $_str['lblMedicineLabel']; ?>: 
	<div class="dialogMedicineInputLabels">
		<?php 
		for ($color = 0; file_exists ('img/color/'.$color.'.png'); $color++){
			echo "<div class=\"miniLabel\" onclick=\"document.getElementById('dialogMedicineInputLabel').value='".$color."'; $('#selectedLabel').html('<img src=\'img/color/".$color.".png\' width=\'100%\' height=\'100%\' />')\"><img src='img/color/".$color.".png' width='100%' height='100%' /></div>";
		}
		?>
		<div style="clear:both">
			<?php echo $_str['lblSelectedLabel'] ?>:
			<div id="selectedLabel" class="selectedLabel"></div>
		</div> 
	</div>
	<br />
	<input id="dialogMedicineInputLabel" type="hidden" value="#fff" />
</div>

<div id="dialogChooseDoseImage" class="divsForDialogs">
	<?php echo $_str['lblChooseDoseImage']; ?>: 
	<div class="dialogChooseDoseImageContent">
		<?php 
		$sth = $dbh->prepare("SELECT * FROM medicine");
		$sth->execute();
		while ($row = $sth->fetch(PDO::FETCH_ASSOC)){
			echo '<img onclick="changeImageChooseDoseNumber(\''.$row['picture'].'\',\''.$row['name'].'\');" src="'.$_config['pillImgUrl'].$row['picture'].'.png" height="30px" />';
		}
		
		?>
		<script>
			function changeImageChooseDoseNumber(picture, name){
				document.getElementById('dialogChooseDoseImageSelected').value = picture; 
				document.getElementById('dialogChooseDoseNameSelected').value = name; 
				document.getElementById('doseImageSelected').innerHTML = '<img src="<?php echo $_config['pillImgUrl'] ?>'+picture+'.png" width="30px" />';
				document.getElementById('doseNameSelected').innerHTML = name;
			}
		</script>
		<div style="clear:both">
			<?php echo $_str['lblSelectedDoseImage'] ?>:
			<div id="doseImageSelected" class="selectedDoseImage"></div>
			<div id="doseNameSelected"></div>
		</div> 
	</div>
	<br />
	<input id="dialogChooseDoseImageSelected" type="hidden" />
	<input id="dialogChooseDoseNameSelected" type="hidden" />
	<input id="dialogChooseDoseImageToAll" type="checkbox" />
	<?php echo $_str['ChooseDoseImageToAll'] ?> 
</div>	

<div id="dialogNewProject" class="divsForDialogs dialogNewProject">
	<?php echo $_str['lblChooseCalendarLayout']; ?>:<br />
	<div class="imgContent">
		<img src="img/calendarType0.png" width='30px' id="iconCalendarType0" />
	</div>
	<div class="imgContent">
		<img src="img/calendarType1.png" width='30px' id="iconCalendarType1" />
	</div>
<!--	<div class="imgContent">
		<img src="img/calendarType2.png" width='30px' id="iconCalendarType2" />
	</div> -->
</div>

<div id="dialogLabelChooseColor" class="divsForDialogs">
	<?php 
		for ($color = 0; file_exists ('img/color/'.$color.'.png'); $color++){
			echo "<div id='miniSquare#".$color."' class='miniSquare'><img src='img/color/".$color.".png' width='100%' height='100%' /></div>";
		}
	?>
</div>

<div id="dialogRenameProject" class="divsForDialogs">
	<?php echo $_str['lblRename']; ?>: 
	<input id="dialogRenameProjectNew"  type="text" maxlength="30" /><br />
</div>

<div id="dialogSaveProject" class="divsForDialogs">
	<?php echo $_str['lblSaveAs']; ?>: 
	<input id="dialogSaveProjectNew"  type="text" maxlength="30" /><br />
</div>
