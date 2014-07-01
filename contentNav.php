<div class="contentNav">
	<ul>
		<li <?php echo ( (!isset($_GET['s']) || $_GET['s'] == 'calendars') ? 'class="currentItem"' : '')  ?> onclick="location.href='mainPage.php?c=services&s=calendars'"><p><?php echo $_str['contentNav']['calendars']; ?></p></li>
		<li <?php echo ( (isset($_GET['s']) && $_GET['s'] == 'labels') ? 'class="currentItem"' : '')  ?>  onclick="location.href='mainPage.php?c=services&s=labels'"><p><?php echo $_str['contentNav']['labels']; ?></p></li>
		<li <?php echo ( (isset($_GET['s']) && $_GET['s'] == 'procedures') ? 'class="currentItem"' : '')  ?> onclick="location.href='mainPage.php?c=services&s=procedures'"><p><?php echo $_str['contentNav']['procedures']; ?></p></li>
	</ul>
	<div class="patientZone">
		
		<div class="patientName">
			<?php echo $_SESSION['namePatient']; ?>
		</div>
		<div class="patientCheck" onclick="location.href='mainPage.php?c=services&s=editPatient'">
			<?php echo $_str['lblVisualizePatientData']; ?>
		</div>
	</div>
</div>
