<div class="initialPage">
		<div class="logo">			
            <a href=""> <img src="img/logo.png" width="200px" height="160px"/> </a>            
		</div>
		
	<div class="standardContent">
		<div class="standardHeader">
        
			<p class="headerTitle">
				<?php echo $_str['lblSystemAccess']."."; ?>
			</p>
			
		</div>

		<div class="standardInner">
			<div class="leftImage">
				<img src="img/cadeado.png" />
			</div>
			<form name="frmLogin" action="login.php" method="POST">
				<div class="standardLabel"> <?php echo $_str['lblCPF']; ?></div>
				<div class="standardInput">
					<input type="text" class="cpf" name="cpf" value="" />
				</div>
				<div class="standardLabel"> <?php echo $_str['lblPassword']; ?></div>
				<div class="standardInput">
					<input type="password" name="password" value="" />
				</div>
				<div class="standardLabel"> 
					<input type="checkbox" name="keepLogged" checked />
					<?php echo $_str['lblKeepMeLoggedIn']; ?>.
				</div>
				<div class="standardButton">
	                <a class="linkButton" href="javascript: document.frmLogin.submit()"> 
                    	<h4><?php echo $_str['lblEnter']; ?></h4><!--<img src="img/button.png" />-->
		            </a>
                </div>                

			</form>
		<a class="standardLink" href="index.php?m=initialPageSignUp"><?php echo $_str['lblDoSignUp']; ?></a>
		</div>
		<script>
			$('.cpf').mask('000.000.000-00', {reverse: true});
		</script>
	</div>
    
</div>
