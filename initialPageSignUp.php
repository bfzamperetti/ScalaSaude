<div class="initialPage">
		<div class="logo">			
            <a href=""> <img src="img/logo.png" width="200px" height="160px"/> </a>            
		</div>

		
	<div class="standardContent">
		<div class="standardHeader">
			<p class="headerTitle">
				<?php echo $_str['lblSignUp'].""; ?>
			</p>
		</div>
        <div class="standardInner" >
        	<div class="leftImage">
				<img  src="img/cadastro.png" />
			</div>
			<form action="signUp.php" name="frmSignUp" method="POST" onsubmit="return submitSignUp();">
				<div class="standardLabel"> <?php echo $_str['lblCPF']; ?>:</div>
				<div class="standardInput">
					<input type="text" class="cpf" name="cpf" value="" />
				</div>
				<div class="standardLabel"> <?php echo $_str['lblCRF']; ?>:</div>
				<div class="standardInput">
					<input type="text" class="crf" name="crf" value="" size="12" />
					<select name="state">
					<?php	
						for ($i = 0; $i < count($_str['state']['value']); $i++){
							echo '<option value="'.$_str['state']['value'][$i].'">'.$_str['state']['value'][$i].'</option>';			
						}
					?>
					</select>
				</div>
				<div class="standardLabel"> <?php echo $_str['lblPassword']; ?>:</div>
				<div class="standardInput">
					<input type="password" name="password" value="" />
				</div>
				<div class="standardLabel"> <?php echo $_str['lblName']; ?>:</div>
				<div class="standardInput">
					<input type="text" name="name" value="" />
				</div>
				<div class="standardLabel"> <?php echo $_str['lblEmail']; ?>:</div>
				<div class="standardInput">
					<input type="text" name="email" value="" />
				</div>
				<div class="standardLabel"> <?php echo $_str['lblPhone']; ?>:</div>
				<div class="standardInput">
					<input type="text" class="phone" name="phone" value="" />
				</div>
				<div class="standardInput">
					<input type="checkbox" name="terms" value="" />
					<?php echo $_str['lblIAcceptTheTerms']; ?>.
				</div>
				<div class="standardLabel"><a href="doc/Termos.pdf"><?php echo $_str['lblDownloadTheTerms']; ?></a></div>

				<div class="standardButton">
	                <a class="linkButton" href="javascript: document.frmSignUp.submit()"> 
                    	<h4><?php echo $_str['lblDoSignUp']; ?></h4>
		            </a>
                </div>                
				<a class="standardLink" href="index.php"><?php echo $_str['lblEnter']; ?></a>
		
                
                
				<!--<div class="standardButton">
					<input type="submit" value="Cadastrar"  />-->
				</div>
			</form>
			<script>
				
				$('.cpf').mask('000.000.000-00', {reverse: true});
				$('.crf').mask('00000000000');
				$('.phone').mask('(00) 0000-00000');
				
				function submitSignUp(){
					
					if (!document.frmSignUp.terms.checked){
						alert('<?php echo $_str['lblYouMustAcceptTerms']; ?>');
						return false;
					}
					
					document.frmSignUp.submit();
					return false;
				}
			</script>
		</div>
        
	</div>
    
</div>
