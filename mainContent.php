<div class="mainMenu">
	<ul>
		<li <?php echo ( (!isset($_GET['c']) || $_GET['c'] == 'patients') ? 'class="currentItem"' : '')  ?> onclick="location.href='mainPage.php'"><img src="img/home.png" width="35" height="25"/><?php echo $_str['lblUsers']; ?></li>
		<li <?php echo ( (isset($_GET['c']) && $_GET['c'] == 'myData') ? 'class="currentItem"' : '')  ?> onclick="location.href='mainPage.php?c=myData'"><img src="img/home.png" width="35" height="25"/><?php echo $_str['lblMyData']; ?></li>
		<li <?php echo ( (isset($_GET['c']) && $_GET['c'] == 'services') ? 'class="currentItem"' : '')  ?> onclick="location.href='mainPage.php?c=services'"><img src="img/home.png" width="35" height="25"/><?php echo $_str['lblServices']; ?></li>
		<li onclick="location.href='logout.php'"><img src="img/sair.png" width="40" height="25"/><?php echo $_str['lblLeave']; ?></li>
	</ul>
</div>

<?php
	if (!isset($_GET['c']))
		include("patients.php");
	else
		if (file_exists($_GET['c'].'.php'))
			include ($_GET['c'].'.php');
		else
			include("patients.php"); 
		
?>

<div class="footer">
</div>
