<div class="standardContent">
	<div class="standardHeader"><p class="titleHeader"><?php echo $_str['lblAuthorizeUsers']; ?></p></div>
	<div class="standardInner">
		<?php
			$sth = $dbh->prepare("SELECT * FROM user WHERE authorized = 'n' ORDER BY id DESC");
			$sth->execute();
			if ($sth->rowCount() == 0){
				echo '
				<div class="standardLabel">
					'.$_str['lbltheIsNoUsersWaitingforAuthorization'].'.
				</div>
				';
			}
			while ($res = $sth->fetch(PDO::FETCH_ASSOC)){
				echo '
				<div class="standardLabel">
					'.$_str['lblName'].': <div class="standardInfo">'.$res['name'].'</div> |  
					'.$_str['lblEmail'].': <div class="standardInfo">'.$res['email'].'</div> |  
					'.$_str['lblPhone'].': <div class="standardInfo">'.$res['phone'].'</div> |  
					<a href="authorizeUser?r=y&id='.$res['id'].'"><img src="../img/ok.png" height="15px"/></a>|
					<a href="authorizeUser?r=d&id='.$res['id'].'"><img src="../img/no.png" height="15px"/></a>
				</div>
				';
			}
		?>
	</div>
</div>

