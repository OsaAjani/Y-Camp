<div id="users-show" class="tile">
	<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('teams')); ?>" target-id="teams" animation="slideInLeft" ></span>
	<h1><?php secho($user['firstname']." ".$user['lastname']); ?></h1>

	<div class="text-center">
	<div class="img-users overflow">
		<img alt="photo d'identitée" src="<?php echo HTTP_PWD_IMG . $user['id'].strtolower($user['firstname']).strtolower($user['lastname']).'jpg'; ?>" />
	</div>
	</div>
	<div class="info-user">
		<label class="col-xs-6 text-right bold"> Sexe : </label><span class="col-xs-6 text-left no-padding" ><?php echo $user['sexe'] ? 'Homme' : 'Femme'; ?></span>
		<div class="clearfix"></div>
		<label class="col-xs-6 text-right bold"> Date de naissance : </label><span class="col-xs-6 text-left no-padding" ><?php secho($birthday) ; ?></span>
		<div class="clearfix"></div>
		<label class="col-xs-6 text-right bold"> Promotion : </label><span class="col-xs-6 text-left no-padding" ><?php secho($user['promotion']) ; ?></span>
	</div>
</div>