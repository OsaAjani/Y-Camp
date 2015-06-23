<div id="teams-pictures" class="tile">
	<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('teams', 'show', [$team['id']])); ?>" target-id="teams-show" animation="slideInLeft" ></span>
	<div id="background-images"></div>
	<div id="team-name-cover-container">
		<div id="team-name-cover"><?php secho($challenges ? $team['name'] : 'Pas de données'); ?></div>
	</div>
	<div id="overlay-images"></div>
</div>
<script>
	challenges = <?php echo $challenges ? $challenges : '[]'; ?>;
</script>
<script src="<?php echo HTTP_PWD . 'js/teamsPictures.js'; ?>"></script>
