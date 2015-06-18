<div id="teams-show" class="tile">
	<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('ranking')); ?>" target-id="ranking" animation="slideInLeft" ></span>
	<h1><?php secho($team['name']); ?> - <?php secho($points); ?> points</h1>

	<div class="icons-top">	</div>

	<?php if (!count($users)) { ?>
		<div class="no-data">Pas de données</div>
	<?php } else { ?>
		<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 infos-container">
			<span class="ion-ios-circle-filled infos-container-round" ></span>
			<span class="ion-ios-person" id="infos-container-teams-user" ></span>
			<?php foreach ($users as $user) { ?>
				<div class="info">
					<span class="control col-xs-12" target="<?php secho($this->generateUrl('users', 'show', [$user['id'], 'show'])); ?>" target-id="users-show"><?php secho($user['firstname']." ".$user['lastname']); ?></span>
				</div>
				<div class="clearfix"></div>
			<?php } ?>
		</div>
		<div class="infos-container-dotted-end col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
			<span class="ion-ios-arrow-thin-down infos-container-arrow-end" ></span>
		</div>
	<?php } ?>
</div>