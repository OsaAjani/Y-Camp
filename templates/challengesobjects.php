<div id="challengesobjects" class="tile">
	 <span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('challenges')); ?>" target-id="challenges" animation="slideInLeft" ></span>
	<h1>Défis Objets</h1>

	<div class="icons-top">
		<?php echo $nbValidChallenges . '/' . count($challenges); ?>
	</div>
	
	<?php if (!count($challenges)) { ?>
		<div class="no-data">Pas de données</div>
	<?php } else { ?>
		<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 infos-container">
			<span class="ion-ios-circle-filled infos-container-round" ></span>
			<span class="ion-cube" id="infos-container-challengesobjects-cube" ></span>
			<?php foreach ($challenges as $challenge) { ?>
				<div class="info">
					<span class="control col-xs-12" target="<?php secho($this->generateUrl('challengesobjects', 'show', [$challenge['id']])); ?>" target-id="challengesobjects-show"><?php echo $challenge['valid'] ? '<span class="ion-ios-checkmark-empty check-valid-challenge"></span> ' : $challenge['points'] . ' pts - '; ?><?php secho(internalTools::limitWords($challenge['title'], 5)); ?></span>
				</div>
				<div class="clearfix"></div>
			<?php } ?>
		</div>
		<div class="infos-container-dotted-end col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3">
			<span class="ion-ios-arrow-thin-down infos-container-arrow-end" ></span>
		</div>
	<?php } ?>
</div>

