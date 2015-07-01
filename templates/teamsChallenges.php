<div id="teams-challenges" class="tile">
	 <span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('teams', 'show', [$team['id']])); ?>" target-id="teams-show" animation="slideInLeft" ></span>
	<h1><?php secho($team['name'] . ' - ' . $totalPoints . ' points'); ?></h1>

	<div class="icons-top">
		<?php echo $nbValidChallenges . '/' . $totalChallenges; ?>
	</div>
	
	<?php if (!count($challengesPhotos)) { ?>
		<h2 class="col-xs-12">Défis Photos</h2>
		<div class="no-data col-xs-12">Pas de données</div>
	<?php } else { ?>
		<div class="col-xs-12 col-xs-offset-1 col-md-6 col-md-offset-3 infos-container no-border">
			<h2 class="col-xs-12">Défis Photos</h2>
			<?php foreach ($challengesPhotos as $challenge) { ?>
				<div class="info">
					<span class="control col-xs-12" target="<?php secho($this->generateUrl('pictures', 'show', [$challenge['validated_id']])); ?>" target-id="pictures-show"><?php echo '<span class="ion-ios-checkmark-empty check-valid-challenge"></span> ' . $challenge['points'] . ' pts - '; ?><?php secho(internalTools::limitWords($challenge['title'], 5)); ?></span>
				</div>
				<div class="clearfix"></div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if (!count($challengesObjects)) { ?>
		<h2 class="col-xs-12">Défis Objets</h2>
		<div class="no-data col-xs-12">Pas de données</div>
	<?php } else { ?>
		<div class="col-xs-12 col-xs-offset-1 col-md-6 col-md-offset-3 infos-container no-border">
			<h2 class="col-xs-12">Défis Objets</h2>
			<?php foreach ($challengesObjects as $challenge) { ?>
				<div class="info">
					<span class="col-xs-12"><?php echo '<span class="ion-ios-checkmark-empty check-valid-challenge"></span> ' . $challenge['points'] . ' pts - '; ?><?php secho(internalTools::limitWords($challenge['title'], 5)); ?></span>
				</div>
				<div class="clearfix"></div>
			<?php } ?>
		</div>
	<?php } ?>
</div>

