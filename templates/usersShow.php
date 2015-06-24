<div id="users-show" class="tile">
		<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('teams', 'show', [$user['team_id']])); ?>" target-id="teams-show" animation="slideInLeft" ></span>
	<h1><?php secho($user['firstname']." ".$user['lastname']); ?></h1>

	<div class="text-center">
	<div class="img-users overflow">
		<img alt="photo d'identitée" src="<?php echo HTTP_PWD_IMG . "users/" . $user['id'] . '.jpg'; ?>" />
	</div>
	</div>
	<div class="info-user text-center">
		<label class="col-xs-12 col-md-6 md-right bold"> Sexe : </label><span class="col-xs-12 col-md-6 md-left no-padding" ><?php echo $user['sexe'] ? 'Homme' : 'Femme'; ?></span>
		<div class="clearfix"></div>
		<label class="col-xs-12 col-md-6 md-right bold"> Date de naissance : </label><span class="col-xs-12 col-md-6 md-left no-padding" ><?php secho($birthdate) ; ?></span>
		<div class="clearfix"></div>
		<label class="col-xs-12 col-md-6 md-right bold"> Promotion : </label><span class="col-xs-12 col-md-6 md-left no-padding" ><?php secho($user['promotion']) ; ?></span>
		<div class="clearfix"></div>
		<label class="col-xs-12 col-md-6 md-right bold"> École : </label><span class="col-xs-12 col-md-6 md-left no-padding" ><?php secho($user['school']) ; ?></span>
		<div class="clearfix"></div>
		<label class="col-xs-12 col-md-6 md-right bold"> Dernier diplôme : </label><span class="col-xs-12 col-md-6 md-left no-padding" ><?php secho($user['studies']) ; ?></span>
		<div class="clearfix"></div>
		<label class="col-xs-12 col-md-6 md-right bold"> ville : </label><span class="col-xs-12 col-md-6 md-left no-padding" ><?php secho($user['city']) ; ?></span>
	</div>
</div>