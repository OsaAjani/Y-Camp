<div id="pictures-show" class="tile">
	<span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('teams', 'pictures', [$validatedChallenges['team_id']])); ?>" target-id="teams-pictures" animation="slideInLeft" ></span>
	<div>
		<img src="<?php echo HTTP_PWD_IMG . "challenges/". $validatedChallenge['document']; ?>">

	</div>
</div>