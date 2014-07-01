<div class="initialPage">	
	<div class="standardContent">
		<div class="standardHeader">
			<p class="headerTitle"><?php echo $_str['lblSystemAccess']; ?></p>
		</div>
		<div class="standardInner">
			<form action="login.php" method="POST">
				<div class="standardLabel"><?php echo $_str['lblName']; ?>: </div>
				<div class="standardInput">
					<input type="text" name="user" value="" />
				</div>
				<div class="standardLabel"><?php echo $_str['lblPassword']; ?>: </div>
				<div class="standardInput">
					<input type="password" name="password" value="" />
				</div>
				<div class="linkButton">
					<input type="submit" value="Entrar"  />
				</div>
			</form>
		</div>
	</div>
</div>
