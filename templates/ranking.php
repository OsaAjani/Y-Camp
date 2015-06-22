<div id="ranking" class="tile">
	<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('challenges')); ?>" target-id="challenges" animation="slideInLeft" ></span>
	<h1>Classement</h1>

	<div class="icons-top"> </div>

	<?php if (!count($teams)) { ?>
		<div class="no-data">Pas de données</div>
	<?php } else { ?>
		<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 infos-container">
			<span class="ion-ios-circle-filled infos-container-round" ></span>
			<span class="ion-trophy" id="infos-container-ranking" ></span>
			<?php foreach ($teams as $team) { ?>
				<div class="info">
					<span class="control col-xs-12" target="<?php secho($this->generateUrl('teams', 'show', [$team['id']])); ?>" target-id="teams-show"><?php secho($team['points'] . ' - ' . $team['name']); ?></span>
				</div>
				<div class="clearfix"></div>
			<?php } ?>
		</div>
		<div class="infos-container-dotted-end col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
			<span class="ion-ios-arrow-thin-down infos-container-arrow-end" ></span>
		</div>
	<?php } ?>

	
</div>