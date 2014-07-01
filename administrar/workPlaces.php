<div class="standardContent workPlaces">
	<div class="standardHeader"><p class="headerTitle"><?php echo $_str['lblWorkPlaces']; ?></p></div>
	<div class="standardInner">
		<form action="addNewWorkPlace.php" method="POST">	
			
			<div class="standardLabel">
				<?php echo $_str['lblAddPlace']; ?>: 
			</div>
			<div class="standardInput">
				<input name="nameWorkPlace" type="text" maxlength="100" />
			</div>

			<input type="hidden" name="level" value="1" />
			<input type="submit" value="<?php echo $_str['lblAdd']; ?>" />
			<div class="standardSeparator"></div>
			<div id="firstWorkPlaces" class="firstWorkPlaces"></div>
		</form>	
		<form action="addNewWorkPlace.php" method="POST">	
			<div id="secondWorkPlaces" class="secondWorkPlaces"></div>
			<div class="standardSeparator"></div>
			<div class="standardLabel">
				<?php echo $_str['lblAddUnity']; ?>:
			</div>
			<div class="standardInput">
				<input name="nameWorkPlace" type="text" maxlength="100" />
			</div>
			<input type="hidden" name="level" value="2" />
			<input type="hidden" id="firstLevelId" name="firstLevelId" />
			<input type="submit" value="<?php echo $_str['lblAdd']; ?>" />
		</form>
	</div>
</div>
<script>
	
	
	var workPlaces = new Array();
	
	function selectFirstWorkPlace(index){
		for (var wp = 0; wp < workPlaces.length; wp++)
			document.getElementById("secondWorkPlaces"+wp).style.display = 'none';
		document.getElementById("secondWorkPlaces"+index).style.display = 'block';
		document.getElementById("firstLevelId").value = workPlaces[index].id;
	}
	
	
	<?php
		$sth = $dbh->prepare("SELECT * FROM workplacesfirst ORDER BY name");
		$sth->execute();
		while ($res = $sth->fetch(PDO::FETCH_ASSOC)){
			echo 'workPlaces.push({ id:'.$res['id'].', name:"'.$res['name'].'", child: [] }); ';
			
			$sth2 = $dbh->prepare("SELECT * FROM workplacessecond WHERE idWorkPlaceFirst = ? ORDER BY name");
			$sth2->execute(array($res['id']));
			while ($res2 = $sth2->fetch(PDO::FETCH_ASSOC)){
					echo 'workPlaces[workPlaces.length-1].child.push({ id:'.$res2['id'].', name:"'.$res2['name'].'" }); ';
			}			
		}
	?>

	var createClickHandler = function(arg) {
		return function() { selectFirstWorkPlace(arg); };
	}
	
	for (var wp = 0; wp < workPlaces.length; wp++){
		var deleteWP = document.createElement('a');
		deleteWP.href = 'deleteWorkPlace?level=1&id='+workPlaces[wp].id;
		deleteWP.innerHTML = '<img src="../img/trash.jpeg" />'; 
		var radiobutton = document.createElement('input');
		radiobutton.type = 'radio';
		radiobutton.value = workPlaces[wp].id;
		radiobutton.name = 'firstWorkPlace';
		radiobutton.onclick = createClickHandler(wp);
		if (wp == 0) radiobutton.checked = true;
		var label = document.createElement('span');
		label.innerHTML = workPlaces[wp].name;
		var secondWorkPlacesDiv = document.createElement('div');
		secondWorkPlacesDiv.id = "secondWorkPlaces"+wp;
		document.getElementById("secondWorkPlaces").appendChild(secondWorkPlacesDiv);
		document.getElementById("firstWorkPlaces").appendChild(radiobutton);
		document.getElementById("firstWorkPlaces").appendChild(label);
		document.getElementById("firstWorkPlaces").appendChild(deleteWP);
		
		for (var wps = 0; wps < workPlaces[wp].child.length; wps++){
			var deleteWP = document.createElement('a');
			deleteWP.href = 'deleteWorkPlace?level=2&id='+workPlaces[wp].child[wps].id;
			deleteWP.innerHTML = '<img src="../img/trash.jpeg" />'; 
			var label = document.createElement('span');
			label.innerHTML = workPlaces[wp].child[wps].name;
			document.getElementById("secondWorkPlaces"+wp).appendChild(deleteWP);
			document.getElementById("secondWorkPlaces"+wp).appendChild(label);
			document.getElementById("secondWorkPlaces"+wp).appendChild(document.createElement('br'));
		}
	}
	document.getElementById("firstLevelId").value = workPlaces[0].id;
	document.getElementById("secondWorkPlaces0").style.display = 'block';
</script>
