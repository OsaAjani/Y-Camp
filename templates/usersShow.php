<div id="users-show" class="tile">
		<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('teams', 'show', [$user['team_id']])); ?>" target-id="teams-show" animation="slideInLeft" ></span>
	<h1><?php secho($user['firstname']." ".$user['lastname']); ?></h1>

	<div class="text-center">

	<?php if ($user['id'] == $_SESSION['user']['id']) { ?>
		<form class="ajax-form" action="<?php secho($this->generateUrl('users', 'addphoto', [$_SESSION['csrf']])); ?>" method="POST" enctype="multipart/form-data" target="<?php secho($this->generateUrl('users', 'show', [$user['id']])); ?>" target-id="users-show">
			<input id="photo-input" type="file" name="photo" accept="image/*;capture=camera" />
			<label for="photo-input">
				<div class="img-users overflow" style="background-image: url('<?php echo $user['photo'] ? HTTP_PWD_IMG . 'users/' . $user['photo'] : HTTP_PWD_IMG . 'users/' . ($user['sexe'] ? 'man.png' : 'woman.png'); ?>');" >
					<div class="img-users-overlay hover-color <?php echo $_SESSION['user']['photo'] ? 'ion-ios-gear-outline' : 'ion-ios-plus-empty'; ?>"></div>
				</div>
			</label>
		</form>
	<?php } else { ?>
		<div class="img-users overflow" style="background-image: url('<?php echo $user['photo'] ? HTTP_PWD_IMG . 'users/' . $user['photo'] : HTTP_PWD_IMG . 'users/' . ($user['sexe'] ? 'man.png' : 'woman.png'); ?>');" >
		</div>
	<?php } ?>
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
		<label class="col-xs-12 col-md-6 md-right bold"> Dernier diplôme : </label><span class="col-xs-12 col-md-6 md-left no-padding" ><?php secho($user['studies'] ? $user['studies'] : 'Inconnu') ; ?></span>
		<div class="clearfix"></div>
		<label class="col-xs-12 col-md-6 md-right bold"> ville : </label><span class="col-xs-12 col-md-6 md-left no-padding" ><?php secho($user['city']) ; ?></span>
	</div>
</div>
