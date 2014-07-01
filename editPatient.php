<div id="page0">
	<script>
		$( document ).ready(function() {
			/* initialize Selects */
			
			$(".editPatientArea select").each(function(){
				var value = $(this).prev().html();
				var option = $(this).find('[value="' + value + '"]');
				$(this).prev().html(option.html());
				option.attr('selected', 'selected');			
			});
			
		});

		var editMode = false;

		function initEditPatient(){
			if (editMode) return;
			editMode = true;
			
			$(".editPatientArea").each(function(){
				$(this).find(".editPatientField").hide();
				$(this).find(".initEditPatientButton").hide();
				$(this).find(".editPatientInput").show();
				$(this).find(".editPatientButton").show();
				$(this).find(".cancelEditPatientButton").show();
			});
		}
		
		function submitEditPatient(response){
			
			if (typeof(response.error) == 'undefined'){
				location.href="mainPage.php?c=services&s=editPatient";
			} 
			else
				AlertBox(response.error);
		}
		
	</script>
	<?php
	$sth = $dbh->prepare("SELECT * FROM patient WHERE id = ?");
	$sth->execute(array($_SESSION['idPatient']));
	$patient = $sth->fetch(PDO::FETCH_ASSOC);	
	?>
	<div class="center">
		<form action="webservice/updatePatient" onsubmit="return submitFrm(this, submitEditPatient);">
			<div class="editPatientArea">
				<div class="editPatientSection">
					<h2><?php echo $_str['lblPersonalData']; ?></h2>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblName']; ?>
						</div>
						<div class="editPatientField" data-name="name" ><?php echo $patient['name']; ?></div>
						<input class="editPatientInput" type="text" name="name" value="<?php echo $patient['name']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblCardSUS']; ?>
						</div>
						<div class="editPatientField" data-name="SUS" ><?php echo $patient['SUS']; ?></div>
						<input class="editPatientInput" type="text" name="SUS" value="<?php echo $patient['SUS']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblEmail']; ?>
						</div>
						<div class="editPatientField"  data-name="email" ><?php echo $patient['email']; ?></div>
						<input class="editPatientInput" type="text" name="email" value="<?php echo $patient['email']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblCPF']; ?>
						</div>
						<div class="editPatientField"  data-name="CPF" ><?php echo $patient['CPF']; ?></div>
						<input class="editPatientInput" type="text" name="CPF" value="<?php echo $patient['CPF']; ?>" />
					</div>	
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblRG']; ?>
						</div>
						<div class="editPatientField"  data-name="RG" ><?php echo $patient['RG']; ?></div>
						<input class="editPatientInput" type="text" name="RG" value="<?php echo $patient['RG']; ?>" />
					</div>		
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblBirthDate']; ?>
						</div>
						<div class="editPatientField"  data-name="birthDate" ><?php echo $patient['birthDate']; ?></div>
						<input class="editPatientInput" type="text" name="birthDate" value="<?php echo $patient['birthDate']; ?>" />
					</div>	
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblGender']; ?>
						</div>
						<div class="editPatientField"  data-name="gender" ><?php echo $patient['gender']; ?></div>
						<select class="editPatientInput" name="gender">
							<option value=""><?php echo $_str['lblSelect']; ?>...</option>
							<option value="m"><?php echo $_str['gender'][0]; ?></option>
							<option value="f"><?php echo $_str['gender'][1]; ?></option>
						</select>
					</div>	
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblCivilState']; ?>
						</div>
						<div class="editPatientField"  data-name="civilState" ><?php echo $patient['civilState']; ?></div>
						<select class="editPatientInput" name="civilState">
							<option value=""><?php echo $_str['lblSelect']; ?>...</option>
							<option value="solteiro"><?php echo $_str['civilState'][0]; ?></option>
							<option value="casado"><?php echo $_str['civilState'][1]; ?></option>
							<option value="viuvo"><?php echo $_str['civilState'][2]; ?></option>
							<option value="divorciado"><?php echo $_str['civilState'][3]; ?></option>
						</select>
					</div>	
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblWeight']; ?>
						</div>
						<div class="editPatientField"  data-name="weight" ><?php echo $patient['weight']; ?></div>
						<input class="editPatientInput" type="text" name="weight" value="<?php echo $patient['weight']; ?>" />
					</div>		
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblHeight']; ?>
						</div>
						<div class="editPatientField"  data-name="height" ><?php echo $patient['height']; ?></div>
						<input class="editPatientInput" type="text" name="height" value="<?php echo $patient['height']; ?>" />
					</div>	
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblMotherName']; ?>
						</div>
						<div class="editPatientField"  data-name="motherName" ><?php echo $patient['motherName']; ?></div>
						<input class="editPatientInput" type="text" name="motherName" value="<?php echo $patient['motherName']; ?>" />
					</div>	
					<h3><?php echo $_str['lblPhones']; ?></h3>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblPhoneHome']; ?>
						</div>
						<div class="editPatientField"  data-name="phoneHome" ><?php echo $patient['phoneHome']; ?></div>
						<input class="editPatientInput" type="text" name="phoneHome" value="<?php echo $patient['phoneHome']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblPhoneWork']; ?>
						</div>
						<div class="editPatientField"  data-name="phoneWork" ><?php echo $patient['phoneWork']; ?></div>
						<input class="editPatientInput" type="text" name="phoneWork" value="<?php echo $patient['phoneWork']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblPhoneCel']; ?>
						</div>
						<div class="editPatientField"  data-name="phoneCel" ><?php echo $patient['phoneCel']; ?></div>
						<input class="editPatientInput" type="text" name="phoneCel" value="<?php echo $patient['phoneCel']; ?>" />
					</div>
					<h3><?php echo $_str['lblAddress']; ?></h3>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblStreet']; ?>
						</div>
						<div class="editPatientField"  data-name="street" ><?php echo $patient['street']; ?></div>
						<input class="editPatientInput" type="text" name="street" value="<?php echo $patient['street']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblComplement']; ?>
						</div>
						<div class="editPatientField"  data-name="complement" ><?php echo $patient['complement']; ?></div>
						<input class="editPatientInput" type="text" name="complement" value="<?php echo $patient['complement']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblNeighboorhood']; ?>
						</div>
						<div class="editPatientField"  data-name="neighboorhood" ><?php echo $patient['neighboorhood']; ?></div>
						<input class="editPatientInput" type="text" name="neighboorhood" value="<?php echo $patient['neighboorhood']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblCity']; ?>
						</div>
						<div class="editPatientField"  data-name="city" ><?php echo $patient['city']; ?></div>
						<input class="editPatientInput" type="text" name="city" value="<?php echo $patient['city']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblState']; ?>
						</div>
						<div class="editPatientField"  data-name="state" ><?php echo $patient['state']; ?></div>
						<select class="editPatientInput" name="state">
							<option value=""><?php echo $_str['lblSelect']; ?>...</option>
						<?php	
							for ($i = 0; $i < count($_str['state']['value']); $i++){
								echo '<option value="'.$_str['state']['value'][$i].'">'.$_str['state']['name'][$i].'</option>';			
							}
						?>
						</select>
					</div>
				</div>
				<div class="editPatientSection">
					<h2><?php echo $_str['lblContactData']; ?></h2>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblName']; ?>
						</div>
						<div class="editPatientField"  data-name="contactName" ><?php echo $patient['contactName']; ?></div>
						<input class="editPatientInput" type="text" name="contactName" value="<?php echo $patient['contactName']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblContactLevel']; ?>
						</div>
						<div class="editPatientField"  data-name="contactLevel" ><?php echo $patient['contactLevel']; ?></div>
						<input class="editPatientInput" type="text" name="contactLevel" value="<?php echo $patient['contactLevel']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblPhone']; ?>
						</div>
						<div class="editPatientField"  data-name="contactPhone" ><?php echo $patient['contactPhone']; ?></div>
						<input class="editPatientInput" type="text" name="contactPhone" value="<?php echo $patient['contactPhone']; ?>" />
					</div>	
					<h3><?php echo $_str['lblAddress']; ?></h3>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblStreet']; ?>
						</div>
						<div class="editPatientField"  data-name="contactStreet" ><?php echo $patient['contactStreet']; ?></div>
						<input class="editPatientInput" type="text" name="contactStreet" value="<?php echo $patient['contactStreet']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblComplement']; ?>
						</div>
						<div class="editPatientField"  data-name="contactComplement" ><?php echo $patient['contactComplement']; ?></div>
						<input class="editPatientInput" type="text" name="contactComplement" value="<?php echo $patient['contactComplement']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblNeighboorhood']; ?>
						</div>
						<div class="editPatientField"  data-name="contactNeighboorhood" ><?php echo $patient['contactNeighboorhood']; ?></div>
						<input class="editPatientInput" type="text" name="contactNeighboorhood" value="<?php echo $patient['contactNeighboorhood']; ?>" />
					</div>
					<div class="editPatientItem">
						<div class="editPatientLabel">
							<?php echo $_str['lblCity']; ?>
						</div>
						<div class="editPatientField"  data-name="contactCity" ><?php echo $patient['contactCity']; ?></div>
						<input class="editPatientInput" type="text" name="contactCity" value="<?php echo $patient['contactCity']; ?>" />
					</div>
					<div class="initEditPatientButton" onclick="initEditPatient();"><img src="img/pencil.png" /></div>
					<div class="standardSubmitButton cancelEditPatientButton" onclick="location.href='mainPage.php?c=services&s=editPatient'"><?php echo $_str['lblCancel']; ?></div>
					<input type="submit" class="standardSubmitButton editPatientButton" value="<?php echo $_str['lblSave']; ?>" />
				
				</div>
			</div>
		</form>
	</div>
</div>
