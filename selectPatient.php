<script>
	function submitSelectPatient(response){
		if (typeof(response.error) == 'undefined'){
			location.href="mainPage.php?c=services";
		} 
		else
			AlertBox(response.error);
	}
</script>
<div class="center">
	<div class="selectPatientArea">
		<form action="createSessionPatient.php" onsubmit="return submitFrm(this, submitSelectPatient);">
			<input class="standardInput inputSelectPatient" id="inputSelectPatient" name="selectPatient" /><br />
			<input type="hidden" id="idSelectedPatient" name="idSelectedPatient" value="0" />
			<input type="hidden" id="nameSelectedPatient" name="nameSelectedPatient" value="0" />
			<input class="standardSubmitButton inputSelectPatientButton" type="submit" value="<?php echo $_str['lblSelectUser']; ?>" />
		</form>
		<script>
		
				$("#inputSelectPatient").autocomplete({
					source: function(request, response){
						$.ajax({
							url: 'webservice/patientForAutocomplete',
							dataType: "json",
							type: "POST",
							success: function (data) {
								response($.ui.autocomplete.filter(data,request.term  ));
							}
						});
					},
					select: function(event, ui) {
						$("#idSelectedPatient").val(ui.item.id);
						$("#nameSelectedPatient").val(ui.item.name);
					} 
				});
		</script>
	</div>
</div>
