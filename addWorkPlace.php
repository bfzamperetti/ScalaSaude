<?php
if (isset($_POST['firstWorkPlace'])){
	$firstWorkPlace = $_POST['firstWorkPlace'];
	$secondWorkPlace = $_POST['secondWorkPlace'];
	$nameWorkPlace = $_POST['nameWorkPlace'];

	$query = $dbh->prepare("INSERT INTO userworkplace (id, idUser, idFirstWorkPlace, idSecondWorkPlace, nameWorkPlace) 
							VALUES (0, ?, ?, ?, ?);");
	$query->execute(array($_COOKIE['idUser'], $firstWorkPlace, $secondWorkPlace, $nameWorkPlace));		
}
?>

<div class="wrapper">
	<form action="mainPage.php?m=addWorkPlace" method="POST">	
		<div class="locaisTrabalho">
			<h1>Adicionar Local de Trabalho</h1>
			<ul id="firstWorkPlaces" class="selecLocalTrabalho"></ul>
			<div class="nomeUnidade">
				<h3><?php echo $_str['lblTypeTheNameOfYourUnity']; ?>:</h3>
				<input name="nameWorkPlace" type="text" maxlength="100" />
				<input type="submit" value="<?php echo $_str['lblAdd']; ?>" />
			</div>
		</div>
		<div class="subLocaisTrabalho">
			<div id="secondWorkPlaces" class="secondWorkPlaces"></div>
		</div>
	</form>
	
</div>
<script>
	
	
	var workPlaces = new Array();
	
	function selectFirstWorkPlace(index){
		for (var wp = 0; wp < workPlaces.length; wp++)
			document.getElementById("secondWorkPlaces"+wp).style.display = 'none';
		document.getElementById("secondWorkPlaces"+index).style.display = 'block';
		if (document.getElementById("secondWorkPlaces"+index).firstChild != null)
			document.getElementById("secondWorkPlaces"+index).firstChild.checked = true;
	}
	
	
	<?php
		$sth = $dbh->prepare("SELECT * FROM workplacesfirst");
		$sth->execute();
		while ($res = $sth->fetch(PDO::FETCH_ASSOC)){
			echo 'workPlaces.push({ id:'.$res['id'].', name:"'.$res['name'].'", child: [] }); ';
			
			$sth2 = $dbh->prepare("SELECT * FROM workplacessecond WHERE idWorkPlaceFirst = ?");
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
		var radiobutton = document.createElement('input');
		radiobutton.type = 'radio';
		radiobutton.value = workPlaces[wp].id;
		radiobutton.name = 'firstWorkPlace';
		radiobutton.onclick = createClickHandler(wp);
		if (wp == 0) radiobutton.checked = true;
		var label = document.createElement('span');
		label.innerHTML = workPlaces[wp].name;
		var secondWorkPlacesUL = document.createElement('ul');
		secondWorkPlacesUL.id = "secondWorkPlaces"+wp;
		document.getElementById("secondWorkPlaces").appendChild(secondWorkPlacesUL);
		var firstWorkPlaceLI = document.createElement('li');
		firstWorkPlaceLI.appendChild(radiobutton);
		firstWorkPlaceLI.appendChild(label);
		document.getElementById("firstWorkPlaces").appendChild(firstWorkPlaceLI);
		
		for (var wps = 0; wps < workPlaces[wp].child.length; wps++){
			var radiobutton = document.createElement('input');
			radiobutton.type = 'radio';
			radiobutton.value = workPlaces[wp].child[wps].id;
			radiobutton.name = 'secondWorkPlace';
			var label = document.createElement('span');
			label.innerHTML = workPlaces[wp].child[wps].name;
			document.getElementById("secondWorkPlaces"+wp).appendChild(radiobutton);
			document.getElementById("secondWorkPlaces"+wp).appendChild(label);
			document.getElementById("secondWorkPlaces"+wp).appendChild(document.createElement('br'));
		}
		
	}
	document.getElementById("secondWorkPlaces0").style.display = 'block';
	document.getElementById("secondWorkPlaces0").firstChild.checked = true;
	selectFirstWorkPlace(0);
	
</script>
