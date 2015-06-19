<div id="challengesobjects-confirmvalid" class="tile">
	 <span class="go-back-arrow control ion-ios-arrow-thin-left" target="<?php secho($this->generateUrl('challengesobjects', 'show', [$challenge['id']])); ?>" target-id="challengesobjects-show" animation="slideInLeft" ></span>
	<h1><?php secho($challenge['title']); ?></h1>

	<div class="confirm-delete">Êtes-vous sûr de vouloir valider ce challenge ?</div>

	<form class="ajax-form text-center" action="<?php secho($this->generateUrl('challengesobjects', 'valid', [$challenge['id'], $_SESSION['csrf']])); ?>" method="POST" target="<?php secho($this->generateUrl('challengesobjects', 'show', [$challenge['id']])); ?>" target-id="challengesobjects-show">
		<span class="control challengesobjects-valid-button ion-ios-close-outline" target="<?php secho($this->generateUrl('challengesobjects', 'show', [$challenge['id']])); ?>" target-id="challengesobjects-show" animation="slideInLeft"></span>
		<span id="challengesobjects-valid-button-submit" class="control challengesobjects-valid-button ion-ios-checkmark-outline"></span>
	</form>
</div>

