	<script>
		$( document ).ready(function() {
			/* initialize Selects */
			
			$(".editMyDataArea select").each(function(){
				var value = $(this).prev().html();
				var option = $(this).find('[value="' + value + '"]');
				$(this).prev().html(option.html());
				option.attr('selected', 'selected');			
			});
			
		});

	
		function initEditMyData(){
			
			$(".editMyDataItem").each(function(){
				if ($(this).hasClass( "nonEditable" )) return;
				$(this).find(".editMyDataField").hide();
				$(this).find(".editMyDataInput").show();
			});
			$(".editMyDataArea").each(function(){
				$(this).find(".initEditMyDataButton").hide();
				$(this).find(".editMyDataButton").show();
				$(this).find(".cancelEditMyDataButton").show();
			});
		}
		
		function submitEditMyData(response){
			
			if (typeof(response.error) == 'undefined'){
				location.href="mainPage.php?c=myData";
			} 
			else
				AlertBox(response.error);
		}
		
	</script>
	<?php
	$sth = $dbh->prepare("SELECT * FROM user WHERE id = ?");
	$sth->execute(array($_SESSION['idUser']));
	$myData = $sth->fetch(PDO::FETCH_ASSOC);	
	?>
	<div class="center">
		<form action="webservice/updateUser" onsubmit="return submitFrm(this, submitEditMyData);">
			<div class="editMyDataArea">
				<div class="editMyDataSection">
					<h2><?php echo $_str['lblPersonalData']; ?></h2>
					<div class="editMyDataItem">
						<div class="editMyDataLabel">
							<?php echo $_str['lblName']; ?>
						</div>
						<div class="editMyDataField" data-name="name" ><?php echo $myData['name']; ?></div>
						<input class="editMyDataInput" type="text" name="name" value="<?php echo $myData['name']; ?>" />
					</div>
					<div class="editMyDataItem">
						<div class="editMyDataLabel">
							<?php echo $_str['lblEmail']; ?>
						</div>
						<div class="editMyDataField"  data-name="email" ><?php echo $myData['email']; ?></div>
						<input class="editMyDataInput" type="text" name="email" value="<?php echo $myData['email']; ?>" />
					</div>
					<div class="editMyDataItem nonEditable">
						<div class="editMyDataLabel">
							<?php echo $_str['lblCPF']; ?>
						</div>
						<div class="editMyDataField"  data-name="CPF" ><?php echo $myData['CPF']; ?></div>
					</div>	
					<div class="editMyDataItem">
						<div class="editMyDataLabel">
							<?php echo $_str['lblRG']; ?>
						</div>
						<div class="editMyDataField"  data-name="CRF" ><?php echo $myData['CRF']; ?></div>
						<input class="editMyDataInput" type="text" name="CRF" value="<?php echo $myData['CRF']; ?>" />
					</div>		
					<div class="editMyDataItem">
						<div class="editMyDataLabel">
							<?php echo $_str['lblPhoneHome']; ?>
						</div>
						<div class="editMyDataField"  data-name="phone" ><?php echo $myData['phone']; ?></div>
						<input class="editMyDataInput" type="text" name="phone" value="<?php echo $myData['phone']; ?>" />
					</div>
					<div class="editMyDataItem">
						<div class="editMyDataLabel">
							<?php echo $_str['lblState']; ?>
						</div>
						<div class="editMyDataField"  data-name="state" ><?php echo $myData['state']; ?></div>
						<select class="editMyDataInput" name="state">
							<option value=""><?php echo $_str['lblSelect']; ?>...</option>
						<?php	
							for ($i = 0; $i < count($_str['state']['value']); $i++){
								echo '<option value="'.$_str['state']['value'][$i].'">'.$_str['state']['name'][$i].'</option>';			
							}
						?>
						</select>
					</div>
					<div class="initEditMyDataButton" onclick="initEditMyData();"><img src="img/pencil.png" /></div>
					<div class="standardSubmitButton cancelEditMyDataButton" onclick="location.href='mainPage.php?c=myData'"><?php echo $_str['lblCancel']; ?></div>
					<input type="submit" class="standardSubmitButton editMyDataButton" value="<?php echo $_str['lblSave']; ?>" />
				
				</div>
			</div>
		</form>
	</div>
