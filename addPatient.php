<script>
	function submitAddPatient(response){
		
		if (typeof(response.error) == 'undefined'){
			AlertBox("<?php echo $_str['msgSuccessAddPatient']; ?>", function(){
				location.href="mainPage.php";
			});
		} 
		else
			AlertBox(response.error);
	}

</script>
<div class="center">
	<form action="webservice/createPatient" onsubmit="return submitFrm(this, submitAddPatient);">
		<div class="addPatientArea">
			<div class="addPatientSection">
				<h2><?php echo $_str['lblPersonalData']; ?></h2>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblName']; ?>
					</div>
					<input class="addPatientInput" type="text" name="name" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblCardSUS']; ?>
					</div>
					<input class="addPatientInput" type="text" name="SUS" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblEmail']; ?>
					</div>
					<input class="addPatientInput" type="text" name="email" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblCPF']; ?>
					</div>
					<input class="addPatientInput" type="text" name="CPF" />
				</div>	
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblRG']; ?>
					</div>
					<input class="addPatientInput" type="text" name="RG" />
				</div>		
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblBirthDate']; ?>
					</div>
					<input class="addPatientInput" type="text" name="birthDate" />
				</div>	
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblGender']; ?>
					</div>
					<select class="addPatientInput" name="gender">
						<option value=""><?php echo $_str['lblSelect']; ?>...</option>
						<option value="m"><?php echo $_str['gender'][0]; ?></option>
						<option value="f"><?php echo $_str['gender'][1]; ?></option>
					</select>
				</div>	
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblCivilState']; ?>
					</div>
					<select class="addPatientInput" name="civilState">
						<option value=""><?php echo $_str['lblSelect']; ?>...</option>
						<option value="solteiro"><?php echo $_str['civilState'][0]; ?></option>
						<option value="casado"><?php echo $_str['civilState'][1]; ?></option>
						<option value="viuvo"><?php echo $_str['civilState'][2]; ?></option>
						<option value="divorciado"><?php echo $_str['civilState'][3]; ?></option>
					</select>
				</div>	
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblWeight']; ?>
					</div>
					<input class="addPatientInput" type="text" name="weight" />
				</div>		
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblHeight']; ?>
					</div>
					<input class="addPatientInput" type="text" name="height" />
				</div>	
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblMotherName']; ?>
					</div>
					<input class="addPatientInput" type="text" name="motherName" />
				</div>	
				<h3><?php echo $_str['lblPhones']; ?></h3>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblPhoneHome']; ?>
					</div>
					<input class="addPatientInput" type="text" name="phoneHome" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblPhoneWork']; ?>
					</div>
					<input class="addPatientInput" type="text" name="phoneWork" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblPhoneCel']; ?>
					</div>
					<input class="addPatientInput" type="text" name="phoneCel" />
				</div>
				<h3><?php echo $_str['lblAddress']; ?></h3>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblStreet']; ?>
					</div>
					<input class="addPatientInput" type="text" name="street" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblComplement']; ?>
					</div>
					<input class="addPatientInput" type="text" name="complement" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblNeighboorhood']; ?>
					</div>
					<input class="addPatientInput" type="text" name="neighboorhood" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblCity']; ?>
					</div>
					<input class="addPatientInput" type="text" name="city" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblState']; ?>
					</div>
					<select class="addPatientInput" name="state">
						<option value=""><?php echo $_str['lblSelect']; ?>...</option>
					<?php	
						for ($i = 0; $i < count($_str['state']['value']); $i++){
							echo '<option value="'.$_str['state']['value'][$i].'">'.$_str['state']['name'][$i].'</option>';			
						}
					?>
					</select>
				</div>
			</div>
			<div class="addPatientSection">
				<h2><?php echo $_str['lblContactData']; ?></h2>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblName']; ?>
					</div>
					<input class="addPatientInput" type="text" name="contactName" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblContactLevel']; ?>
					</div>
					<input class="addPatientInput" type="text" name="contactLevel" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblPhone']; ?>
					</div>
					<input class="addPatientInput" type="text" name="contactPhone" />
				</div>	
				<h3><?php echo $_str['lblAddress']; ?></h3>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblStreet']; ?>
					</div>
					<input class="addPatientInput" type="text" name="contactStreet" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblComplement']; ?>
					</div>
					<input class="addPatientInput" type="text" name="contactComplement" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblNeighboorhood']; ?>
					</div>
					<input class="addPatientInput" type="text" name="contactNeighboorhood" />
				</div>
				<div class="addPatientItem">
					<div class="addPatientLabel">
						<?php echo $_str['lblCity']; ?>
					</div>
					<input class="addPatientInput" type="text" name="contactCity" />
				</div>
			</div>
			<input type="submit" class="standardSubmitButton addPatientButton" value="<?php echo $_str['lblAddUser']; ?>" />
		</div>
	</form>
</div>
