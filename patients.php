<div class="subMenu">
	<ul>
		<li <?php echo ( (!isset($_GET['users']) || $_GET['users'] == 'selectPatient') ? 'class="currentItem"' : '')  ?> onclick="location.href='mainPage.php'"><?php echo $_str['lblSelectUser']; ?></li>
		<li <?php echo ( (isset($_GET['users']) && $_GET['users'] == 'addPatient') ? 'class="currentItem"' : '')  ?> onclick="location.href='mainPage.php?users=addPatient'"><?php echo $_str['lblAddUser']; ?></li>
	</ul>
</div>

<?php
	if (!isset($_GET['users']))
		include("selectPatient.php");
	else
		if (file_exists($_GET['users'].'.php'))
			include ($_GET['users'].'.php');
		else
			include("selectPatient.php"); 
		
?>
